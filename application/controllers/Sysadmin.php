<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version  1.1
 * @package Model Annotation Site
 * @abstract Controller for the system administration functions of the model site.
 */

class Sysadmin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        
		if (!$this->ion_auth->logged_in())
        {
			redirect('/auth/');
		}
        
        /**
         * Make sure a project has been selected.  If not force user to select one.
         */

        if (isset($_SESSION['project_id']))
        {
            $this->information['project_id'] = $_SESSION['project_id'];
        }
        
        /**
         * Determine if we are logged in with admin status.
         */
        if($this->ion_auth->is_admin() || $this->ion_auth->is_group_admin())
        {
            $this->template->assign('admin', TRUE);
        }
        else
        {
            $this->template->assign('admin', FALSE);
        }
        
        /**
         * Determine if we are logged in as a guest.
         */
         if($this->ion_auth->is_guest())
         {
            $this->template->assign('guest', TRUE);
            redirect('/'); //Guest users do not belong here so send them packing.
         }
         else
         {
            $this->template->assign('guest', FALSE);
         }
         
        /**
         * Determine if we are logged in as a user.
         */
         if($this->ion_auth->is_user())
         {
            $this->template->assign('user', TRUE);
         }
         else
         {
            $this->template->assign('user', FALSE);
         }
        /**
         * Determine if we are logged in as a group admin.
         */
         if($this->ion_auth->is_group_admin())
         {
            $this->template->assign('group_admin', TRUE);
         }
         else
         {
            $this->template->assign('group_admin', FALSE);
         }

         
        /**
         * Capture any messages or errors.
         */
        if(isset($_SESSION['messages']))
        {
            $this->information['messages'] = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }
        elseif(isset($_SESSION['errors']))
        {
            $this->information['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $this->load->model( 'model_admin' );
	}
    
#######################################################################################################################
#                                                  Edit User Group                                                    #
#######################################################################################################################

	function edit_group($id)
	{
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest() || !$id || empty($id)) //If any of these are true send the user packing.
        {
            Redirect('dashboard');
        }
                
        $group = $this->ion_auth->group($id)->row();
        $this->lang->load('auth_lang');
		
		$this->form_validation->set_rules('description', $this->lang->line('edit_group_validation_desc_label'), 'required');
		$this->form_validation->set_rules('protect', $this->lang->line('edit_group_validation_protect_label'), 'max_length[1]|less_than[2]|integer');
                
		if (isset($_POST) && !empty($_POST))
		{
            if ($this->input->post('group_name')) //Set the group name validation rules if posted.
            {
                $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|is_unique[groups.name]|alpha_dash');
            }

			if ($this->form_validation->run() === TRUE)
			{
                if ($this->input->post('group_name'))
                {
                    $groupname = $this->input->post('group_name');
                }
				else
				{
					$groupname = $group->name;
				}
                if ($this->input->post('protect'))
                {
                    $protected = $this->input->post('protect');
                }
                else
                {
                    $protected = 0;
                }
                
                $data_post = array(
                        'description' => $this->input->post('description'),
                        'protected'   => $protected
                        );

				$group_update = $this->ion_auth->update_group($id, $groupname, $data_post);

				if($group_update)
				{
					$this->session->set_userdata('messages', $this->lang->line('edit_group_saved')); //Success, redirect to show new entry.
                    redirect("sysadmin/edit_group/".$id);
				}
				else
				{
					$this->information['errors'] = ($this->ion_auth->errors());
				}
			}
		}

        $this->information['title']  = $this->lang->line('edit_group_title');
        $this->information['who']    = $this->form_validation->set_value('group_name', $group->name);
		$this->data['group_name']    = "";
		$this->data['description']   = $this->form_validation->set_value('group_description', $group->description);
		$this->data['protect']       = $this->form_validation->set_value('edit_group_protect_label', $group->protected);
        
        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
		$this->_render_page('form_groups.tpl', $this->data);

    }
#######################################################################################################################
#                                                Create User Group                                                    #
#######################################################################################################################

	function create_group()
	{
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //If any of these are true send the user packing.
        {
            Redirect('dashboard');
        }

        $this->lang->load('auth_lang');
		
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'required');
		$this->form_validation->set_rules('protect', $this->lang->line('create_group_validation_protect_label'), 'max_length[1]|less_than[2]|integer');
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|is_unique[groups.name]|alpha_dash');
         
		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
                if ($this->input->post('protect'))
                {
                    $protected = $this->input->post('protect');
                }
                else
                {
                    $protected = 0;
                }
                
                $data_post = array(
                        'description' => $this->input->post('description'),
                        'protected'   => $protected
                        );

                $id = $this->ion_auth->create_group($this->input->post('group_name'), $data_post);

				if($id)
				{
					$this->session->set_userdata('messages', $this->ion_auth->messages()); //Success, redirect to show new entry.
                    redirect("sysadmin/edit_group/".$id);
				}
				else
				{
						$this->information['errors'] = ($this->ion_auth->errors());
				}
			}
		}

        $this->information['title'] = $this->lang->line('create_group_title');
		$this->data['group_name']   = $this->form_validation->set_value('group_name', $data_post['group_name']);
		$this->data['description']  = $this->form_validation->set_value('group_description', $data_post['description']);
		$this->data['protect']      = $this->form_validation->set_value('edit_group_protect_label', $data_post['protect']);
        
        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
		$this->_render_page('form_groups.tpl', $this->data);
    }


#######################################################################################################################
#                                                   List Groups                                                       #
#######################################################################################################################

    function list_groups($page = 0)
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest() || $this->ion_auth->is_user()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->information['permission'] = FALSE;
        if($this->ion_auth->compare_groups($id)) //Check if user has permission to edit groups.
        {
             $this->information['permission'] = TRUE;
        }
        $this->information['title'] = 'List of Groups';
        
        $this->template->assign( 'data', $this->ion_auth->allowedgroups() ); //Get a list of groups user has permission to access.
        $this->template->assign( 'information', $this->information );

        $this->_render_page('list_groups.tpl');
    }

#######################################################################################################################
#                                                   List All Users                                                    #
#######################################################################################################################

	function list_users($page = 0)
	{
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest() || $this->ion_auth->is_user()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
                
        $this->information['permission'] = FALSE;
        if($this->ion_auth->compare_groups($id)) //Check if user has permission to edit user(s).
        {
             $this->information['permission'] = TRUE;
        }
        #print_r($user = $this->ion_auth->user()->row());
        $this->model_utilities->pagination( TRUE );
        $this->information['title'] = 'Users';
        $this->information['user'] = $this->ion_auth->is_user();
        
        $this->template->assign( 'pager', $this->model_admin->pager );
        $this->template->assign( 'data', $this->model_admin->list_u( $page ) );
        $this->template->assign('information', $this->information);

        $this->_render_page('list_sysadmin.tpl');
	}
    
#######################################################################################################################
#                                                     Create New User                                                 #
#######################################################################################################################

	function create_user()
	{
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        $this->information['title'] = "Create User";
        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );
		$groups = $this->ion_auth->allowedgroups(); //Get a list of groups we have permission to access.

		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('create_user_validation_username_label'), 'required|is_unique[users.username]|min_length[' . $this->config->item('min_username_length', 'ion_auth').']');
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true)
		{
			$username = $this->input->post('username');
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');
            $groupData = $this->input->post('groups');
            
			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
		}

        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, $groupData ))
        {
			
            #$id = $this->ion_auth->register($username, $password, $email, $additional_data, $groupData );
            unset($_SESSION['messages']);
            $id = $user = $this->ion_auth->user($username)->row()->id;
            
            $_SESSION['messages'] = $this->ion_auth->messages(); //Update a success
            redirect('sysadmin/edit_user/'.$id);
		}
		else
		{
			$this->information['errors']        = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['groups']        = $groups;
            $this->data['username']      = $this->form_validation->set_value('username');
            $this->data['first_name']    = $this->form_validation->set_value('first_name');
			$this->data['last_name']     = $this->form_validation->set_value('last_name');
			$this->data['email']         = $this->form_validation->set_value('email');
			$this->data['company']       = $this->form_validation->set_value('company');
			$this->data['phone']         = $this->form_validation->set_value('phone');
			$this->data['password']      = $this->form_validation->set_value('password');
			$this->data['password_confirm'] = $this->form_validation->set_value('password_confirm');
            $this->information['who']           = 'New User';
            
            $this->template->assign('data', $this->data);
            $this->template->assign('information', $this->information);
			$this->_render_page('form_users.tpl', $this->data);
		}
	}


#######################################################################################################################
#                                                     Edit User                                                       #
#######################################################################################################################

	function edit_user($id)
	{
		if (!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()|| !$this->ion_auth->compare_groups($id)) //If you are not logged in, are a guest, or not a group admin you do not belong here.
		{
            redirect('auth', 'refresh');
		}        

        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->allowedgroups(); //Get a list of groups we have permission to access.
		$currentGroups = $this->ion_auth->get_users_groups($id)->result(); //Find the groups the user being edited is a member of.

		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST))
		{
            if ($this->input->post('username')) //Set the username validation rules if posted.
            {
                $this->form_validation->set_rules('username', $this->lang->line('edit_user_validation_username_label'), 'required|alpha_dash|is_unique[users.username]|min_length[' . $this->config->item('min_username_length', 'ion_auth').']');
            }
			if ($this->input->post('password')) //Set the password validation rules if posted.
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
                    'active'     => $this->input->post('activated')
				);

				//update the username if it was posted
                if ($this->input->post('username'))
                {
                    $data['username'] = $this->input->post('username');
                }
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

                //Update the groups user belongs to
                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData))
                {
                    $this->ion_auth->remove_from_group('', $id);
					foreach ($groupData as $grp)
                    {
					   $this->ion_auth->add_to_group($grp, $id);
					}
                }

			   if($this->ion_auth->update($user->id, $data))
			    {
                    $_SESSION['messages'] = $this->ion_auth->messages(); //Update a success
                    redirect('sysadmin/edit_user/'.$id);
			    }
			    else
			    {
                    $this->data['errors'] = $this->ion_auth->errors(); //Update Failed
			    }
			}
		}

		$this->information['errors']         = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['id']             = $id;
		$this->data['groups']         = $groups;
		$this->data['currentGroups']  = $currentGroups;
        $this->data['first_name']     = $this->form_validation->set_value('first_name', $user->first_name);
        $this->data['last_name']      = $this->form_validation->set_value('last_name', $user->last_name);
        $this->data['company']        = $this->form_validation->set_value('company', $user->company);
        $this->data['activated']      = $this->form_validation->set_value('activated', $user->active);
		$this->information['who']     = $this->form_validation->set_value('username', $user->username);
		$this->data['username']       = "";
		$this->data['phone']          = $this->form_validation->set_value('phone', $user->phone);
        $this->data['email']          = $this->form_validation->set_value('email', $user->email);
		$this->data['password'];
		$this->data['password_confirm'];
        
        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
		$this->_render_page('form_users.tpl', $this->data);
	}

#######################################################################################################################
#                                                 Delete User                                                         #
#######################################################################################################################

    function delete( $id = FALSE )
    {
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);
        if($this->ion_auth->delete_user($id))
        {
            $this->session->set_userdata('messages', 'User Deleted From System');
        }
        else
        {
            $this->session->set_userdata('errors', 'User Deletion Failed');
        }
        redirect('sysadmin/list_users');
    }

#######################################################################################################################
#                                                Delete Group                                                         #
#######################################################################################################################

    function delete_group( $id = FALSE )
    {
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);
        if($this->ion_auth->delete_group($id))
        {
            $this->session->set_userdata('messages', 'Group Deleted From System');
        }
        else
        {
            $this->session->set_userdata('errors', 'Group Deletion Failed');
        }
        redirect('sysadmin/list_users');
    }

#######################################################################################################################
#                                       Loads our Pages by Passing Obects                                             #
#######################################################################################################################

	function _render_page($view, $data=null, $render=false)
	{
        $this->template->assign( 'fields', $this->model_admin->fields() );
        
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign( 'project_id', $this->project_id );
        $this->template->assign('project', $_SESSION['project_name']);
        
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}
?>