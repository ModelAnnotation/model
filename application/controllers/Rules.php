<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 1.6
 * @abstract This is the controller file that handles the RULES.  This file also coordinates the ECM search functions.
 * 
 */

class Rules extends CI_Controller 
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
    
		$this->load->model( 'model_rules' );
        $this->lang->load('auth_lang');
	}

#######################################################################################################################
#                                                List all Rules                                                       #
#######################################################################################################################

    function index( $page = 0 )
    {
        $this->model_utilities->pagination( TRUE );
		$data_info = $this->model_rules->lister( $page );
        
        $this->information['title'] = 'List of All Rules in Project';
        $this->information['who'] = $id;

        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );                
        $this->template->assign( 'pager', $this->model_rules->pager );
		$this->template->assign( 'rules_fields', $this->model_rules->fields( TRUE ) );
		$this->template->assign( 'data', $data_info );
        $this->template->assign( 'information', $this->information );
        
		$this->_render_page('list_rules.tpl');
    }

#######################################################################################################################
#                              Show a Rule and all Molecules Associated with it.                                      #
#######################################################################################################################

    function showall( $id )
    {
        $data = $this->model_rules->getall( $id );
        $this->load->model('model_molecule');

        $this->information['title'] = 'Molecules Associated With Rule:<br>';
        $this->information['who'] = $data[0]['rule'];

        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );                
        $this->template->assign( 'related_doi', $this->model_utilities->related_doi() );                
        $this->template->assign( 'id', $id );
		$this->template->assign( 'rules_fields', $this->model_molecule->fields( TRUE ) );
		$this->template->assign( 'data', $data );

        $this->template->assign( 'information', $this->information );
        
		$this->_render_page('searchresults.tpl');
    }

#######################################################################################################################
#                                             Enter new RULES                                                         #
#######################################################################################################################

    function create( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('rules');
        }
        
        $this->form_validation->set_rules( 'rule', lang('rule'), 'required' );
        $this->form_validation->set_rules( 'idecm', lang('idecm'), 'required' );
        
        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post = array(
                        'rule'       => $this->input->post('rule'),
                        'idecm'      => $this->input->post('idecm'),
                        'rulenote'   => $this->input->post('rulenote'),
                        'project_id' => $_SESSION['project_id']
                        );
            
                $id = $this->model_utilities->insert( 'rules', $data_post );
                
                
                $rulemol['idrule'] = $id;
                $rulemol['idmolecule'] = $this->input->post('idmolecule');
                $this->model_utilities->insert('rulemol', $rulemol);
                
                $rule_params['idrule'] = $id;
                $rule_params['parameter_id'] = $this->input->post('parameter_id');
                $this->model_utilities->insert('rule_params', $rule_params);
                
                $rule_compartments['idrule'] = $id;
                $rule_compartments['compartment_id'] = $this->input->post('compartment_id');
                $this->model_utilities->insert('rule_compartments', $rule_compartments);
                
                $_SESSION['messages'] = 'Update Successful';
           	    redirect( 'rules/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->information['title'] = 'Enter A New Rule';
        $this->information['who']   = $id;
        $this->data['rule']         = $this->form_validation->set_value('rule', $this->input->post('rule') );
        $this->data['idecm']        = $this->form_validation->set_value('idecm', $this->input->post('idecm') );
        $this->data['rulenote']     = $this->form_validation->set_value('rulenote', $this->input->post('rulenote') );
        $this->data['idmolecule']   = $this->form_validation->set_value('idmolecule', $this->input->post('idmolecule') );
        $this->data['parameter_id'] = $this->form_validation->set_value('parameter_id', $this->input->post('parameter_id') );
        $this->data['parameter_id'] = $this->form_validation->set_value('parameter_id', $this->input->post('parameter_id') );

        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data);

        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );   
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule() );
        $this->template->assign( 'related_parameter', $this->model_utilities->related_parameters() );
        $this->template->assign( 'related_compartment', $this->model_utilities->related_compartments() );   
        $this->template->assign( 'rules_fields', $this->model_rules->fields() );
        
        $this->_render_page('form_rules.tpl');
    }

#######################################################################################################################
#                                                    Edit RULE.                                                       #
#######################################################################################################################

    function edit( $id = false )
    {
        if($this->ion_auth->is_guest()) //A guest user should never get this far but if they do send them packing.
        {
            redirect('molecule');
        }
        
        $data = $this->model_rules->get( $id );
        $this->form_validation->set_rules( 'rule', lang('rule'), 'required' );
        $this->form_validation->set_rules( 'idecm', lang('idecm'), 'required' );
        
        if (isset($_POST) && !empty($_POST))
        {
            if ( $this->form_validation->run() )
            {
                $data_post = array(
                        'rule'     => $this->input->post('rule'),
                        'idecm'    => $this->input->post('idecm'),
                        'rulenote' => $this->input->post('rulenote')
                        );

                $this->model_utilities->update( 'rules', 'idrules', $id, $data_post );
                
                if ($this->input->post('idmolecule'))
                {
                    $rulemol['idrules'] = $id;
                    $rulemol['idmolecule'] = $this->input->post('idmolecule');
                    $this->model_utilities->insert('rulemol', $rulemol);
                }
                
                if ($this->input->post('parameter_id'))
                {
                    $rule_params['idrules'] = $id;
                    $rule_params['parameter_id'] = $this->input->post('parameter_id');
                    $this->model_utilities->insert('rule_params', $rule_params);
                }
                
                if ($this->input->post('compartment_id'))
                {
                    $rule_compartments['idrules'] = $id;
                    $rule_compartments['compartment_id'] = $this->input->post('compartment_id');
                    $this->model_utilities->insert('rule_compartments', $rule_compartments);
                }

                $_SESSION['messages'] = 'Update Successful';
           	    redirect( 'rules/edit/' . $id );
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }

        $this->information['title']   = 'Editing Rule:</br> ';
        $this->information['who']     = $data['rule'];
        $this->data['rule']           = $this->form_validation->set_value('molecule', $data['rule'] );
        $this->data['idecm']          = $this->form_validation->set_value('molecule', $data['idecm'] );
        $this->data['rulenote']       = $this->form_validation->set_value('molecule', $data['rulenote'] );
        $this->data['idmolecule']     = $this->form_validation->set_value('idmolecule', $this->input->post('idmolecule') );
        $this->data['parameter_id']   = $this->form_validation->set_value('parameter_id', $this->input->post('parameter_id') );
        $this->data['compartment_id'] = $this->form_validation->set_value('compartment_id', $this->input->post('compartment_id') );

        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $this->data);

        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );   
        $this->template->assign( 'related_molecule', $this->model_utilities->related_molecule() );
        $this->template->assign( 'related_parameter', $this->model_utilities->related_parameters() );
        $this->template->assign( 'related_compartment', $this->model_utilities->related_compartments() );   
   
        $this->template->assign( 'rules_fields', $this->model_rules->fields() );

        $this->_render_page('form_rules.tpl');
    }

#######################################################################################################################
#   Displays search selection form, returns search value, passes search value to model_rules and returns results.     #
#   The search is designed to return either all rules associated with a given ECM Note or all publications            #
#   associated with a given ECM Note.                                                                                 #
#######################################################################################################################

    function search($id = false)
    {
        $this->form_validation->set_rules( 'ecmnote_id', 'ECM Note','required|greater_than[0]' );
        
        if (isset($_POST) && !empty($_POST))
        {
            $data_post = $this->input->post( 'ecmnote_id' );
            
            if ( $this->form_validation->run())
            {
                if ( $this->uri->segment(3) == 'pub' )
                {
                    $this->session->set_userdata('tag', 'M');
                    redirect( 'pubmed/pub_list/' . $data_post );
                }
                elseif ($this->uri->segment(3) == 'note')
                {
                    redirect( 'ecmnote/edit/' . $data_post );
                }
                else
                {
                    $this->session->set_userdata('tag', 'M');
                    redirect( 'rules/ecm_rules/' . $data_post );
                }
            }
            else
            {
                $this->information['errors'] = validation_errors();
            }
        }
        
        $this->information['title'] = 'Search for Information Associated with ECM Notes';
        $this->information['who'] = '';

        $this->template->assign( 'related_ecmnote', $this->model_utilities->related_ecmnote() );
        $this->template->assign( 'rules_fields', $this->model_rules->fields() );
        $this->template->assign('information', $this->information);
        
        $this->_render_page('searchinput.tpl');
     }

###################################################################################################
#                   Show all rules associated with a given ECM Note.                              #
###################################################################################################

    function ecm_rules($id, $page = 0)
    {
        $this->model_utilities->pagination( TRUE );
        $t = $this->session->userdata('tag');
        
        if ($t == FALSE)
        {
            $t = 'M';
        }
        $data = $this->model_rules->search( $id, $t, $page );
        
        $this->information['title'] = 'Rules Associated with ECM Note ';
        $this->information['who'] = $data[0]['ecmnote'];

        $this->template->assign( 'id', $id );
        $this->template->assign( 'pager', $this->model_rules->pager );

        $this->template->assign( 'rules_fields', $this->model_rules->fields() );
        $this->template->assign( 'information', $this->information);
        $this->template->assign( 'data', $data );
        
  		$this->_render_page('ecm_search_results.tpl');
    }

#######################################################################################################################
#                              Find All Rules Associtated with a given Molecule.                                      #
#######################################################################################################################

    function find_molrules ( $k, $page = 0 )
    {
        $tag = 'molrules';
        $this->model_utilities->pagination( TRUE );
        $data = $this->model_rules->findrules( $k, $page, $tag );
 
        $this->information['title'] = 'Rules Associated with ';
        $this->information['who'] = $k;

        $this->template->assign( 'pager', $this->model_rules->pager );
        $this->template->assign( 'rules_fields', $this->model_rules->fields() );
        $this->template->assign( 'metadata', $this->model_rules->metadata() );
        $this->template->assign( 'tag',$this->uri->segment(3));

        $this->template->assign( 'data', $data );
        $this->template->assign( 'information', $this->information);

        $this->_render_page('list_rules.tpl');
    }
    
#######################################################################################################################
#                               Find rules based on entered rule snippets.                                            #
#######################################################################################################################

    function find_rules($id = FALSE, $page = 0)
    {
        $tag = FALSE;
        $this->model_utilities->pagination( TRUE );
        
        if ($this->uri->segment(3) == FALSE  )  //This section sets up the initial search and displays the first page of results.
        {
            $rendered_page = 'rule_find_input.tpl';
            $who = '';
            
            if (isset($_POST) && !empty($_POST))
            {
                $data = $this->model_rules->findrules( $this->input->post( 'rulesnippet'), $page, $tag  );
                $who =  $this->input->post( 'rulesnippet');
                $rendered_page = 'list_rules.tpl';
            }
        }

        if ($this->uri->segment(3)  )//This section sets displays subsequent pages of results.
        {
            $who = $this->uri->segment(3);
            $rendered_page = 'list_rules.tpl';
            $data = $this->model_rules->findrules( $this->uri->segment(3), $page, $tag );
        }
            $this->information['who'] = $who;
            $this->information['title'] = 'Search For Rules by Rule Snippet ';
            
            $this->template->assign( 'pager', $this->model_rules->pager );
            $this->template->assign( 'rules_fields', $this->model_rules->fields() );
            $this->template->assign( 'information', $this->information);
            $this->template->assign('data', $data);
            
            $this->_render_page($rendered_page);
    }

###################################################################################################
#                                   Delete a RULE                                                 #
###################################################################################################

    function delete( $id = FALSE )
    {
        if($this->ion_auth->is_guest()) // A guest should never get this far but we check anyway.
        {
            redirect('rules');
        }
        $this->load->model('model_ecmnote');

        if($this->ion_auth->delete_rule($id)) //This will delete the rule and molecule links.
        {
            $this->model_ecmnote->unlinked_molecules(); //This deletes any molecules that become orphans.
            $_SESSION['messages'] = 'Rule Deletion Successful';
            redirect('rules');
        }
        else
        {
            $_SESSION['errors'] = 'Rule Deletion Unsuccessful';
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