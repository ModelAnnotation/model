<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 1.7
 * @abstract  This controller handles associating rules with molecules.  This is a many to many type relationship.
 *              There is no need to associate records in this table with Projects.
 */
class Rulemol extends CI_Controller 
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
    
        $this->lang->load('auth_lang');
		$this->load->model( 'model_rulemol' );
	}

#######################################################################################################################
#                                           Link Rules to Molecules                                                   #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }
        
        $this->load->model('model_rules');
        $rule = $this->model_rules->get($id);
        
        $this->form_validation->set_rules( 'idrules', 'Rule', 'required|max_length[11]|integer' );
        $this->form_validation->set_rules( 'idmolecule', 'Molecule', 'required|max_length[11]|integer' );

        if (isset($_POST) && !empty($_POST))
        {
            $data_post['idrules']    = $this->input->post( 'idrules' );
            $data_post['idmolecule'] = $this->input->post( 'idmolecule' );

            if ( $this->form_validation->run())
            {
                $insert_id = $this->model_utilities->insert( 'rulemol', $data_post );
                $_SESSION['messages'] = 'Data Entry Successful.  Link Another Molecule to Same Rule.';
                redirect( 'rulemol/create/'.$data_post['idrules'] );
            }
            else
            {
                $_SESSION['errors'] = validation_errors();
                redirect( 'rulemol/create/'.$data_post['idrules'] );
            }
        }
        
        $this->information['title'] = 'Associate Rule With Molecules';
        $this->information['who'] = '';

        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'rule', $rule );

        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule());
        $this->template->assign( 'related_rules', $this->model_utilities->related_rules());
        $this->template->assign( 'rulemol_fields', $this->model_rulemol->fields() );
        
        $this->_render_page('form_rulemol.tpl');

    }

###################################################################################################
#                           Editing These Links Not Currently Used                                #
###################################################################################################

    function edit( $id = false )
    {
        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->model_rulemol->raw_data = TRUE;
        		$data = $this->model_rulemol->get( $id );
                $fields = $this->model_rulemol->fields();
                
                $this->template->assign('related_molecule', $this->model_utilities->related_molecule());
                $this->template->assign('related_rules', $this->model_utilities->related_rules());
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'rulemol_data', $data );
        		$this->template->assign( 'rulemol_fields', $fields );
                $this->template->assign( 'metadata', $this->model_rulemol->metadata() );
        		$this->template->assign( 'table_name', 'Rulemol' );
        		$this->template->assign( 'template', 'form_rulemol' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_admin.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_rulemol->fields();

				$this->form_validation->set_rules( 'idrules', 'Rule', 'required|max_length[11]|integer' );
				$this->form_validation->set_rules( 'idmolecule','Molecule', 'required|max_length[11]|integer' );

				$data_post['idrules']    = $this->input->post( 'idrules' );
				$data_post['idmolecule'] = $this->input->post( 'idmolecule' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'rulemol_data', $data_post );
            		$this->template->assign( 'rulemol_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_rulemol->metadata() );
                    $this->template->assign('related_molecule', $this->model_utilities->related_molecule());
                    $this->template->assign('related_rules', $this->model_utilitis->related_rules());

            		$this->template->assign( 'table_name', 'Rulemol' );
            		$this->template->assign( 'template', 'form_rulemol' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_admin.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_utilities->update( 'rulemol', 'idrulemol', $id, $data_post );
				    
					redirect( 'rulemol/show/' . $id );   
                }
            break;
        }
    }

###################################################################################################
#                               Delete Record                                                     #
###################################################################################################

    function delete( $id = FALSE )
    {
        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->model_utilities->delete( 'rulemol', 'idrulemol', $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
                $this->model_utilities->delete( $this->input->post('rulemol', 'idrulemol', 'delete_ids') );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;
        }
    }
    
#######################################################################################################################
#                                       Loads our Pages by Passing Obects                                             #
#######################################################################################################################

	function _render_page($view, $data=null, $render=false)
	{
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign( 'project', $_SESSION['project_name']);
        $this->template->assign( 'template', $view );
        
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.

