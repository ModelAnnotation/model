<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version  0.5 Beta
 * @package Model Annotation Site
 * @abstract Controller for compartment information.
 */


class Compartments extends CI_Controller 
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
            redirect('/');
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
        
		$this->load->model( 'model_compartments' );
	}

#######################################################################################################################
#                                 List All Compartments for Project                                                   #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
        
        $this->information['who'] = '';
        $this->information['title'] = 'List of Compartments ';
        
        $this->template->assign( 'pager', $this->model_compartments->pager );
		$this->template->assign( 'data', $this->model_compartments->lister( $page ) );
        $this->template->assign( 'information', $this->information );
  
		$this->_render_page('list_compartments.tpl');
    }

#######################################################################################################################
#                                 List All Compartments for Selected Rule                                             #
#######################################################################################################################

    function rulecomparts( $id, $page = 0 )
    {
        $this->load->model('model_rules');
        $this->model_utilities->pagination( TRUE );
        $rulename = $this->model_rules->get($id);
        if(isset($_POST) AND !empty($_POST))
        {
            if($this->model_utilities->delete('rule_compartments', 'idrules', $id, 'compartment_id', $this->input->post( 'compartment_id' )))
            {
                $_SESSION['messages'] = 'Compartment Removed From Rule';
            }
            else
            {
                $_SESSION['errors'] = 'Deletion Failed';
            }
            redirect('/compartments/rulecomparts/'.$id);
        }
        
        $this->information['who'] = $rulename['rule'];
        $this->information['title'] = 'Compartments for Rule:</br>';
        
        $this->template->assign( 'pager', $this->model_compartments->pager );
		$this->template->assign( 'data', $this->model_compartments->rulecomparts($id, $page) );
        $this->template->assign( 'information', $this->information );
  
		$this->_render_page('list_compartments.tpl');
    }


#######################################################################################################################
#                                       Create a New Compartment                                                      #
#######################################################################################################################

    function create( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $this->template->assign( 'fields', $this->lang->load('auth') );

        $this->form_validation->set_rules( 'compartment', $this->lang->line('edit_project_validation_name_label'), 'required|max_length[50]' );
        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );
        $this->form_validation->set_rules( 'value', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[15]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                if($this->model_compartments->dupcheck($this->input->post( 'compartment' )))
                {
                    $data_post['compartment'] = $this->input->post( 'compartment' );
                    $data_post['description'] = $this->input->post( 'description' );
                    $data_post['value']       = $this->input->post( 'value' );
                    $data_post['project_id']  = $_SESSION['project_id'];
                
                    $id = $this->model_utilities->insert( 'compartments', $data_post );
                    $this->session->set_userdata('messages', 'Compartment Created');
                    redirect( 'compartments/edit/' . $id );
                }
                else
                {
                    $this->information['errors'] = 'Duplicate Compartments Are Not Allowed.';
                }
            }
            else
            {
                $this->information['errors'] = $errors = validation_errors(); //Update Failed
            }
       }
        
        $this->information['who'] = '';
        $this->information['title'] = 'Create New Compartment ';

        $this->data['compartment'] = $this->form_validation->set_value('compartment', $project_data['compartment']);
        $this->data['description'] = $this->form_validation->set_value('description', $project_data['description']);
        $this->data['value']       = $this->form_validation->set_value('value', $project_data['value']);

        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_compartments.tpl');

    }

#######################################################################################################################
#                                                Edit a Compartment                                                   #
#######################################################################################################################

    function edit( $id = false )
    {
        if(!$this->ion_auth->logged_in() || $this->ion_auth->is_guest()) //A Guest should never get this far but just in case let's send them packing.
        {
            Redirect('dashboard');
        }
        
        $this->lang->load('auth_lang');
        $data = $this->model_compartments->get($id);
        $this->template->assign( 'fields', $this->lang->load('auth') );

		$groups = $this->ion_auth->allowedgroups(); //Get a list of groups we have permission to access.

        $this->form_validation->set_rules( 'description', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[400]' );
        $this->form_validation->set_rules( 'value', $this->lang->line('edit_project_validation_description_label'), 'required|max_length[15]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                if($this->model_compartments->dupcheck($this->input->post( 'compartment' )))
                {
                    if($this->input->post( 'compartment' ))
                    {
                        $data_post['compartment'] = $this->input->post( 'compartment' );
                    }
                    
                    $data_post['description'] = $this->input->post( 'description' );
                    $data_post['value']       = $this->input->post( 'value' );
                
                    $this->model_utilities->update( 'compartments', 'compartment_id', $id, $data_post );
                    $this->session->set_userdata('messages', 'Compartment Updated');
                    redirect( 'compartments/edit/' . $id );
                }
                else
                {
                    $this->information['errors'] = 'Edit Creates Duplicate Compartment Name';
                }
            }
            else
            {
                $this->information['errors'] = validation_errors(); //Update Failed
            }
       }
        
        #$this->information['errors'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->information['who']   = $data['compartment'];
        $this->information['title'] = 'Edit Compartment ';

        $this->data['compartment'] = $this->form_validation->set_value('compartment');
        $this->data['description'] = $this->form_validation->set_value('description', $data['description']);
        $this->data['value']       = $this->form_validation->set_value('value', $data['value']);
        
        $this->template->assign('data', $this->data);
        $this->template->assign('information', $this->information);
        $this->_render_page('form_compartments.tpl');
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

        if($this->ion_auth->delete_compart($id))
            {
                $_SESSION['messages'] = 'Compartment Deleted';
                if(isset($_SESSION['project_id']))
                {
                    redirect('compartments');
                }
                else
                {
                    redirect('dashboard');
                }
            }
            else
            {
                $_SESSION['errors'] = 'Compartment Deletion Failed';
                redirect('compartments');
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
