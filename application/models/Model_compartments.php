<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 0.5
 * @abstract This is the model file for dealing with Compartments
 * 
 */

class Model_compartments extends CI_Model 
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
#                                Find All Compartents for Selected Rule                                               #
#######################################################################################################################

    function rulecomparts ($id, $page=FALSE )
    {
        $this->db->start_cache();
        $this->db->from('rule_compartments');
        $this->db->join('compartments', 'compartments.compartment_id = rule_compartments.compartment_id');
        $this->db->where('rule_compartments.idrules', $id);
        $this->db->where('compartments.project_id', $_SESSION['project_id']);
        
        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/compartments/rulecomparts/';
            $config['uri_segment'] = 3;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }
        
        #$q = $this->db->get_compiled_select(); //debugging script.
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ( $query->result_array() as $row  )
            {
                $result[] = array(
                            'compartment_id'=>  $row['compartment_id'],
                            'compartment'   =>  $row['compartment'],
                            'description'   =>  $row['description'],
                            'value'         =>  $row['value']
                            );
            }
            $this->db->flush_cache();
            return $result;
        }
        $this->db->flush_cache();
        return array();
    }
    
#######################################################################################################################
#                            Checks for Duplicate Compartments in Current Proect                                      #
#######################################################################################################################

    function dupcheck ( $dup_test )
    {
		$this->db->from( 'compartments' );
        $this->db->where( 'compartments.project_id', $_SESSION['project_id'] );
        $this->db->where( 'compartment', $dup_test );

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
#                                    Get a Compartment Record for Editing                                             #
#######################################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->from( 'compartments');
        $this->db->where( 'compartments.project_id', $_SESSION['project_id'] );
        $this->db->where( 'compartment_id', $id );
 		if( $get_one )
        {
            $this->db->limit(1,0);
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
            $row = $query->row_array();
            return $temp_result = array( 
                            	'id'           => $row['compartment_id'],
                            	'compartment'  => $row['compartment'],
                                'description'  => $row['description'],
                                'value'        => $row['value'],
                             );
		}
        else
        {
            return array();
        }
	}

#######################################################################################################################
#                                      Retreives All Compartment Data                                                 #
#######################################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();

		$this->db->from( 'compartments' );
        $this->db->where( 'compartments.project_id', $_SESSION['project_id'] );
        $order = "'compartments' REGEXP '^[A-Za-z]+$', CAST(compartment as SIGNED INTEGER), CAST(REPLACE(compartment,'-','')AS SIGNED INTEGER), compartment";
		$this->db->order_by( $order );

        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'index.php/compartments/index/';
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
                            	'id'           => $row['compartment_id'],
                            	'compartment'  => $row['compartment'],
                                'description'  => $row['description'],
                                'value'        => $row['value'],
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
            	'compartment'     => lang('compartment'),
            	'description'   => lang('description'),
                'value'   => lang('value'),
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
