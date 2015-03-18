<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.1 Beta
 * @package Model Annotation
 * @abstract This is the controller for handling the links to external information.
 * 
 */

class Doi extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
        
		/**
		 * Make sure our users are logged in.
		 */
        if (!$this->ion_auth->logged_in())
        {
			redirect('/auth/');
		}

        /**
         * Determine if a Project has been selected.  If not force user to select one.
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

		$this->load->model( 'model_doi' );
	}

#######################################################################################################################
#                                   Create a New External Link for a Molecule                                         #
#######################################################################################################################
    
    function create()
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect( $_SERVER['HTTP_REFERER'] );
        }

        $data = $this->model_doi->get( $_SESSION['idmolecule'] );

        $this->form_validation->set_rules( 'doi', 'External Link', 'required|max_length[100]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post['doi' ] = $this->input->post('doi');
                $data_post['idmolecule'] = $_SESSION['idmolecule'];
                $data_post['project_id'] = $_SESSION['project_id'];
                
                if ( $this->model_doi->dup_check( $data_post ))
                {
                    $this->information['errors'] = 'Creation Failed, Duplicate Record Exsists';
                }
                else
                {
                    $id = $this->model_utilities->insert( 'doi', $data_post );
                    $_SESSION['messages'] = 'Update Successful';
                    $this->session->set_userdata('tag', 'E');
                    redirect( 'doi/edit/' . $id );
                }
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->data['doi'] = $this->form_validation->set_value('doi' );
        
        $this->information['title'] = 'Edit External Link for ';
        $this->information['who'] = $data[0]['molecule'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data);
        $this->template->assign( 'doi_fields', $this->model_doi->fields() );
        $this->template->assign( 'action_mode', 'edit' );
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule() );
        
        $this->_render_page('form_doi.tpl');
    }

#######################################################################################################################
#                                                 Edit Linked Data                                                    #
#######################################################################################################################

    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect( $_SERVER['HTTP_REFERER'] );
        }

        $this->session->set_userdata('tag', 'E');
        
        $data = $this->model_doi->get( $_SESSION['idmolecule'] );
        
        $this->form_validation->set_rules( 'doi', 'External Link', 'required|max_length[100]' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post['doi' ] = $this->input->post('doi');
                $data_post['idmolecule'] = $_SESSION['idmolecule'];
                $data_post['project_id'] = $_SESSION['project_id'];
                
                if ( $this->model_doi->dup_check( $data_post ))
                {
                    $this->information['errors'] = 'Update Failed; Edit Creates Duplicate Record';
                }
                else
                {
                    $this->model_utilities->update( 'doi', 'iddoi', $id, $data_post );
                    $_SESSION['messages'] = 'Update Successful';
                    $this->session->set_userdata('tag', 'E');
                    redirect( 'doi/edit/' . $id );
                }
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->data['doi'] = $this->form_validation->set_value('doi', $data[0]['doi'] );
        $this->data['id'] = $id;
        
        $this->information['title'] = 'Edit External Link for ';
        $this->information['who'] = $data[0]['molecule'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data);
        $this->template->assign( 'doi_fields', $this->model_doi->fields() );
        $this->template->assign( 'action_mode', 'edit' );
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule() );
        
        $this->_render_page('form_doi.tpl');
    }

###################################################################################################
#                                 Delete  Record                                                  #
###################################################################################################

    function delete( $id = FALSE )
    {
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);

        if(!$id) //If there is no ID set then get us out of here.
        {
            $_SESSION['errors'] = 'Deletion Failed, no ID passed';
            redirect( $_SERVER['HTTP_REFERER'] );
        }
        else
        {
            if($this->model_utilities->delete( 'doi', 'iddoi', $id ))
            {
                $_SESSION['messages'] = 'Deletion Succeeded';
                redirect('molecule/showlinks/'. $_SESSION['idmolecule']);
                #redirect( $_SERVER['HTTP_REFERER'] );
            }
            else
            {
                $_SESSION['errors'] = 'Deletion Failed';
                redirect( $_SERVER['HTTP_REFERER'] );
            }
        }
    }
    
#######################################################################################################################
#                                       Loads our Pages by Passing Obects                                             #
#######################################################################################################################

	function _render_page($view, $data=null, $render=false)
	{
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign('project', $_SESSION['project_name']);
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.
