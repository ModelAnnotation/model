<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2014
 * @version 1.0
 * @abstract This is the controler for handling the model Daily Builds.
 */
 
class Daily_build extends CI_Controller 
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
		$this->load->model( 'model_daily_build' );
		$this->load->model( 'model_projects' );
        $this->load->helper( 'date');
        #$this->filepath = '/var/models';  //location of build files on top2a.med.unc.edu.
        $this->filepath = 'C:\Program Files (x86)\Zend\Apache2\htdocs\model\uploads\\'; //location of build files on my laptop.
	}

#######################################################################################################################
#              List all Daily Build Notes for User.  System Administrators get complete list for all users.           #
#######################################################################################################################

    function index( $page = 0 )
    {
        $tag = $this->session->flashdata('tag');
        $p_data = $this->model_projects->get( $_SESSION['project_id'] );
        $this->model_utilities->pagination( TRUE );
		$data = $this->model_daily_build->lister( $page );
        
        if( $tag == 'D')
        {
            $this->template->assign( 'tag', $tag );
        }
        $this->information['title'] = 'List of Model Files for Working Project';
        $this->information['who'] = '';
        
        $this->template->assign( 'pager', $this->model_daily_build->pager );
		$this->template->assign( 'data', $data );
		$this->template->assign( 'p_data', $p_data );
        $this->template->assign( 'information', $this->information);
        
		$this->_render_page('list_daily_builds.tpl');
    }

#######################################################################################################################
#                                     Create a new Daily Build Record                                                 #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('ecmnote');
        }
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'notes', 'Notes', 'required' );

            $config['upload_path']   = $this->filepath;
            $config['allowed_types'] = 'bngl|text';
            $config['max_size']      = '5000';
            $config['file_type']     = 'text';
            $config['file_name']     = now().'.bngl'; //Rename our file. The file extension might need to be changed.
                    
            $this->load->library('upload',$config);
            $this->upload->do_upload();
                    
            $upload_data =  $this->upload->data();

            $data_post['notes']      = $this->input->post( 'notes' );
            $data_post['project_id'] = $_SESSION['project_id'];
            $data_post['user_id']    = $this->user_id;
            $data_post['created']    = date('Y-m-d H:i:s');

            if($upload_data['client_name'] == TRUE)
                {
                    $data_post['file_link']  = $config['file_name'];
                }
            if ( $this->form_validation->run() )
                {
                    $insert_id = $this->model_utilities->insert( 'daily_build', $data_post );
                    $_SESSION['messages'] = 'Update to Daily Build Record Successful!';
					redirect( 'daily_build' );   
                }
                else
                {
                    $this->information['errors'] = validation_errors();
                
            		$this->template->assign( 'data', $data_post );
        		    $this->template->assign( 'record_id', $id );


                }

        }
        $data = $this->model_daily_build->get( $id );
        
        $tag = $this->session->flashdata('tag');
        $this->information['title'] = 'Enter a New Daily Build Record';
        $this->information['who'] = $data['created'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'tag', $tag );
        $this->template->assign( 'data', $data );
        
        $this->_render_page('form_daily_build.tpl');

    }

#######################################################################################################################
#                                              Edit Daily Build                                                       #
#######################################################################################################################

    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('ecmnote');
        }
        $data = $this->model_daily_build->get( $id );
                
        if (isset($_POST) && !empty($_POST))
        {
            $this->form_validation->set_rules( 'notes', 'Notes', 'required' );
            
            if ($data['file_link'] == FALSE)
                {
                    $config['upload_path']   = $this->filepath;
                    $config['allowed_types'] = 'bngl|text';
                    $config['max_size']      = '5000';
                    $config['file_type']     = 'text';
                    $config['file_name']     = now().'.bngl'; //The file extension might need to be changed.
                    
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    
                    $upload_data =  $this->upload->data();
                }

            $data_post['notes'] = $this->input->post( 'notes' );
				
            if($upload_data['client_name'] == TRUE)
            {
                $data_post['file_link']  = $config['file_name'];
            }
            if ( $this->form_validation->run() )
            {
                $this->model_utilities->update( 'daily_build', 'id', $id, $data_post );
                $_SESSION['messages'] = 'Update to Daily Build Record Successful!';
				redirect( 'daily_build/edit/' . $id );   
            }
            else
            {
                $this->information['errors'] = validation_errors();

                $this->template->assign( 'data', $data_post );
            }
        }
        
        
        
        $tag = $this->session->flashdata('tag');
        $this->information['title'] = 'Edit Daily Build Information for ';
        $this->information['who'] = $data['created'];
        
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'tag', $tag );
        $this->template->assign( 'data', $data );
        
        $this->_render_page('form_daily_build.tpl');
        
    }

#######################################################################################################################
#                                   Displays a File in a New Browser Tab                                              #
#######################################################################################################################

    function display_file($file = FALSE)
    {
        #$path = rtrim($this->filepath, '/').'/';  //Linux Line
        $path = rtrim($this->filepath, "\\").'\\';  //Windows Line
        if(is_file($path.$file))
        {
            $this->output
                ->set_content_type('text/plain')
                ->set_output(file_get_contents($path.$file));
        }
        else
        {
            print_r('<h1>File Not Found</h1>');
        }
    }

#######################################################################################################################
#                                Downloads Build File to Local Computer                                               #
#######################################################################################################################

    function download_file($file =  FALSE)
    {
        $this->load->helper('download_helper');
        $this->load->helper('file');
        
        #$path = rtrim($this->filepath, '/').'/';  //Linux Line
        $path = rtrim($this->filepath, "\\").'\\';  //Windows Line
        

        if(is_file($path.$file))
        {
            $this->model_daily_build->download_file($file, $path);
            redirect( $_SERVER['HTTP_REFERER'] );
        }
        else
        {
            $_SESSION['errors'] = 'File Not Found';
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

#######################################################################################################################
#                            Deletes ONLY the Uploaded File From the Daily Build Record                               #
#######################################################################################################################

    function delete_file($id = FALSE)
    {
        if($this->model_daily_build->delete_file( $id, $this->filepath ))
        {
            $_SESSION['messages'] = 'File Deletion Successful!  You Can Now Upload a New File.';
        }
        else
        {
            $_SESSION['errors'] = 'File Not Found On Server; Database Link Removed';
        }
        
        $data['file_link']  = '';
        $this->model_utilities->update('daily_build', 'id', $id, $data );
        redirect( 'daily_build/edit/' . $id );
    }

###################################################################################################
#                               Delete a Build and its File                                       #
###################################################################################################

    function delete( $id = FALSE )
    {
        $this->model_daily_build->delete_file( $id, $this->filepath );
        $this->model_utilities->delete('daily_build', 'id', $id );
        $_SESSION['messages'] = 'Deletion Successful.  File and Database Links Removed.';
        redirect( 'daily_build' );
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


?>