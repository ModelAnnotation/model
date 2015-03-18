<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis Simpson
 * @copyright 2015
 * @package Model Annotation Site
 * @version 1.8 Beta
 * @abstract Controller to enter PubMed documents.
 */

class Pubmed extends CI_Controller
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
		$this->load->model( 'model_pubmed' );
    }
    
#######################################################################################################################
#           Browse for PubMed XML file, get the file and pass it and ECM Note to model for DB insertion.              #
#######################################################################################################################

    function index()
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('ecmnote');
        }
        
        $this->form_validation->set_rules( 'idecm', 'ECM Note','required|max_length[5]|greater_than[0]' );
        $this->form_validation->set_message('greater_than', 'ECM Note is Required');
        
        if (isset($_POST) && !empty($_POST))
        {
            $this->load->library('upload',$config);
            
            $data_post['idecm'] = $this->input->post( 'idecm' );
            $data_post['project_id'] = $this->project_id;
            
                $config['upload_path']   = 'uploads/';
                $config['allowed_types'] = 'xml';
                $config['max_size']      = '5000';
                $config['file_type']     = 'text/jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->do_upload();
                
                $upload_data =  $this->upload->data();
                $fname = $upload_data['full_path'];

                if(empty($fname) )  /* Make sure PubMed XML file exsists */
                {
                    $this->information['errors'] = 'Please Select PubMed XML File to Upload';
              		
                }
                elseif ( $this->form_validation->run() == FALSE ) /* Make sure ECM Note exsists */
                {
                    $xml = simplexml_load_file($fname)->PubmedArticle->MedlineCitation;
                    $id = $this->model_pubmed->xml3array($xml,$data_post,$fname);
                    redirect('pubmed/upload_result/'.$id);
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    
                    $this->information['errors'] = validation_errors();
                }
        }
        $this->information['title'] = 'Select PubMed XML File and ECM Note to Associate';
        $this->information['who'] = $this->uri->segment(3);
        
        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );
        $this->template->assign( 'information', $this->information );
        
        $this->_render_page( 'select_file.tpl' );
    }

#######################################################################################################################
#    Returns a List of all Publications Associated with a given Molecule.  Information looked up by finding all       #
#    rules then ECM Notes for a molecule.                                                                             #
#######################################################################################################################

    function mol_pub($k, $page = 0)
    {
        $this->load->model('model_rules');
        $this->model_utilities->pagination( FALSE );
        $idecm = $this->model_rules->find_mol_idecm( $k );

        if($idecm != NULL)
        {
            $t = 'mol_pub';
            $data = $this->model_pubmed->search( $idecm, $t );
        }
        else
        {
            $data = $idecm;
        }
        
        $this->information['title'] = 'Publications Associated with ';
        $this->information['who'] = $this->uri->segment(3);
        $this->information['tag'] = $this->uri->segment(3);
        
        $this->template->assign( 'pager', $this->model_pubmed->pager );
        $this->template->assign( 'metadata', $this->model_pubmed->metadata() );
        $this->template->assign( 'data', $data );
        $this->template->assign( 'information', $this->information );
        
        $this->_render_page( 'list_mol_pub.tpl' );
    }
    
#######################################################################################################################
#               This function is designed to list out all publications associated with an ECM note.                   #
#               Gets input from the form that lists all rules associated with an ECM.                                 #
#######################################################################################################################

    function pub_list($id, $page = 0)
    {
        $this->model_utilities->pagination( TRUE );
        $t = $this->session->userdata('tag');
        if ($t == FALSE)
        {
            $t = 'M';
        }
        
        $data = $this->model_pubmed->search( $id, $t );
        
        $this->information['title'] = 'Publications Associated with ECM Note ';
        $this->information['who'] = $data[0]['ecmnote'];
        
        $this->template->assign( 'pager', $this->model_pubmed->pager );

        $this->template->assign( 'metadata', $this->model_pubmed->metadata() );
        $this->template->assign( 'information', $this->information );
        $this->template->assign( 'data', $data );
        
        $this->_render_page( 'list_mol_pub.tpl' );
    }

###################################################################################################
#               Sends the uploaded file back to the web page.  Shows upload success               #
###################################################################################################

    function upload_result($id)
    {
        $d = $this->model_pubmed->get($id);

        $this->template->assign('data',$d); 
     
        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );
        $this->template->assign('information', $this->information);

  		$this->_render_page( 'select_file.tpl' );
    }

###################################################################################################
#                   Checks for Duplicate PubMed records prior to upload.                          #
###################################################################################################

    function duplicate()
    {
        $this->information['errors'] = 'PubMed Record in Database';
        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );
        $this->template->assign('information', $this->information);

  		$this->_render_page( 'select_file.tpl' );
    }
    
###################################################################################################
#               Passes paramaters to our Delete function in Utilities Model                       #
###################################################################################################

    function delete( $id = FALSE )
    {
        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
            
                $this->model_utilities->delete('pubmed', 'id', $id );
                redirect( $_SERVER['HTTP_REFERER'] );
            break;

            case 'POST':
            
                $this->model_utilities->delete('pubmed', 'id', $this->input->post('delete_ids') );
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


?>