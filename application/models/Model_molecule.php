<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.0
 * @abstract Model file to enter Molecule names and definitions for BNGL and Kappa based models.
 */

class Model_molecule extends CI_Model 
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

###################################################################################################
#                             Pulls Single Molecule Record for Editing                            #
###################################################################################################

	function get ( $id, $get_one = false )
	{
		$this->db->select( 'molecule.idmolecule,molecule,comment,doi.idmolecule,molecule.project_id,name AS project_name' );
		$this->db->from( 'molecule');
        $this->db->join( 'doi', 'doi.idmolecule = molecule.idmolecule', 'left' );
        $this->db->join( 'projects', 'projects.id = molecule.project_id', 'left' );
        $this->db->order_by( 'molecule.molecule', 'ASC' );

		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else
        {}
            $this->db->where( 'molecule.idmolecule', $id );
            $this->db->where( 'molecule.project_id', $_SESSION['project_id']);
        
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
                    'idmolecule'    => $row['idmolecule'],
                    'molecule'      => $row['molecule'],
                    'comment'       => $row['comment'],
                    'doi'           => $row['doi.idmolecule'],
                    'project_id'    => $row['project_id'],
                    'project_name'  => $row['project_name'],
                    );
		}
        else
        {
            return array();
        }
	}

###################################################################################################
#               Queries DB for All Components Associated with a given Molecule                    #
###################################################################################################

	function getall ( $id, $page = FALSE )
	{
	    $this->db->start_cache();
		$this->db->select( 'molecule.idmolecule,idcomponents,component,states,definition,molecule,comment');
		$this->db->from( 'molecule' );
        $this->db->join( 'components', 'components.idmolecule = molecule.idmolecule', 'left' );
		$this->db->order_by( 'component', 'ASC' );
        $this->db->where( 'molecule.project_id', $_SESSION['project_id'] );
        $this->db->where( 'molecule.idmolecule', $id );
        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
            {
                $config = array();
                    $config['total_rows']       = $this->db->count_all_results('molecule');
                    $config['base_url']         = 'index.php/molecule/showall/'.$id.'/';
                    $config['uri_segment']      = 4;
                    $config['per_page']         = $this->pagination_per_page;
                    $config['num_links']        = $this->pagination_num_links;
                    
                $this->pagination->initialize($config);
                $this->pager = $this->pagination->create_links();
                $this->db->limit( $config['per_page'], $page );
            }
		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
            $result = array();

            foreach ( $query->result_array() as $row )
            {
                $result[] = array( 
                    'idcomponents'  => $row['idcomponents'],
                    'component'     => $row['component'],
                    'states'        => $row['states'],
                    'definition'    => $row['definition'],
                    'idmolecule'    => $row['idmolecule'],
                    'molecule'      => $row['molecule'],
                    );
            }
            $this->db->flush_cache();
            return $result;
		}
        else
        {
            return array();
        }
	}
    
###################################################################################################
#                           Queries DB for all Molecules                                          #
###################################################################################################

	function lister ( $page = FALSE )
	{
        $this->db->start_cache();
        $this->db->from( 'molecule' );
        $this->db->where( 'project_id', $_SESSION['project_id'] );
		$this->db->order_by( 'molecule.molecule', 'ASC' );
        $this->db->stop_cache();

        if( $this->model_utilities->pagination_enabled == TRUE )
            {
                $config = array();
                    $config['total_rows']       = $this->db->count_all_results();
                    $config['base_url']         = 'index.php/molecule/index';
                    $config['uri_segment']      = 3;
                    $config['per_page']         = $this->pagination_per_page;
                    $config['num_links']        = $this->pagination_num_links;
                                                
                $this->pagination->initialize($config);
                $this->pager = $this->pagination->create_links();
                $this->db->limit( $config['per_page'], $page );
            }
        $query = $this->db->get();
       
        $result = array();
            
		foreach ( $query->result_array() as $row )
		{
			$result[] = array( 
                'idmolecule'    => $row['idmolecule'],
                'molecule'      => $row['molecule'],
                'comment'       => $row['comment'],
                'project_id'   => $row['project_id'],
            );
		}
        
        $this->db->flush_cache();
		return $result;
	}

###################################################################################################
#                                   DB Utilities                                                  #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
            'idmolecule'    => lang('idmolecule'),
            'molecule'      => lang('molecule_table_molecule'),
            'comment'       => lang('molecule_table_comment')
        );

        if( $withID == FALSE )
        {
            unset( $fs[0] );
        }
        return $fs;
    }  
    function metadata()
    {
        $this->load->library('explain_table');

        $metadata = $this->explain_table->parse( 'molecule' );

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
/*End of File: model_molecule.php*/
/*File Location: ./application/models/ */