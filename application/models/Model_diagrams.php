<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 0.5
 * @abstract Handles uploads and down-loads of the diagrams. 
 * @package Model Annotion Site
 */

class Model_diagrams extends CI_Model 
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
#                                      Retrieve Diagrams and setup pager.                                             #
#######################################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
	
		$this->db->from( 'diagrams' );
        $this->db->where( 'project_id', $_SESSION['project_id'] );
		$this->db->order_by( 'uploaded', 'DESC' );
        $this->db->stop_cache();

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/diagrams/index/';
            $config['uri_segment'] = 3;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;

            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

		$query = $this->db->get();
		
		$result = array();

		foreach ( $query->result_array() as $row )
		{
			$result[] = array( 
                        	'diagram_id'  => $row['diagram_id'],
                        	'description' => $row['description'],
                        	'uploaded'    => $row['uploaded'],
                            'filename'    => $row['filename']
                             );
		}
        $this->db->flush_cache(); 
		return $result;
	}

######################################################################################################################
#                                  Processess Diagram File for Download                                              #
######################################################################################################################

    function download_file($file, $filepath)
    {
        force_download( $filepath.$file, NULL); 
    }

#######################################################################################################################
#                              Get a Single Diagram File Record to Edit or Show.                                      #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->select( 'diagram_id, description,project_id,uploaded,filename' );
		$this->db->from('diagrams');
        $this->db->where( 'project_id', $_SESSION['project_id'] );

		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else
        {
            $this->db->where( 'diagram_id', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                        	'diagram_id'  => $row['diagram_id'],
                        	'description' => $row['description'],
                        	'uploaded'    => $row['uploaded'],
                            'filename'    => $row['filename']
                     );
		}
        else
        {
            return array();
        }
	}
} //End of file brace