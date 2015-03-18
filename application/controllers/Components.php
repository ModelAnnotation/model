<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2013
 * @version 2.0 Beta
 * @abstract Controller file coordinating the input of Components for the Molecules.
 */
class Components extends CI_Controller 
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

        $this->load->model( 'model_components' );
        $this->lang->load('auth_lang');
	}

#######################################################################################################################
#                                      Creates a list of all Components.                                              #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
		$data_info = $this->model_components->lister( $page );
        $fields = $this->model_components->fields( TRUE );
        
        $this->template->assign( 'pager', $this->model_components->pager );
		
		$this->template->assign( 'components_fields', $fields );
		$this->template->assign( 'data', $data_info );
        $this->template->assign( 'table_name', 'Components' );
        $this->template->assign( 'template', 'list_components' );
        
		$this->template->display( 'frame_admin.tpl' );
    }

###################################################################################################
#                       Show a single Component Record.                                           #
###################################################################################################

    function show( $id )
    {
		$data = $this->model_components->get( $id );
        $fields = $this->model_components->fields( TRUE );
        $molecule_set = $this->model_utilities->related_molecule();
                
        $this->template->assign('related_molecule', $molecule_set);
        $this->template->assign( 'id', $id );
		$this->template->assign( 'components_fields', $fields );
		$this->template->assign( 'data', $data );
		$this->template->assign( 'table_name', 'Components' );
		$this->template->assign( 'template', 'show_components' );
		$this->template->display( 'frame_admin.tpl' );
    }

#######################################################################################################################
#                                      Create new Component Linked to a Molecule.                                     #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }
        
        $this->load->model('model_molecule');
        $idmolecule = $_SESSION['idmolecule'];

        $this->form_validation->set_rules( 'component', $this->lang->line('edit_components_validation_components_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'states', $this->lang->line('edit_components_validation_states_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'definition', $this->lang->line('edit_molecule_validation_definition_label'), 'required' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post = array(
                            'component'     => $this->input->post('component'),
                            'states'        => $this->input->post('states'),
                            'project_id'   => $_SESSION['project_id'],
                            'definition'    => $this->input->post('definition'),
                            'idmolecule'    => $idmolecule
                            );

                $id = $this->model_utilities->insert( 'components', $data_post );
                $_SESSION['messages'] = 'Update Successful';
                redirect( 'molecule/showall/' . $idmolecule );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }
        
        $this->information['title'] = 'Create New Component for Molecule ';
        $this->information['who']   = $this->model_molecule->get( $idmolecule )['molecule'];
        
        $this->data['component']    = $this->form_validation->set_value('component');
        $this->data['definition']   = $this->form_validation->set_value('definition');
        $this->data['states']       = $this->form_validation->set_value('states');
                
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule());
        $this->template->assign( 'components_fields', $this->model_components->fields());
        $this->template->assign( 'data', $this->data);
        $this->template->assign( 'information', $this->information);
        
        $this->_render_page( 'form_components.tpl' );

    }

#######################################################################################################################
#                                               Edit Component.                                                       #
#######################################################################################################################
 
    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }

        $this->form_validation->set_rules( 'component', $this->lang->line('edit_components_validation_components_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'states', $this->lang->line('edit_components_validation_states_label'), 'required|max_length[45]' );
        $this->form_validation->set_rules( 'definition', $this->lang->line('edit_molecule_validation_definition_label'), 'required' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post = array(
                            'component'     => $this->input->post('component'),
                            'states'        => $this->input->post('states'),
                            'definition'    => $this->input->post('definition')
                            );

                $this->model_utilities->update( 'components', 'idcomponents', $id, $data_post );
                $_SESSION['messages'] = 'Update Successful';
                redirect( 'molecule/showall/' . $_SESSION['idmolecule'] );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }
        
        $data = $this->model_components->get( $id );
        $this->information['title'] = 'Edit Component '.$data['component'].' for Molecule ';
        $this->information['who']   = $data['molecule'];
        
        $this->data['component']    = $this->form_validation->set_value('component', $data['component']);
        $this->data['definition']   = $this->form_validation->set_value('definition', $data['definition']);
        $this->data['states']       = $this->form_validation->set_value('states', $data['states']);
                
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule());
        $this->template->assign( 'components_fields', $this->model_components->fields());
        $this->template->assign( 'data', $this->data);
        $this->template->assign( 'information', $this->information);
        
        $this->_render_page( 'form_components.tpl' );
    }

#######################################################################################################################
#                                           Delete a Component Record.                                                #
#######################################################################################################################

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
            if($this->model_utilities->delete('components', 'idcomponents', $id ))
            {
                $_SESSION['messages'] = 'Deletion Succeeded';
            }
            else
            {
                $_SESSION['errors'] = 'Deletion Failed';
            }
            
            redirect( $_SERVER['HTTP_REFERER'] );
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
        $this->template->assign( 'related_projects',$this->model_utilities->related_projects() );
        
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.
