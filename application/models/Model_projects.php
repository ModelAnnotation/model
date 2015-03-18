<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.1
 * @package Model Annotation Site
 * @abstract Model handles the manipulation of Project information for the Model Annotation Site.
 */

class Model_projects extends CI_Model 
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
#                                   Get a Single Project from DB to Edit or Show.                                     #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{	
        $this->db->from('projects');

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
		  if($this->ion_auth->compare_project_groups($row['id']))
          {
			return array( 
                	'id'           => $row['id'],
                	'name'         => $row['name'],
                	'description'  => $row['description'],
                     );
          }
		}
        else
        {
            return array();
        }
	}

#######################################################################################################################
#                                Get all Projects in DB and setup pager.                                              #
#######################################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
		$this->db->from( 'projects' );
        $order = "'projects.name' REGEXP '^[A-Za-z]+$', CAST(projects.name as SIGNED INTEGER), CAST(REPLACE(projects.name,'-','')AS SIGNED INTEGER), projects.name";
		$this->db->order_by( $order );
        $this->db->stop_cache();

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/projects/';
            $config['uri_segment'] = 3;
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
                if($this->ion_auth->compare_project_groups($row['id']))
                {
                    $result[] = array( 
                        	'id'            => $row['id'],
                        	'name'          => $row['name'],
                        	'description'   => $row['description'],
                        	'created'       => $row['created'],
                            'modified'      => $row['modified'],
                             );
                }
            }
        }  
        else
        {
            return array();
        }
        $this->db->flush_cache(); 
		return $result;
	}

###################################################################################################
#                                       DB Utilities                                              #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            	'id'           => lang('id'),
            	'name'         => lang('name'),
            	'description'  => lang('description'),
                'created'      => lang('created'),
                'modified'     => lang('modified'),
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

        $metadata = $this->explain_table->parse( 'projects' );

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
