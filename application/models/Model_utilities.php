<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 0.7 Beta
 * @package Model Annotation Site
 * @abstract    This model provides the common DB utility functions such as "Delete" and "Related Fields."
 */
 
class Model_utilities extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
    
    function duplicate_check($table,$field, $value)
    {
        $this->db->from($table);
        $this->db->where('project_id', $_SESSION['project_id']);
        $this->db->where($field, $value);
        if($this->db->get()->num_rows() > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function pagination( $bool )
    {
        $this->pagination_enabled = ( $bool === TRUE ) ? TRUE : FALSE;
    }

	function delete ( $table, $k, $id )
	{
        if( is_array( $id ) )
        {
            $this->db->where_in( $k, $id );            
        }
        else
        {
            $this->db->where( $k, $id );
        }
        $this->db->delete( $table );
        return true;
	}

	function insert ( $table, $data )
	{
		$this->db->insert( $table, $data );
		return $this->db->insert_id();
	}
	
	function update ( $table, $k, $id, $data )
	{
		$this->db->where( $k, $id );
		$this->db->update( $table, $data );
	}

    function related_rulemol()
    {
        $this->db->select('idrulemol AS rulemol_id, rule AS rules_name');
        $rel_rule_data = $this->db->get('rulemol');
        return $rel_rule_data->result_array();
    }

    function related_rules()
    {
        $this->db->select('idrules AS rules_id, rule AS rules_name');
        $this->db->where( 'rules.project_id', $_SESSION['project_id'] );
        $order = "'rule' REGEXP '^[A-Za-z]+$', CAST(rule as SIGNED INTEGER), CAST(REPLACE(rule,'-','')AS SIGNED INTEGER), rule";
        $this->db->order_by( $order );
        $rel_rule_data = $this->db->get('rules');
        return $rel_rule_data->result_array();
    }
    
    function related_parameters()
    {
        $this->db->select('parameter_id, parameter AS parameter_name');
        $this->db->where( 'parameters.project_id', $_SESSION['project_id'] );
        $order = "'parameters' REGEXP '^[A-Za-z]+$', CAST(parameter as SIGNED INTEGER), CAST(REPLACE(parameter,'-','')AS SIGNED INTEGER), parameter";
        $this->db->order_by( $order );
        $rel_rule_data = $this->db->get('parameters');
        return $rel_rule_data->result_array();
    }

    function related_compartments()
    {
        $this->db->select('compartment_id, compartment AS compartment_name');
        $this->db->where( 'compartments.project_id', $_SESSION['project_id'] );
        $order = "'compartments' REGEXP '^[A-Za-z]+$', CAST(compartment as SIGNED INTEGER), CAST(REPLACE(compartment,'-','')AS SIGNED INTEGER), compartment";
        $this->db->order_by( $order );
        $rel_rule_data = $this->db->get('compartments');
        return $rel_rule_data->result_array();
    }

	function related_molecule()
    {
        $this->db->select( 'molecule.idmolecule AS molecule_id, molecule AS molecule_name' );
        $this->db->order_by('molecule','ASC');
        $this->db->where( 'molecule.project_id', $_SESSION['project_id'] );
        $rel_data = $this->db->get( 'molecule' );
        return $rel_data->result_array();
    }
    
	function related_components()
    {
        $this->db->select( 'idcomponents, idmolecule AS component_idmolecule' );
        $this->db->where('components.project_id', $_SESSION['project_id']);
        $order = "'component' REGEXP '^[A-Za-z]+$', CAST(component as SIGNED INTEGER), CAST(REPLACE(component,'-','')AS SIGNED INTEGER), component";
        $this->db->order_by($order);
        $rel_data = $this->db->get( 'components' );
        return $rel_data->result_array();
    }

	function related_projects()
    {
        $this->db->select( 'projects.id AS id_project, projects.name AS project_name, projects_groups.group_id' );
        $this->db->join('projects_groups', 'projects_groups.project_id = projects.id');
        $order = "'name' REGEXP '^[A-Za-z]+$', CAST(name as SIGNED INTEGER), CAST(REPLACE(name,'-','')AS SIGNED INTEGER), name";
        $this->db->order_by($order);
        
        $query = $this->db->get( 'projects' );
        
        
        if ( $query->num_rows() > 0 )
        {
            foreach ( $query->result_array() as $row )
            {
                if($this->ion_auth->compare_project_groups($row['id_project']))
                {
                    $rel_data[] = array( 
                        	'id_project'   => $row['id_project'],
                        	'project_name' => $row['project_name']
                             );
                }
            }
        }  
        else
        {
            return array();
        }
        return $rel_data;
    }

	function related_doi()
    {
        $this->db->select( 'iddoi AS iddoi_id, doi AS doi_name' );
        $this->db->where('doi.project_id', $_SESSION['project_id']);
        $rel_data = $this->db->get( 'doi' );
        return $rel_data->result_array();
    }

    function related_pubauth()
    {
        $this->db->select( 'pubmed_id, ForeName, LastName, Initials' );
        $rel_data = $this->db->get( 'pubauth' );
        return $rel_data->result_array();
    }

	function related_ecmnote()
    {
        $this->db->select( 'idecm AS ecmnote_id, ecmnote AS ecmnote_name' );
        $this->db->where('project_id',$_SESSION['project_id']);
        $order = "'ecmnote' REGEXP '^[A-Za-z]+$', CAST(ecmnote as SIGNED INTEGER), CAST(REPLACE(ecmnote,'-','')AS SIGNED INTEGER), ecmnote";
        $this->db->order_by($order);
        $rel_data = $this->db->get( 'ecmnote' );
        return $rel_data->result_array();
    }

}
?>