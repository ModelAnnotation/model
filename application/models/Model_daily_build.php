<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2014
 * @version 1.1 beta -- added filter to lister function that limits the daily builds to current project.
 * @abstract Handles manipulations of daily build records. 
 * @package Model Annotion Site
 */

class Model_daily_build extends CI_Model 
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
#                                  Retrieve Daily Builds and setup pager.                                             #
#######################################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
	
		$this->db->from( 'daily_build' );
        $this->db->where( 'project_id', $_SESSION['project_id'] );
		$this->db->order_by( 'created', 'DESC' );
        $this->db->stop_cache();

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/daily_build/index/';
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
                        	'id'        => $row['id'],
                        	'notes'     => $row['notes'],
                        	'user_id'   => $row['user_id'],
                        	'created'   => $row['created'],
                            'updated'   => $row['updated'],
                            'file_link' => $row['file_link'],
                             );
		}
        $this->db->flush_cache(); 
		return $result;
	}

###################################################################################################
#                       Processess Daily Build Rule File for Download                             #
###################################################################################################

    function download_file($file, $filepath)
    {
; 
        force_download( $filepath.$file, NULL); 
    }

#######################################################################################################################
#                               Deletes the Uploaded Daily Build Model File.                                          #
#######################################################################################################################

    function delete_file ( $id, $filepath )
    {
        $this->load->helper('file');
        $file = $this->get ($id);
        if(!is_file($filepath.$file['file_link']))
        {
            $_SESSION['errors'] = 'File Not Found On Server; Database Link Removed';
            return FALSE;
        }
        if(unlink( $filepath.$file['file_link'] ))
        {
            return;
        }
        else
        {
            $_SESSION['errors'] = 'Server Error, File Deletion Failed';
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

#######################################################################################################################
#                               Get a Single Daily Build Record to Edit or Show.                                      #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->select( 'id, notes,user_id,project_id,created,updated,file_link' );
		$this->db->from('daily_build');
        $this->db->where( 'project_id', $_SESSION['project_id'] );

		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else
        {
            $this->db->where( 'id', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                        	'id'        => $row['id'],
                        	'notes'     => $row['notes'],
                        	'user_id'   => $row['user_id'],
                        	'created'   => $row['created'],
                            'updated'   => $row['updated'],
                            'file_link' => $row['file_link'],
                     );
		}
        else
        {
            return array();
        }
	}
}
?>