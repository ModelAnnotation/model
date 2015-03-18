<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version  1.3 Beta
 * @package Model Annotation Site
 * @abstract Controller for the entry of project information.
 */


class Projects extends CI_Controller 
{
	function __construct()
	{
        /**
         * Make sure user is logged in.  If not force user to login.
         */

        parent::__construct();
        
		if (!$this->ion_auth->logged_in())
        {
			redirect('/auth/');
		}
        
        /**
         * Determine if a Project has been selected.
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
         }
         else
         {
            $this->template->assign('guest', FALSE);
         }
         
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
        
		$this->load->model( 'model_projects' );
	}

###################################################################################################
#                       Setup a list of all projects in DB                                        #
###################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
        
        $this->information['permission'] = FALSE;
        if($this->ion_auth->compare_groups($id)) //Check if user has permission to edit projects.
        {
             $this->information['permission'] = TRUE;
        }
       
        $this->information['who'] = '';
        $this->information['title'] = 'List of Projects ';
        $this->information['user'] = $this->ion_auth->is_user();
        
        $this->template->assign( 'pager', $this->model_projects->pager );
		$this->template->assign( 'data', $this->model_projects->lister( $page ) );
        $this->template->assign( 'information', $this->information );
        
		$this->_render_page('list_projects.tpl');
    }

###################################################################################################
#                                   Create a New Project                                          #
###################################################################################################

    function create( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );


        $user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->allowedgroups(TRUE); //Get a list of groups we have permission to access.
		$currentGroups = $this->ion_auth->get_projects_groups($id)->result(); //Find the groups the project is a member of.

        $this->form_validation->set_rules( 'name', $this->lang->line('edit_project_validation_name_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                $data_post['name'] = $this->input->post( 'name' );
                $data_post['description'] = $this->input->post( 'description' );
                $id = $this->model_utilities->insert( 'projects', $data_post );
                
                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData))
                {
                    $this->ion_auth->remove_from_project_group('', $id);
					foreach ($groupData as $grp)
                    {
					   $this->ion_auth->add_to_project_group($grp, $id);
					}
                }
                $this->session->set_userdata('messages', 'Project Created');
                $this->information['messages'] = 'Project Updated'; //Update a success
                redirect( 'projects/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = $this->ion_auth->errors(); //Update Failed
            }
       }
        
        $this->information['title'] = 'Create New Project ';
        $this->data['name']           = $this->form_validation->set_value('name', $data_post['name']);
        $this->data['description']    = $this->form_validation->set_value('description', $data_post['description']);
        $this->data['id']             = $id;
        $this->data['groups']         = $groups;
        $this->data['currentGroups']  = $currentGroups;
        $this->data['admin']          = $this->ion_auth->is_admin();
        $this->data['group_admin']    = $this->ion_auth->is_group_admin();

        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_projects.tpl', $this->data);

    }

#######################################################################################################################
#                                                    Edit a Project                                                   #
#######################################################################################################################

    function edit( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );

		$project_data = $this->model_projects->get( $id );

		$groups = $this->ion_auth->allowedgroups(TRUE); //Get a list of groups we have permission to access.
		$currentGroups = $this->ion_auth->get_projects_groups($id)->result(); //Find the groups the project is a member of.

        $this->form_validation->set_rules( 'name', $this->lang->line('edit_project_validation_name_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                $data_post['name'] = $this->input->post( 'name' );
                $data_post['description'] = $this->input->post( 'description' );
                
                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData))
                {
                    $this->ion_auth->remove_from_project_group('', $id);
					foreach ($groupData as $grp)
                    {
					   $this->ion_auth->add_to_project_group($grp, $id);
					}
                }
                $this->model_utilities->update( 'projects', 'id', $id, $data_post );
                $_SESSION['messages'] = 'Project Updated';

                redirect( 'projects/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = $this->ion_auth->errors(); //Update Failed
            }
       }
        
        $this->information['title'] = 'Edit Project: ';
        $this->data['name']           = $this->form_validation->set_value('name', $project_data['name']);
        $this->data['description']    = $this->form_validation->set_value('description', $project_data['description']);
        $this->data['id']             = $id;
        $this->data['groups']         = $groups;
        $this->data['currentGroups']  = $currentGroups;
        $this->data['admin']          = $this->ion_auth->is_admin();
        $this->data['group_admin']    = $this->ion_auth->is_group_admin();

        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_projects.tpl');
    }

###################################################################################################
#                                       Delete Function                                           #
###################################################################################################

    function delete( $id = FALSE )
    {
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);

        if(!$this->ion_auth->is_admin()) //Only allowing system administrators to do this for now.
        {
            redirect('projects');
        }
        
        if (isset($_POST) && !empty($_POST))
        {
            $post = $this->input->post('idme');
            
            if($this->ion_auth->delete_project($id))
            {
                $_SESSION['messages'] = 'Project Deleted';
                if(isset($_SESSION['project_id']))
                {
                    redirect('projects');
                }
                else
                {
                    redirect('dashboard');
                }
            }
            else
            {
                $_SESSION['errors'] = 'Project Deletion Failed';
                redirect('projects');
            }
        }
        $data = $this->model_projects->get($id);
        $this->information['who'] = $data['name'];
        $this->information['title'] = 'Delete Project';
        
        $this->template->assign('information', $this->information);
        $this->_render_page('nuclear.tpl');
    }
    
#######################################################################################################################
#                                       Loads our Pages by Passing Obects                                             #
#######################################################################################################################

	function _render_page($view, $data=null, $render=false)
	{
        $this->template->assign( 'fields', $this->model_projects->fields( TRUE ) );
        
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign( 'project', $_SESSION['project_name']);
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.
