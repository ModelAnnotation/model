<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      Dennis A. Simpson
 * @copyright   2015
 * @version     2.1 Beta
 * @abstract    Controller file for contact maps and search routines.  Since all functions provided by this
 *              controller are availble to all user groups as long as they are logged in, we do not capture
 *              the group_id.
 */

Class ECM extends CI_Controller
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
    
		$this->load->model( 'model_ecm' );
        $this->template->assign( 'related_projects',$this->model_utilities->related_projects() );

    }
    
    function index() //Sets up the display of the ECM's
    {
        $this->template->assign( 'template', 'ECM' );
		$this->template->display( 'frame_admin.tpl' );
    }

/**
 * The search section receives the search paramater from the ECM figure through the URI.  This is passed to the model
 * to pull the relavent records from the database.  The array contining this information is then passed to a view template.
 */
 
    function search($id = false)
    {
            		if ( $this->uri->segment(4) == TRUE )
                    {
                        $data_uri =$this->uri->segment(4);
                        $this->session->set_userdata('tag', 'E');
                        redirect( 'pubmed/pub_list/' . $data_uri );
                    }   
                    if ($this->uri->segment(4) == FALSE  )
                    {
                        $data_uri =$this->uri->segment(3);
                        $this->session->set_userdata('tag', 'E');
                        redirect( 'rules/ecm_rules/' . $data_uri );
                        $tag = "FALSE";
                    }
     }

}
?>