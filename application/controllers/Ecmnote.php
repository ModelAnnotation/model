<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.2
 * @abstract This is the controller for handling the Extended Contact Map(ECM) Notes.
 */
 
class Ecmnote extends CI_Controller 
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
		$this->load->model( 'model_ecmnote' );

	}

#######################################################################################################################
#                                          List all ECM Notes                                                         #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
		$data_info = $this->model_ecmnote->lister( $page );
        
        $this->information['who'] = $id;
        $this->information['title'] = 'List of ECM Notes for Project';
        
        $this->template->assign( 'pager', $this->model_ecmnote->pager );
		$this->template->assign( 'ecmnote_fields', $this->model_ecmnote->fields( TRUE ) );
		$this->template->assign( 'ecmnote_data', $data_info );
        
        $this->template->assign( 'information', $this->information);
        
		 $this->_render_page('list_ecmnote.tpl');
    }

###################################################################################################
#                         Show ECM Note Comments.  Input from ECM Diagrams                        #
###################################################################################################

    function show( $id )
    {
		$this->session->set_userdata('tag','ECM');
		$data = $this->model_ecmnote->get( $id );
        $fields = $this->model_ecmnote->fields( TRUE );
              
        $this->template->assign( 'id', $id );
		$this->template->assign( 'ecmnote_fields', $fields );
		$this->template->assign( 'data', $data );
		$this->template->assign( 'table_name', 'Ecmnote' );
		$this->template->assign( 'template', 'show_ecmnote' );
		$this->template->display( 'frame_admin.tpl' );
    }

#######################################################################################################################
#                                           Create new ECM Note                                                       #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('ecmnote');
        }
        
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'ecmnote', lang('ecmnote'), 'required|max_length[45]' );
            $this->form_validation->set_rules( 'comment', lang('comment'), 'required' );

            if ( $this->form_validation->run() )
            {
                $data_post['ecmnote'] = $this->input->post( 'ecmnote' );
                $data_post['comment'] = $this->input->post( 'comment' );
                $data_post['project_id'] = $_SESSION['project_id'];
                
                if( $this->model_ecmnote->dupcheck($data_post['ecmnote']) )
                {
                    $id = $this->model_utilities->insert( 'ecmnote', $data_post );
                    $_SESSION['messages'] = "Update Successful";
                    redirect( 'ecmnote/edit/' . $id );
                }
                else
                {
                    
                    $this->information['errors'] = "ECM Note ".$data_post['ecmnote']. " already exsists in project.";
                }
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }
        
        $this->information['who'] = '';
        $this->information['title'] = 'Create New ECM Note';
        
        $this->data['ecmnote'] = $this->form_validation->set_value('ecmnote', $data_post['ecmnote']);
        $this->data['comment'] = $this->form_validation->set_value('comment', $data_post['comment']);
        
        $this->template->assign( 'ecmnote_fields', $this->model_ecmnote->fields() );
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data );
        
        $this->_render_page('form_ecmnote.tpl');
    }

###################################################################################################
#                                   Edit ECM Notes                                                #
###################################################################################################

    function edit( $id = false )
    {
        $_SESSION['tag'] = 'idecm';
        $data = $this->model_ecmnote->get( $id );
        
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'ecmnote', lang('ecmnote'), 'required|max_length[45]' );
            $this->form_validation->set_rules( 'comment', lang('comment'), 'required' );

            if ( $this->form_validation->run() )
            {
                $data_post['ecmnote'] = $this->input->post( 'ecmnote' );
                $data_post['comment'] = $this->input->post( 'comment' );

                $this->model_utilities->update( 'ecmnote', 'idecm', $id, $data_post );
                $_SESSION['messages'] = "Update Successful";

                redirect( 'ecmnote/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }
        
        $this->information['who'] = $data['ecmnote'];
        $this->information['title'] = 'Edit ECM Note ';
        
        $this->data['ecmnote'] = $this->form_validation->set_value('ecmnote', $data['ecmnote']);
        $this->data['comment'] = $this->form_validation->set_value('comment', $data['comment']);
        
        $this->template->assign( 'ecmnote_fields', $this->model_ecmnote->fields() );

        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data );
        $this->template->assign( 'action_mode', 'edit' );
        
        $this->_render_page('form_ecmnote.tpl');
    }

#######################################################################################################################
#                                          Delete ECM Note(s)                                                         #
#######################################################################################################################

    function delete( $id = FALSE )
    {
        if(!$this->ion_auth->is_admin()) //Only allowing system administrators to do this for now.
        {
            redirect('ecmnote');
        }
        $id = $this->uri->segment(3);
        $data = $this->model_ecmnote->get($id);
        if (isset($_POST) && !empty($_POST))
        {
            $post = $this->input->post('idme');

            if($this->ion_auth->delete_ecmnote($id)) //This will delete the ecmnote, pubmed, pubauth, and rules records.
            {
                $this->model_ecmnote->unlinked_molecules(); //This deletes any molecules that become orphans.
                $_SESSION['messages'] = 'ECM Note Deletion Successful';
                redirect('ecmnote');
            } 
            $this->information['errors'] = 'ECM Note Deletion Unsuccessful';
        }   
        
        $this->information['who'] = '';
        $this->information['title'] = 'Deletion of ECM Note '.$data['ecmnote'].' and ALL Linked Data. ';
        
        $this->template->assign('information', $this->information);
        $this->_render_page('biohazard.tpl');
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


