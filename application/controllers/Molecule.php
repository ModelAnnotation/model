<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 2.3
 * @abstract Controller file to enter Molecule names and definitions for BNGL and Kappa based models.
 */

class Molecule extends CI_Controller 
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

		$this->load->model( 'model_molecule' );
        $this->lang->load('auth_lang');
	}

#######################################################################################################################
#                      Output PDF List of all Molecules for selected project                                          #
#######################################################################################################################

    function pdf()
    {
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $this->model_utilities->pagination( FALSE );
        $this->information['title'] = 'List of Molecules in Selected Project';

        $this->template->assign( 'fields', $this->model_molecule->fields( TRUE ) );
        $this->template->assign('data', $this->model_molecule->lister( $page ));
        $this->template->assign( 'pager', $this->model_molecule->pager );
        $this->template->assign('information', $this->information);
        
        
        $this->template->assign( 'logged_in', $this->ion_auth->logged_in( TRUE ) );
   		$this->template->assign( 'user_id', $this->ion_auth->get_user_id());
        $this->template->assign( 'project', $_SESSION['project_name']);
        ob_start();
        $this->_render_page('list_molecule.tpl');
        $view_pdf = ob_get_clean();


        $pdfFilePath = 'Molecule.pdf';
        $pdf->WriteHTML($view_pdf);

        $pdf->Output($pdfFilePath, "I");
    }


#######################################################################################################################
#                                        Lists ALL Molecules into a Table                                             #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
        $this->information['title'] = 'List of Molecules in Selected Project';

        $this->template->assign( 'fields', $this->model_molecule->fields( TRUE ) );
        $this->template->assign('data', $this->model_molecule->lister( $page ));
        $this->template->assign( 'pager', $this->model_molecule->pager );
        $this->template->assign('information', $this->information);
        
		$this->_render_page('list_molecule.tpl');
    }

#######################################################################################################################
#                                    Show a Molecule and ALL Associated Components                                    #
#######################################################################################################################

    function showall( $id, $page = 0 )
    {
        $this->load->model('model_components');

        $this->session->set_tempdata('idmolecule', $id, 300);
        $data = $this->model_molecule->getall( $id, $page );
        $this->model_utilities->pagination( TRUE );
        
        $this->information['title'] = 'Components Associated With ';
        $this->information['who'] = $data[0]['molecule'];
        $this->template->assign( 'fields', $this->model_components->fields( TRUE ) );
        $this->template->assign( 'data', $data);
        $this->template->assign( 'pager', $this->model_molecule->pager );
        $this->template->assign( 'information', $this->information);

		$this->_render_page( 'list_components.tpl' );
    }
#######################################################################################################################
#                                       Show a Molecule and ALL External Links                                        #
#######################################################################################################################

    function showlinks( $id )
    {
        $this->load->model('model_doi');
        $this->session->set_userdata('tag', 'M');
        $this->session->set_tempdata('idmolecule', $id, 300);
        
		$data = $this->model_doi->get( $id );
        
        $this->information['title'] = 'External Links Associated with ';
        $this->information['tag'] = 'M';
        $this->information['who'] = $data[0]['molecule'];

        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule() );
        $this->template->assign( 'fields', $this->model_utilities->related_doi() );

		$this->template->assign( 'components_fields', $this->model_doi->fields( TRUE ) );
		$this->template->assign( 'data', $data );
        $this->template->assign('information', $this->information);
        
        $this->_render_page( 'show_doi.tpl' );
    }


#######################################################################################################################
#                                         Create a new Molecule Record                                                #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }
        $this->form_validation->set_rules( 'comment', $this->lang->line('edit_molecule_validation_comment_label'), 'required' );
        $this->form_validation->set_rules( 'molecule', $this->lang->line('edit_molecule_validation_molecule_label'), 'required' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                if($this->model_utilities->duplicate_check('molecule', 'molecule', $this->input->post('molecule')))
                {
                    $data_post = array(
                            'comment'       => $this->input->post('comment'),
                            'project_id'   => $_SESSION['project_id'],
                            'molecule'      => $this->input->post('molecule')
                            );
                
                    $id = $this->model_utilities->insert( 'molecule', $data_post );
                    $_SESSION['messages'] = 'Update Successful';
                    redirect( 'molecule/edit/' . $id );
                }
                else
                {
                    $this->information['errors'] = 'Molecule Name Must Be Unique';
                }
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->information['molecule_label']  = $this->lang->line('create_molecule_molecule_label');
        $this->information['who']    = $data['molecule'];
        $this->information['title']  = $this->lang->line('create_molecule_title');
        
        $this->data['molecule']     = $this->form_validation->set_value('molecule', $data_post['molecule'] );
        $this->data['comment']      = $this->form_validation->set_value('comment', $data_post['comment'] );
                
        $this->template->assign( 'fields', $this->model_molecule->fields() );
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data );
        
        $this->_render_page('form_molecule.tpl');
    }

#######################################################################################################################
#                                        Edit Molecule Name, Comments, Project                                        #
#######################################################################################################################

    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }
        
        $this->form_validation->set_rules( 'comment', $this->lang->line('edit_molecule_validation_comment_label'), 'required' );

        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post = array(
                            'comment'       => $this->input->post('comment'),
                            'project_id'    => $_SESSION['project_id']
                            );
                
                if ($this->input->post('molecule')) //Doing it this way prevents molecule name from being deleted if not updated.
                {
                    if($this->model_utilities->duplicate_check('molecule', 'molecule', $this->input->post('molecule')))
                    {
                        $data_post['molecule'] = $this->input->post('molecule');
                    }
                    else
                    {
                        $_SESSION['errors'] = 'Molecule Name Must Be Unique';
                        redirect( 'molecule/edit/' . $id );
                    }
                }
                
                $this->model_utilities->update( 'molecule', 'idmolecule', $id, $data_post );
                $_SESSION['messages'] = 'Update Successful';
                redirect( 'molecule/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->model_molecule->raw_data = TRUE;
        $data = $this->model_molecule->get( $id );
        
        $this->information['molecule_label']  = $this->lang->line('edit_molecule_molecule_label');
        $this->information['who']    = $data['molecule'];
        $this->information['title']  = $this->lang->line('edit_molecule_title');
               
        $this->data['molecule'] = "";
        $this->data['comment'] = $this->form_validation->set_value('comment', $data['comment'] );
                
        $this->template->assign( 'fields', $this->model_molecule->fields() );
        $this->template->assign('information', $this->information);
        $this->template->assign( 'data', $this->data );
        
        $this->_render_page('form_molecule.tpl');

     }

###################################################################################################
#              Delete Molecule Record, Linked Doi Record, and Compoents Records                   #
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
            if($this->ion_auth->delete_molecule($id))
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
        $this->template->assign( 'project', $_SESSION['project_name']);
        $this->template->assign( 'template', $view );
        $view_html = $this->template->display( 'frame_admin.tpl' );

		if (!$render) return $view_html;
	}

}//end of file brace.

