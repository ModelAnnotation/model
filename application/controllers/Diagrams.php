<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis Simpson
 * @copyright 2015
 * @version  0.5
 * @abstract Controller to handle the upload of diagrams and writing new drop-down menu items.  This is going to evolve.
 */

class Diagrams extends CI_Controller
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
        /**
         * Some functions that are specific to this entire contrller.
         */
        $this->lang->load( 'auth_lang');
		$this->load->model( 'model_diagrams' );
		$this->load->model( 'model_projects' );  /** Not sure this is required */
        $this->load->helper( 'date');
        $this->filepath = upload_base;

    }

#######################################################################################################################
#                                 List all Diagrams for Selected Project.                                             #
#######################################################################################################################

    function index( $page = 0 )
    {
        $tag = $this->session->flashdata('tag');
        $p_data = $this->model_projects->get( $_SESSION['project_id'] );
        $this->model_utilities->pagination( TRUE );
        $data = $this->model_diagrams->lister( $page );

        if( $tag == 'D')
        {
            $this->template->assign( 'tag', $tag );
        }
        $this->information['title'] = 'List of Diagram Files for Working Project';
        $this->information['who'] = '';
        
        $this->template->assign( 'pager', $this->model_diagrams->pager );
		$this->template->assign( 'data', $data );
		$this->template->assign( 'p_data', $p_data );
        $this->template->assign( 'information', $this->information);
        
		$this->_render_page('list_diagrams.tpl');
    }

#######################################################################################################################
#                                            Upload a new Diagram                                                     #
#######################################################################################################################

    function diagram_upload()
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('/');
        }
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'description', 'Notes', 'required' );

            $config['upload_path']   = $this->model_utilities->directory_check();
            $config['allowed_types'] = 'svg|jpg'; /** @todo SVG only?? **/
            $config['max_size']      = '10000';
            $config['file_type']     = 'image';
            $config['file_name']     = now();
                    
            $this->load->library('upload',$config);
            
            $this->upload->do_upload();
                    
            $upload_data =  $this->upload->data();

            $data_post['description']   = $this->input->post( 'description' );
            $data_post['project_id']    = $_SESSION['project_id'];
            $data_post['uploaded']      = date('Y-m-d H:i:s');

            if(isset($upload_data['client_name']))
                {
                    $data_post['filename']  = $config['file_name'].'.'.pathinfo($upload_data['client_name'])['extension'];
                }
            if ( $this->form_validation->run() )
                {
                    $insert_id = $this->model_utilities->insert( 'diagrams', $data_post );
                    $_SESSION['messages'] = 'Diagram Upload Successful!';
					redirect( 'diagrams' );   
                }
                else
                {
                    $this->information['errors'] = validation_errors();
                
            		$this->template->assign( 'data', $data_post );
        		    $this->template->assign( 'record_id', $id );
                }
        }
        $data = $this->model_diagrams->get( $id );
        
        $tag = $this->session->flashdata('tag');
        $this->information['title'] = 'Upload a new diagram.';
        $this->information['who'] = $data['created'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'tag', $tag );
        $this->template->assign( 'data', $data );
        
        $this->_render_page('form_diagrams.tpl');
    }


#######################################################################################################################
#                                           Edit Diagram Record                                                       #
#######################################################################################################################

    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('diagrams');
        }
        $data = $this->model_diagrams->get( $id );
                
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'description', 'Notes', 'required' );
            
            if ($data['filename'] == FALSE)
                {
                    $config['upload_path']   = $this->model_utilities->directory_check();
                    $config['allowed_types'] = 'svg|jpg';
                    $config['max_size']      = '10000';
                    $config['file_type']     = 'image';
                    $config['file_name']     = now(); //The file extension might need to be changed.
                    
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    
                    $upload_data =  $this->upload->data();
                }

            $data_post['description'] = $this->input->post( 'description' );
				
            if(isset($upload_data['client_name']))
            {
                $data_post['filename']  = $config['file_name'].'.'.pathinfo($upload_data['client_name'])['extension'];
            }
            if ( $this->form_validation->run() )
            {
                $this->model_utilities->update( 'diagrams', 'diagram_id', $id, $data_post );
                $_SESSION['messages'] = 'Update to Diagram Record Successful!';
				redirect( 'diagrams/edit/' . $id );   
            }
            else
            {
                $this->information['errors'] = validation_errors();

                $this->template->assign( 'data', $data_post );
            }
        }
        $tag = $this->session->flashdata('tag');
        $this->information['mode'] = 'edit';
        $this->information['title'] = 'Edit Diagram Information for ';
        $this->information['who'] = $data['filename'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'tag', $tag );
        $this->template->assign( 'data', $data );
        
        $this->_render_page('form_diagrams.tpl');
        
    }

#######################################################################################################################
#                            Deletes ONLY the Uploaded File From the Diagrams Record                                  #
#######################################################################################################################

    function delete_file($id = FALSE)
    {
        $file = $this->model_diagrams->get( $id )['filename'];

        if($this->model_utilities->delete_file($file))
        {
            $_SESSION['messages'] = 'File Deletion Successful!  You Can Now Upload a New File.';
        }
        else
        {
            $_SESSION['errors'] = 'File Not Found On Server; Database Link Removed.  Upload New File or Delete Record.';
        }
        
        $data['filename']  = '';
        $this->model_utilities->update('diagrams', 'diagram_id', $id, $data );
        redirect( 'diagrams/edit/'.$id );
    }

###################################################################################################
#                          Delete a Diagram Record and File                                       #
###################################################################################################

    function delete( $id = FALSE )
    {   
        $this->model_utilities->delete_file($this->model_diagrams->get( $id ));
        $this->model_utilities->delete('diagrams', 'diagram_id', $id );
        $_SESSION['messages'] = 'Deletion Successful.  File and Database Links Removed.';
        redirect( 'diagrams' );
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


} //End of file brace.

