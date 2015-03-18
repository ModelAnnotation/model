<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.0
 * @abstract This file handles the heavy lifting for things surrounding the RULES component of the site.
 * 
 */

class Model_rules extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
 
		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 5;
		$this->pagination_num_links = 5;
		$this->pager = '';
    }

#######################################################################################################################
#                                               Gets a record to Edit                                                 #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->from( 'rules' );
        $this->db->join( 'ecmnote', 'ecmnote.idecm = rules.idecm', 'left' );
        $this->db->join( 'projects', 'projects.id = rules.project_id', 'left' );
     
		if( $get_one )
        {
            $this->db->limit(1,0);
            $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        }
		else
        {
            $this->db->where( 'idrules', $id );
            $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                	'idrules'     => $row['idrules'],
                	'rule'        => $row['rule'],
                	'rulenote'    => $row['rulenote'],
                	'idecm'       => $row['idecm'],
                	'projects_id' => $row['project_id'],

                    );
		}
        else
        {
            return array();
        }
	}

#######################################################################################################################
#                             Retrieves all Molecules associated with a given Rule.                                   #
#######################################################################################################################

	function getall (  $id, $get_one = false )
	{
	    $this->db->start_cache();
		$this->db->from('rulemol');
        
        $this->db->join('rules','rules.idrules = rulemol.idrules','left');
        $this->db->join('molecule','molecule.idmolecule = rulemol.idmolecule','left');
       
        $this->db->where( 'rulemol.idrules', $id );
        $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        $this->db->stop_cache();

		$query = $this->db->get();
		$result = array();
        
        if ( $query->num_rows() > 0 )
        {
      		foreach ( $query->result_array() as $row )
            {
                $result[] = array(
                                    'rule'          => $row['rule'],  
                                    'idmolecule'    => $row['idmolecule'],
                                    'molecule'      => $row['molecule'],
                                    'comment'       => $row['comment'],
                                    'project_id'   => $row['project_id'],
                                    'idrulemol'     => $row['idrulemol']
                                    );
            }
            $this->db->flush_cache(); 
            return $result;
        }
        else
        {
            $this->db->flush_cache();
            return array();
        }
	}

#######################################################################################################################
#                                          Retreives all Rules.                                                       #
#######################################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
		$this->db->from( 'rules' );
        $this->db->join( 'ecmnote', 'ecmnote.idecm = rules.idecm', 'left' );
        $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        $order = "'rule' REGEXP '^[A-Za-z]+$', CAST(rule as SIGNED INTEGER), CAST(REPLACE(rule,'-','')AS SIGNED INTEGER), rule";
        $this->db->order_by( $order );
        $this->db->stop_cache();

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']    = $this->db->count_all_results();
            $config['base_url']      = 'index.php/rules/index/';
            $config['uri_segment']   = 3;
            $config['per_page']      = $this->pagination_per_page;
            $config['num_links']     = $this->pagination_num_links;

            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
            $this->db->limit( $config['per_page'], $page );
        }
        
		$query = $this->db->get();
		$result = array();
        
        if ( $query->num_rows() > 0 )
        {
            foreach ( $query->result_array() as $row )
            {
                $result[] = array( 
                	'idrules'   => $row['idrules'],
                	'rule'      => $row['rule'],
                	'rulenote'  => $row['rulenote'],
                	'idecm' => $row['rules.idecm']
                    );
            }
            $this->db->flush_cache(); 
            return $result;
        }
        else
        {
            $this->db->flush_cache();
            return array();
        }
	}

#######################################################################################################################
#          Return a list of idecm's associated with a molecule.  Part of code to find all publications                #
#          associated with a molecule.                                                                                #
#######################################################################################################################

    function find_mol_idecm($key, $page = FALSE, $tag = FALSE)
    {
        $meta = $this->metadata();
	    $this->db->start_cache();
        $this->db->distinct();
		$this->db->select( 'idecm');
		$this->db->from( 'rules' );
        
        $this->db->where( 'rule LIKE "%'.$key.'%"' );
        $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        $this->db->order_by('idecm', 'ASC');
        
        $query = $this->db->get();
		$result = array();

        if ( $query->num_rows() > 0 )
        {
    		foreach ( $query->result_array() as $row )
    		{
    			$result[] = array( 
                	'idecm' => $row['idecm'],
                      );
    		}
        
            foreach($result as $v)
            {
                $r[] = $v;
                foreach($v as $d)
                {
                    $da[] = $d;
                }
            }

            $this->db->flush_cache(); 
    		return $da;
        }
        else
        {
            $this->db->flush_cache();
            return array();
        }
    }
    
#######################################################################################################################
#                     This function is designed to find a list of rules based on snippets.                            #
#######################################################################################################################

    function findrules ($key, $page = FALSE, $tag = FALSE )
    {
        $meta = $this->metadata();
	    $this->db->start_cache();
        $this->db->distinct();
		$this->db->select( 'idrules,rule,rulenote,rules.idecm,rules.project_id');
        
        $order = "'rule' REGEXP '^[A-Za-z]+$', CAST(rule as SIGNED INTEGER), CAST(REPLACE(rule,'-','')AS SIGNED INTEGER), rule";
        $this->db->order_by($order);

		$this->db->from( 'rules' );
        $this->db->join( 'ecmnote', 'ecmnote.idecm = rules.idecm', 'left' );
        
        $this->db->where( 'rule LIKE "%'.$key.'%"' );
        $this->db->where( 'rules.project_id', $_SESSION['project_id']);

        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            
            if( !$tag  )
            {
                $config['base_url']    = 'index.php/rules/find_rules/'.$key.'/';
                $config['uri_segment'] = 3;
            }
            else
            {
                $config['base_url']    = 'index.php/rules/find_molrules/'.$key.'/';
                $config['uri_segment'] = 4;
            }
            
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;
    
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }
        
        $query = $this->db->get();
		$result = array();
        
        if ( $query->num_rows() > 0 )
        {
            foreach ( $query->result_array() as $row )
            {
                $result[] = array( 
                	'idrules'     => $row['idrules'],
                	'rule'        => $row['rule'],
                	'rulenote'    => $row['rulenote'],
                	'idecm' => $row['rules.idecm']
                 );
            }
            $this->db->flush_cache();
            return $result;
        }
        else
        {
            $this->db->flush_cache();
            return array();
        } 
    }

#######################################################################################################################
#         Finds all Rules Associated with a Given ECM Note.  $tag defines source of ECM note.                         #
#######################################################################################################################

	function search ( $key, $tag, $page = FALSE )
	{
	    $this->db->start_cache();

		$this->db->from( 'ecmnote' );
        $this->db->join( 'rules', 'rules.idecm = ecmnote.idecm', 'left' );
        $order = "'rule' REGEXP '^[A-Za-z]+$', CAST(rule as SIGNED INTEGER), CAST(REPLACE(rule,'-','')AS SIGNED INTEGER), rule";
		$this->db->order_by( $order );
        $this->db->where( 'ecmnote.project_id', $_SESSION['project_id'] );

        if( $tag == 'E') //Retrieve Rules Based on ECM Figure Input
        {
            $this->db->where( 'ecmnote',$key );
        }
        else //Retrieve Rules Based on Manual ECM Note Selection.
        {
            $this->db->where( 'ecmnote.idecm',$key );
        }
        
        $this->db->stop_cache();
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = "index.php/rules/ecm_rules/".$key.'/';
            $config['uri_segment'] = 4;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;
    
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }
        $query = $this->db->get();
		$result = array();

        if ( $query->num_rows() > 0 )
        {
    		foreach ( $query->result_array() as $row )
    		{
    			$result[] = array( 
                    	'idrules'     => $row['idrules'],
                    	'rule'        => $row['rule'],
                    	'rulenote'    => $row['rulenote'],
                    	'idecm'       => $row['rules.idecm'],
                        'ecmnote'     => $row['ecmnote'],
                        'idecm'       => $row['idecm'],
                        'project_id'  => $row['project_id'],
                        );
    		}
            $this->db->flush_cache();
    		return $result;
        }
        else
        {
            $this->db->flush_cache();
            return array();
        }
	}

###################################################################################################
#                                   DB Utility Functions.                                         #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            	'idrules'     => lang('idrules'),
            	'rule'        => lang('rule'),
            	'rulenote'    => lang('rulenote'),
            	'idecm' => lang('idecm')
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

        $metadata = $this->explain_table->parse( 'rules' );

        foreach( $metadata as $k => $md )
        {
            if( !empty( $md['enum_values'] ) )
            {
                $metadata[ $k ]['enum_names'] = array_map( 'lang', $md['enum_values'] );                
            } 
        }
        return $metadata; 
    }
}
?>