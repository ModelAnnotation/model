<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.1 Beta
 * @abstract This is the model file for the DOI table.
 */

class Model_doi extends CI_Model 
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
#            Queries DB to show either newly inserted doi record or ALL doi records for a given Molecule.             #
#######################################################################################################################

	function get ( $id )
	{
		$this->db->from('doi');
        $this->db->join( 'molecule', 'doi.idmolecule = molecule.idmolecule' );
        $t = $_SESSION['tag'];

		if( $t == 'E' )
        {
            $this->db->where( 'iddoi', $id ); //Return only new doi record.
        }
		else
        {
            $this->db->where( 'doi.idmolecule', $id ); //Return all doi records associated with a Molecule.
        }

		$query = $this->db->get();
        $result = array();
		if ( $query->num_rows() > 0 )
		{
			foreach ( $query->result_array() as $row )
            {
			    $result[] = array( 
	               'iddoi'          => $row['iddoi'],
	               'doi'            => $row['doi'],
	               'idmolecule'     => $row['doi.idmolecule'],
	               'molecule'       => $row['molecule']
                    );
            }
		}
        else
        {
            return array();
        }
        return $result;
	}

###################################################################################################
#                                 Make sure record is not in DB                                   #
###################################################################################################

    function dup_check ( $data )
    {
  		$this->db->select( 'iddoi' );
		$this->db->from('doi');
        $this->db->where( $data );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            return TRUE; //Duplicate Records Found.
        }
        else
        {
            return FALSE; //No Duplicates Found.
        }
    }

###################################################################################################
#                   Designed to get all records from the DOI table                                #
###################################################################################################

	function lister ( $page = FALSE )
	{
	    $this->db->start_cache();
		$this->db->select( 'iddoi,doi,molecule idmolecule');
		$this->db->from( 'doi' );
        $this->db->join( 'molecule', 'doi.idmolecule = molecule.idmolecule', 'left' );

        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('doi');
            $config['base_url']    = 'doi/index/';
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
	                       'iddoi'          => $row['iddoi'],
	                       'doi'            => $row['doi'],
	                       'idmolecule' => $row['idmolecule'],
                            );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

###################################################################################################
#                               Database Utility Functions                                        #
###################################################################################################

    function fields( $withID = FALSE )
    {
        $fs = array(
                'iddoi'          => lang('iddoi'),
                'doi'            => lang('doi'),
            	'idmolecule'      => lang('idmolecule')
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
}
?>