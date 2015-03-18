<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.2
 * @abstract This is the model file for dealing with the ECM Notes
 * 
 */

class Model_ecmnote extends CI_Model 
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
#                                      Remove Any Orphaned Molecules                                                  #
#######################################################################################################################

    function unlinked_molecules ( )
    {
        $this->db->from('molecule');
        $query = $this->db->query("SELECT * FROM molecule WHERE NOT EXISTS(SELECT idmolecule FROM rulemol WHERE rulemol.idmolecule = idmolecule)");
        #$q = $this->db->get_compiled_select();
        
        if ($query->num_rows() > 0)
        {
            foreach ( $query->result_array() as $row  )
            {
                $this->ion_auth->delete_molecule($row['idmolecule']);
            }
            return TRUE;
        }
        return FALSE;
    }
    
#######################################################################################################################
#                               Checks for Duplicate ECM Notes in Current Proect                                      #
#######################################################################################################################

    function dupcheck ( $dup_test )
    {
		$this->db->from( 'ecmnote' );
        $this->db->where( 'ecmnote.project_id', $_SESSION['project_id'] );
        $this->db->where( 'ecmnote.ecmnote', $dup_test );
        $order = "'rule' REGEXP '^[A-Za-z]+$', CAST(ecmnote as SIGNED INTEGER), CAST(REPLACE(ecmnote,'-','')AS SIGNED INTEGER), ecmnote";
		$this->db->order_by( $order );

		$query = $this->db->get();

		if ( $query->num_rows() > 0 ) //If the query returns anything there is a duplicate.
		{
            return FALSE;
		}
        else  /* If there are no records in DB then there can be no duplicates */
        {
            return TRUE;
        }
    }
#######################################################################################################################
#                                  Retreives Comments for a single ECM Note                                           #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{
        $t = $this->session->userdata('tag');

		if ($t == FALSE )
		{
			$t = 'idecm';
		}
		$this->db->select('idecm,ecmnote,comment,ecmnote.project_id,name');
		$this->db->from('ecmnote');
        $this->db->join('projects','project_id = ecmnote.project_id');
        $this->db->where( 'ecmnote.project_id', $_SESSION['project_id'] );
 		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		if($t == 'ECM')
        {
            $this->db->where( 'ecmnote', $id );
        }
        else
        {
            $this->db->where( 'idecm', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                            'idecm'         => $row['idecm'],
                            'ecmnote'       => $row['ecmnote'],
                            'comment'       => $row['comment'],
                            'project_id'    => $row['project_id'],
                            'name'          => $row['name'],
                        );
		}
        else
        {
            return array();
        }
	}

###################################################################################################
#                     Retreives All ECM Notes for Project and Sets Up Pager                       #
###################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();

		$this->db->from( 'ecmnote' );
        $this->db->where( 'ecmnote.project_id', $_SESSION['project_id'] );
        $order = "'ecmnote' REGEXP '^[A-Za-z]+$', CAST(ecmnote as SIGNED INTEGER), CAST(REPLACE(ecmnote,'-','')AS SIGNED INTEGER), ecmnote";
		$this->db->order_by( $order );

        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/ecmnote/index/';
            $config['uri_segment'] = 3;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

		$query = $this->db->get();
		
		$temp_result = array();
        if ( $query->num_rows() > 0 )
        {
      		foreach ( $query->result_array() as $row )
            {
                $temp_result[] = array( 
                            	'idecm'     => $row['idecm'],
                            	'ecmnote'   => $row['ecmnote'],
                                'comment'   => $row['comment'],
                                'project_id'   => $row['project_id'],
                             );
            }
            $this->db->flush_cache(); 
            return $temp_result;
        }
        else
        {
            $this->db->flush_cache(); 
            return array();
        }
	}
    
###################################################################################################
#                                     Database Functions                                          #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            	'idecm'     => lang('idecm'),
            	'ecmnote'   => lang('ecmnote'),
                'comment'   => lang('ecomment'),
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

        $metadata = $this->explain_table->parse( 'ecmnote' );

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
