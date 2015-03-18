<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.1
 * @abstract Model handles the manipulation of the components for the Model Annotation Site.
 */

class Model_components extends CI_Model 
{
    function __construct()
    {
        parent::__construct();

		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 10;
		$this->pagination_num_links = 5;
		$this->pager = '';

        /**
		 *    bool $this->raw_data		
		 *    Used to decide what data should the SQL queries retrieve if tables are joined
		 *     - TRUE:  just the field names of the components table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }
###################################################################################################
#                               Get a single record to edit.                                      #
###################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->select( 'idcomponents,component,states,definition,components.idmolecule,components.project_id,name AS project_name,molecule,molecule.idmolecule' );
		$this->db->from('components');
        $this->db->join( 'molecule', 'molecule.idmolecule = components.idmolecule', 'left' );
        $this->db->join( 'projects', 'projects.id = components.project_id', 'left' );

		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else
        {
            $this->db->where( 'idcomponents', $id );
            $this->db->where( 'components.project_id', $_SESSION['project_id'] );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                    'idcomponents'      => $row['idcomponents'],
                    'component'         => $row['component'],
                    'states'            => $row['states'],
                    'definition'        => $row['definition'],
                    'project_name'      => $row['project_name'],
                    'project_id'       => $row['project_id'],
                    'molecule'          => $row['molecule'],
                    'idmolecule'        => $row['idmolecule'],
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
		$this->db->select('idcomponents,component,states,definition,molecule AS components_idmolecule,components.project_id');
		$this->db->from( 'components' );
        $this->db->join( 'molecule', 'molecule.idmolecule = components.components_idmolecule', 'left' );

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
                $config['total_rows']       = $this->db->count_all_results('components');
                $config['base_url']         = 'index.php/components/index/';
                $config['uri_segment']      = 3;
                $config['per_page']         = $this->pagination_per_page;
                $config['num_links']        = $this->pagination_num_links;

            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
            $this->db->limit( $config['per_page'], $page );
        }

        $this->db->where( 'components.project_id', $this->project_id );
		$query = $this->db->get();
		
		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
                'idcomponents'  => $row['idcomponents'],
                'component'     => $row['component'],
                'states'        => $row['states'],
                'definition'    => $row['definition'],
                'project_id'   => $row['project_id'],
                'molecule'      => $row['components_idmolecule'],
            );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

###################################################################################################
#                               DB Utilities.                                                     #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            'idcomponents'  => lang('idcomponents'),
            'component'     => lang('component'),
            'states'        => lang('states'),
            'definition'    => lang('definition'),
            'molecule'      => lang('components_idmolecule')
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

        $metadata = $this->explain_table->parse( 'components' );

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
