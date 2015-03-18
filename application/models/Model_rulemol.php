<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.0
 * @abstract Model handles linking the Rules to Molecules for the Model Annotation Site.
 */

class Model_rulemol extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
 
		$this->load->database();

		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 7;
		$this->pagination_num_links = 5;
		$this->pager = '';
    }

###################################################################################################
#                           Get a single entry to edit or show.                                   #
###################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->select( 'idrulemol,idrules,idmolecule,molecule' );
        $this->db->join( 'molecule', 'molecule.idmolecule = rulemol.idmolecule','left' );
        $this->db->join('rules', 'rules.idrules = rulemol.idrules', 'left');

		$this->db->from('rulemol');
        
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else
        {
            $this->db->where( 'idrulemol', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                    	'idrulemol'         => $row['idrulemol'],
                    	'idrules'           => $row['rulemol.idrules'],
                    	'idmolecule'        => $row['rulemol.idmolecule'],
                        'molecule'          => $row['molecule'],
                    );
		}
        else
        {
            return array();
        }
	}


	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
		$this->db->select( 'idrulemol,rulemol_idrules,idmolecule,molecule' );
		$this->db->from( 'rulemol' );
        $this->db->join( 'molecule', 'molecule.idmolecule = rulemol.idmolecule', 'left' );
        $this->db->join('rules', 'rules.idrules = rulemol.idrules', 'left');
		$this->db->order_by( 'idrulemol', 'DESC' );
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('rulemol');
            $config['base_url']    = 'index.php/rulemol/index/';
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

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
                    	'idrulemol'   => $row['idrulemol'],
                    	'idrules'     => $row['rulemol.idrules'],
                    	'idmolecule'  => $row['rulemol.idmolecule'],
                        );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

    function fields( $withID = FALSE )
    {
        $fs = array(
            	'idrulemol'         => lang('idrulemol'),
            	'idmolecule'        => lang('idmolecule'),
            	'idrules'           => lang('idrules'),
            	'rules_idrules'     => lang('rules_idrules'),
            	'idrules' => lang('idrules'),
            	'idmolecule' => lang('idmolecule')
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

        $metadata = $this->explain_table->parse( 'rulemol' );

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
