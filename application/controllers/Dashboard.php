<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 1.7 Beta
 * @package Model Annotation Site
 * @abstract This is the main controller for the Model Annotation Site.  Also handles the display of the Enhanced Contact Map Images.
 */

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        /**
         * Make sure User is logged in.
         */
		if (!$this->ion_auth->logged_in())
        {
			redirect('/auth', 'refresh');
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
         
        if(isset($_SESSION['messages'])) //If there are any messages to display pass them to the page object.
        {
            $this->information['messages'] = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }
        if(isset($_SESSION['errors']))
        {
            $this->information['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
	}

#######################################################################################################################
#                                    Loads Welcome Page and Selects Project                                           #
#######################################################################################################################

	function index($id = FALSE, $page = 0)
	{
        $this->form_validation->set_rules( 'project_id', 'Project','required|max_length[4]|integer|greater_than[0]' );
        
       $this->load->model('model_projects');

       $this->data['fields'] = $this->model_projects->fields();
       $this->data['related_projects'] = $this->model_utilities->related_projects();
       
        if ( $this->form_validation->run() )
        {
            $_SESSION['project_id'] = $this->input->post( 'project_id' );
            $_SESSION['project_name'] = $this->model_projects->get( $this->input->post( 'project_id' ))['name'];
            redirect( 'dashboard/' );
        }
        else
        {
            $_SESSION['errors'] = validation_errors();
            
            if (isset($_SESSION['project_id']))
            {
                $this->data['name'] = $this->model_projects->get( $_SESSION['project_id'])['name'];
            }
            else
            {
                $this->model_utilities->pagination( FALSE );
                $this->data['data']= $this->model_projects->lister( $page );
            }
        }

        $this->template->assign('information', $this->information);
        $this->template->assign('data', $this->data);
        $this->_render_page('dashboard.tpl');
    }

#######################################################################################################################
#                          All Functions that contain "ECM" are usd to display FWZoom maps                            #
#######################################################################################################################
    
	function ecm_1()
	{
   		$this->template->assign( 'image', 'ecm_1' );
        $this->template->assign('information', $this->information);
   		$this->_render_page('ecm_1.tpl');
	}
    
	function ecm_2()
	{
   		$this->template->assign( 'image', 'ecm_2' );
        $this->template->assign('information', $this->information);
   		$this->_render_page('ecm_2.tpl');
	}
    
	function ecm_3()
	{
   		$this->template->assign( 'image', 'ecm_3' );
        $this->template->assign('information', $this->information);
   		$this->_render_page('ecm_3.tpl');
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

}

/* End of file dasdhboard.php */
/* Location: ./application/controllers/dasdhboard.php */