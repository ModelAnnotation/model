<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis Simpson
 * @copyright 2015
 * @version  1.1 Beta
 * @package Model Annotation Site
 * @abstract Model for the system administration functions of the model site.
 */

class Model_admin extends CI_Model
{
        function __construct()
    {
        parent::__construct();

		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 10;
		$this->pagination_num_links = 5;
		$this->pager = '';

    }
#######################################################################################################################
#                                                 List All Users                                                      #
#######################################################################################################################

    function list_u($page = FALSE)
    {
        $this->db->start_cache();
		$this->db->from( 'users' );
        $this->db->stop_cache();
        
        if( $this->model_utilities->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results();
            $config['base_url']    = 'sysadmin/list_users/';
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
                if($this->ion_auth->compare_groups($row['id'])) //Only return users that current user has permission to view.
                {
                    if($row['active']){$active = 'yes';}else{$active = 'no';}
                    
                    $result[] = array( 
	                       'id'             => $row['id'],
	                       'username'       => $row['username'],
                           'activated'      => $active,
                           'name'           => $row['first_name'].' '.$row['last_name'],
                           'last_ip'        => $row['ip_address'],
                           'last_login'     => unix_to_human($row['last_login'], TRUE, 'us'),
                           'organization'   => $row['company']
                            );
                }
            }
            $this->db->flush_cache();
            return $result;
        }
        else
        {
            return array();
        }
    }
    
#######################################################################################################################
#                                               Database Field Names                                                  #
#######################################################################################################################
    function fields( $withID = FALSE )
    {
        $fs = array(
                'id'            =>lang('id'),
                'username'      =>lang('edit_user_username_label'),
                'email'         =>lang('edit_user_email_label'),
                'activated'     =>lang('activated'),
                
                'password'      =>lang('password'),
                'last_ip'       =>lang('last_ip'),
                'last_login'    =>lang('last_login'),
                'created'       =>lang('created'),
                'password_confirm'      =>lang('edit_user_password_confirm_label'),
                'group_id'      =>lang('group_id'),
                'first_name'    =>lang('edit_user_fname_label'),
                'last_name'       =>lang('edit_user_lname_label'),
                'organization'  =>lang('organization'),
                'phone'         =>lang('edit_user_phone_label'),
                'description'   =>lang('group_description'),
                'group_name'   =>lang('group_name'),
                'protect'   =>lang('protected')
                
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

        $metadata = $this->explain_table->parse( 'users' );

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