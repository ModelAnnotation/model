<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version  0.5 Beta
 * @package Model Annotation Site
 * @abstract Controller for parameter information.
 */


class Parameters extends CI_Controller 
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
         * Determine if a Project has been selected; if not force the user to select one.
         */
        if (isset($_SESSION['project_id']))
        {
            $this->information['project_id'] = $_SESSION['project_id'];
        }
        else
        {
            redirect('dashboard');
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
        
		$this->load->model( 'model_parameters' );
	}

#######################################################################################################################
#                                   List All Parameters for Project                                                   #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
        
        $this->information['who'] = '';
        $this->information['title'] = 'List of Parameters ';
        
        $this->template->assign( 'pager', $this->model_parameters->pager );
		$this->template->assign( 'data', $this->model_parameters->lister( $page ) );
        $this->template->assign( 'information', $this->information );
  
		$this->_render_page('list_parameters.tpl');
    }

#######################################################################################################################
#                                 List All Parameters for Selected Rule                                               #
#######################################################################################################################

    function ruleprams( $id, $page = 0 )
    {
        $this->load->model('model_rules');
        $this->model_utilities->pagination( TRUE );
        $rulename = $this->model_rules->get($id);
        
        $this->information['who'] = $rulename['rule'];
        $this->information['title'] = 'Parameters for Rule:</br>';
        
        $this->template->assign( 'pager', $this->model_parameters->pager );
		$this->template->assign( 'data', $this->model_parameters->ruleprams($id, $page) );
        $this->template->assign( 'information', $this->information );
  
		$this->_render_page('list_parameters.tpl');
    }


#######################################################################################################################
#                                         Create a New Parameter                                                      #
#######################################################################################################################

    function create( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );

        $this->form_validation->set_rules( 'parameter', $this->lang->line('edit_project_validation_name_label'), 'required|max_length[50]' );
        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );
        $this->form_validation->set_rules( 'value', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[15]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                if($this->model_parameters->dupcheck($this->input->post( 'parameter' )))
                {
                    $data_post['parameter']   = $this->input->post( 'parameter' );
                    $data_post['description'] = $this->input->post( 'description' );
                    $data_post['value']       = $this->input->post( 'value' );
                    $data_post['project_id']  = $_SESSION['project_id'];

                    $id = $this->model_utilities->insert( 'parameters', $data_post );
                    $_SESSION['messages'] = 'Parameter Created';
                    redirect( 'parameters/edit/' . $id );

                }
                else
                {
                    $this->information['errors'] = 'Duplicate Parameter Names Are Not Allowed';
                }
            }
            else
            {
                $this->information['errors'] = $errors = validation_errors(); //Update Failed
            }
       }
        
        $this->information['who'] = '';
        $this->information['title'] = 'Create New Parameter ';

        $this->data['parameter']   = $this->form_validation->set_value('parameter', $project_data['parameter']);
        $this->data['description'] = $this->form_validation->set_value('description', $project_data['description']);
        $this->data['value']       = $this->form_validation->set_value('value', $project_data['value']);

        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_parameters.tpl');

    }

#######################################################################################################################
#                                                  Edit a Parameter                                                   #
#######################################################################################################################

    function edit( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $data = $this->model_parameters->get($id);
        $this->template->assign( 'fields', $this->lang->load('auth') );

		$groups = $this->ion_auth->allowedgroups(); //Get a list of groups we have permission to access.

        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );
        $this->form_validation->set_rules( 'value', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[15]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                if($this->model_parameters->dupcheck($this->input->post( 'parameter' )))
                {
                    if($this->input->post( 'parameter' )) //If the parameter name was changed capture it.
                    {
                        $data_post['parameter'] = $this->input->post( 'parameter' );
                    }
                    
                    $data_post['description'] = $this->input->post( 'description' );
                    $data_post['value'] = $this->input->post( 'value' );
                
                    $this->model_utilities->update( 'parameters', 'parameter_id', $id, $data_post );
                    $_SESSION['messages'] = 'Parameter Updated';
                    redirect( 'parameters/edit/' . $id );
                }
                else
                {
                    $this->information['errors'] = 'Edit Creates Duplicate Parameter Name';
                }
            }
            else
            {
                $this->information['errors'] = validation_errors(); //Update Failed
            }
       }
        
        $this->information['who']   = $data['parameter'];
        $this->information['title'] = 'Edit Parameter ';

        $this->data['parameter']   = $this->form_validation->set_value('parameter');
        $this->data['description'] = $this->form_validation->set_value('description', $data['description']);
        $this->data['value']       = $this->form_validation->set_value('value', $data['value']);
        
        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_parameters.tpl');
    }

#######################################################################################################################
#                                               Delete Function                                                       #
#######################################################################################################################

    function delete( $id = FALSE )
    {
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);
        
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }

        if($this->ion_auth->delete_param($id))
            {
                $_SESSION['messages'] = 'Parameter Deleted';
                if(isset($_SESSION['project_id']))
                {
                    redirect('parameters');
                }
                else
                {
                    redirect('dashboard');
                }
            }
            else
            {
                $_SESSION['errors'] = 'Parameter Deletion Failed';
                redirect('parameters');
            }
    }
    
#######################################################################################################################
#                                       Loads our Pages by Passing Obects                                             #
#######################################################################################################################

	function _render_page($view, $data=null, $render=false)
	{
        #$this->template->assign( 'fields', $this->model_projects->fields( TRUE ) );
        
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign( 'project', $_SESSION['project_name']);
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.
