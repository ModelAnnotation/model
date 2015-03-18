<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 1.5 Beta
 * @abstract This model handles uploading and parsing PubMed XML files.  Also generation
 *              of MySQL queries and inserstion of data into DB.  Basically all things
 *              PubMed.
 */
 
class Model_pubmed extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
 
		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 7;
		$this->pagination_num_links = 5;
		$this->pager = '';
    }

###################################################################################################
#  Get PubMed table data and compare to xml to make sure we are not creating a duplicate entry.   #
###################################################################################################

    function dup_check($dup_test, $idecm)
    {
		$this->db->select( 'PMID,idecm,ELocationID,project_id');
		$this->db->from( 'pubmed' );
        $this->db->where('idecm', $idecm);
		$query = $this->db->get();
        
		if ( $query->num_rows() > 0 )
        {
      		foreach ( $query->result_array() as $row )
            {
                $PMID_idecm = $row['PMID'].$row['ELocationID'];
                
                if ( $dup_test == $PMID_idecm)
                {
                    redirect('pubmed/duplicate');
                }
            }
        }
        else /* If there are no records in DB then there can be no duplicates */
        {
            return;
        }
    }


    /**
     * Parse PubMed XML file, split out authors and load everything into DB.
     */
    function xml3array($xml,$post,$fname)
    {
        
###################################################################################################
#                               Main PubMed Section                                               #
###################################################################################################
        
        $sql = array();
        $val = array(
                    'PMID'          => array(),
                    'Volume'        => array(),
                    'Issue'         => array(),
                    'PubDate'       => array(),
                    'Title'         => array(),
                    'ArticleTitle'  => array(),
                    'MedlinePgn'    => array(),
                    'ELocationID'   => array(),
                    'idecm'         => array(),
                    'AbstractText'  => array()
                    );
                    

        unlink($fname); //We don't need the uploaded file so delete it.
        
        foreach($xml->xpath('//PubDate') as $PubDate)
        {
            $PD = $PubDate->Year;
        }

        $idecm = $post['idecm']; //Get ECM Note ID from array for duplicate check and DB insertion.
        $project_id = $post['project_id'];
        
        foreach ($xml as $MedlineCitation) 
        {
            $PMID=$MedlineCitation->PMID;  //PMID is needed for duplicate check and to link authors.
            $ELocationID=(string)$MedlineCitation->Article->ELocationID;  //Extract value for duplicate check.
            
            $val['PMID'][]          = (int)$MedlineCitation->PMID;
            $val['Volume'][]        = (int)$MedlineCitation->Article->Journal->JournalIssue->Volume;
            $val['Issue'][]         = (int)$MedlineCitation->Article->Journal->JournalIssue->Issue;
            $val['PubDate'][]       = $PD;
            $val['Title'][]         = (string)$MedlineCitation->Article->Journal->Title;
            $val['ArticleTitle'][]  = (string)$MedlineCitation->Article->ArticleTitle;
            $val['MedlinePgn'][]    = (string)$MedlineCitation->Article->Pagination->MedlinePgn;
            $val['ELocationID'][]   = (string)$MedlineCitation->Article->ELocationID;
            $val['idecm'][]         = $idecm;
            $val['projects_id'][]   = $project_id;
            $val['AbstractText'][]  = (string)$MedlineCitation->Article->Abstract->AbstractText;
        }

        $dup_test = $PMID.$ELocationID;
        $this->dup_check($dup_test,$idecm,$project_id);
        
        foreach($val as $arr)
        {
            foreach($arr as $k => $v)
            {
                if(!array_key_exists($k, $sql))
                {
                    $sql[$k] = array(
                                    'PMID'          => $val['PMID'][$k],
                                    'Volume'        => $val['Volume'][$k],
                                    'Issue'         => $val['Issue'][$k],
                                    'PubDate'       => $val['PubDate'][$k],
                                    'Title'         => $val['Title'][$k],
                                    'ArticleTitle'  => $val['ArticleTitle'][$k],
                                    'MedlinePgn'    => $val['MedlinePgn'][$k],
                                    'ELocationID'   => $val['ELocationID'][$k],
                                    'idecm'         => $val['idecm'][$k],
                                    'project_id'   => $val['project_id'][$k],
                                    'AbstractText'  => $val['AbstractText'][$k]
                                    );
                    
    	            $this->db->insert( 'pubmed', $sql[$k] );
                    $insert_id = $this->db->insert_id();
                }
            }
        }
    
###################################################################################################
#                                   Author Section                                                #
###################################################################################################

        unset($sql);
        $sql = array();
        $val = array(
                    'pubmed_id'     => array(),
                    'LastName'      => array(),
                    'ForeName'      => array(),
                    'Initials'      => array()
                    );
       
        foreach($xml->xpath('//Author') as $Author)
        {
            $val['pubmed_id'][] = (int)$insert_id;
            $val['LastName'][]  = (string) $Author->LastName;
            $val['ForeName'][]  = (string) $Author->ForeName;
            $val['Initials'][]  = (string) $Author->Initials;
        }
    
        $c = 0;
        foreach($val as $arr)  /*Create the SQL statements and load authors into database. */
        {
    	   foreach($arr as $k => $v)
           {
                if(!array_key_exists($k, $sql))
                {  
        			$sql[$k] = array(
                                    'pubmed_id'     => $val['pubmed_id'][$k],
                                    'LastName'      => $val['LastName'][$k],
                                    'ForeName'      => $val['ForeName'][$k],
                                    'Initials'      => $val['Initials'][$k]
                                    );
                        
		            $this->db->insert( 'pubauth', $sql[$k] );
                    $c = $c + $this->db->affected_rows('pubauth'); /* Count number of rows inserted. */
                }
            }
        }

        return $insert_id;
    } //function bracket
    
    
#######################################################################################################################
#                            Retreives PubMed record loaded from function above.                                      #
#######################################################################################################################

    function get($id) /* This function will only return first author.  Needs fixed to return all authors. */
    {
        $this->db->select('pubmed.id, PMID, Volume, Issue, PubDate, Title, ArticleTitle, MedlinePgn, ELocationID, LastName, Initials');
        $this->db->from('pubmed');
        $this->db->join('pubauth', 'pubmed_id = pubmed.id', 'right');
        $this->db->where('pubmed.id', $id);
        
        $q = $this->db->get();
        $pubmed_array = array();
        $error = NULL;
        if ( $q->num_rows() >0 )
        {
            $row = $q->row_array();
            return array(
                        'id'            => $row['id'],
                        'PMID'          => $row['PMID'],
                        'Volume'        => $row['Volume'],
                        'Issue'         => $row['Issue'],
                        'PubDate'       => $row['PubDate'],
                        'Title'         => $row['Title'],
                        'ArticleTitle'  => $row['ArticleTitle'],
                        'MedlinePgn'    => $row['MedlinePgn'],
                        'ELocationID'   => $row['ELocationID'],
                        'LastName'      => $row['LastName'],
                        'Initials'      => $row['Initials']
                        );
        }
        else
        {
            /* This is not an eligant solution.  Want error to display on select_file page. */
            $_SESSION['errors'] = String('Database Input Failed.  No additional infomation available.  If error persists contact Admin. Go Back to Try Again');
            return array();
        }
    }


#######################################################################################################################
#     Finds all PubMed Records Associated with a Given ECM Note.  $tag defines source of ECM note.                    #
#     Requires two queries to DB.                                                                                     #
#######################################################################################################################

	function search (  $key, $tag, $page = FALSE )
	{   
       $this->db->start_cache();
	    $meta = $this->metadata();
		$this->db->from( 'ecmnote' );
        
        $this->db->join( 'pubmed', 'pubmed.idecm = ecmnote.idecm', 'left' );
        $this->db->where('ecmnote.project_id', $_SESSION['project_id']);

        if( $tag == 'E') //Retrieve PubMed Records Based on ECM Figure Input
        {
            $this->db->where( 'ecmnote',$key );
        }
        elseif($tag == 'mol_pub') //Retrieve PubMed Records Based on array of idecm.
        {
            $this->db->where_in( 'pubmed.idecm',$key );
            $this->db->distinct( 'pubmed.PMID' );
            $this->db->group_by( 'pubmed.PMID' );
        }
        else //Retrieve PubMed Records Based on Manual ECM Note Selection.
        {
            $this->db->where( 'ecmnote.idecm',$key );
        }
        
        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
           $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = '/pubmed/search/'.$key.'/';
            $config['uri_segment'] = 4;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;

            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }
        
        $query = $this->db->get();
        
        /**
         * Retrieve Authors associated with the PubMed record(s) retrieved above.
         */
		$this->db->select( 'pubmed_id, ArticleTitle, LastName, Initials, pubauth.id AS pubauth_id');
        $this->db->from( 'ecmnote' );
        $this->db->join( 'pubmed', 'pubmed.idecm = ecmnote.idecm', 'left' );
        $this->db->join( 'pubauth', 'pubmed_id = pubmed.id','left');
        
        if( $tag == 'E') //Retrieve Author Records Based on ECM Figure Input
        {
            $this->db->where( 'ecmnote',$key );
        }
        elseif($tag == 'mol_pub')
        {
            
        }
        else  //Retrieve Author Records Based on Manual ECM Note Selection.
        {
            $this->db->where( 'ecmnote.idecm',$key );
        }
		
		$auth_query = $this->db->get();

		$pub = array();
		$auth = array();
        $q = array();

        if ( $query->num_rows() > 0 )
        {
            
        /**
         * Get Authors into an array.
         */
        foreach ($auth_query->result_array() as $r)
            {
                $auth[] = array (
                            'pubmed_id'=> $r['pubmed_id'],
                            'LastName' => $r['LastName'],
                            'Initials' => $r['Initials']
                            );
            }


        /**
         * Get main PubMed data into an array with the authors array.
         */
		foreach ( $query->result_array() as $row )
		{
			$pub[] = array(
                       'idecm'          => $row['idecm'],
                       'ecmnote'        => $row['ecmnote'],
                       'id'             => $row["id"],
                       'PMID'           => $row["PMID"],
                       'Volume'         => $row['Volume'],
                       'Issue'          => $row['Issue'],
                       'PubDate'        => $row['PubDate'],
                       'Title'          => $row['Title'],
                       'ArticleTitle'   => $row['ArticleTitle'],
                       'MedlinePgn'     => $row['MedlinePgn'],
                       'ELocationID'    => $row['ELocationID'],
                       'authors'        => $auth
                       );
		}
        
            $this->db->flush_cache(); 
            return $pub;
        }
        else
        {
            return array();
        }
    
	}

###################################################################################################
#                         Misc. Functions are Found in this Section.                              #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            'id'  => lang('id'),
            'PMID' => lang('PMID'),
            'ELocationID' => lang('ELocationID'),
            'Volume'     => lang('Volume'),
            'Issue'        => lang('Issue'),
            'Title'    => lang('Title'),
            'MedlinePgn' => lang('MedlinePgn'),
            'ArticleTitle'      => lang('ArticleTitle')
        );

        if( $withID == FALSE )
        {
            unset( $fs[0] );
        }
        return $fs;
    }  

    /**
     *  Parses the table data and look for enum values, to match them with language variables
     */             
    function metadata()
    {
        $this->load->library('explain_table');

        $metadata = $this->explain_table->parse( 'doi' );

        foreach( $metadata as $k => $md )
        {
            if( !empty( $md['enum_values'] ) )
            {
                $metadata[ $k ]['enum_names'] = array_map( 'lang', $md['enum_values'] );                
            } 
        }
        return $metadata; 
    }


} //class bracket
?>