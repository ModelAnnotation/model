<?php /* Smarty version Smarty-3.1.17, created on 2015-03-05 12:26:59
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1140054ebe96e314621-06296443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2905568db2803c131506d924f66b3f8bfdf999b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\dashboard.tpl',
      1 => 1425572732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1140054ebe96e314621-06296443',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ebe96e34efb0_65430138',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'rel' => 0,
    'project_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ebe96e34efb0_65430138')) {function content_54ebe96e34efb0_65430138($_smarty_tpl) {?>  

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['project_id'])) {?>
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-10">
                    <h2>Working with Project: <?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
 </h2>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert-danger">
            <div class="row">
                <div class="col-md-12">
                    <h2><p>PLEASE SELECT A PROJECT TO EXPLORE OR ANNOTATE TO PROCEED</p></h2>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['information']->value['messages'])) {?>
    <div class="row">
        <div class="alert-info">
            <div class="row">
                <div class="col-md-12">
                    <h2><p><?php echo $_smarty_tpl->tpl_vars['information']->value['messages'];?>
</p></h2>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['errors'])&&!empty($_smarty_tpl->tpl_vars['information']->value['errors'])) {?>
    <div class="row">
        <div class="alert-danger">
            <div class="row">
                <div class="col-md-10">
                    <h2><p>Please Select a Project Before Updating.</p></h2>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php echo form_open_multipart(uri_string());?>


    <div class="row">

    	<div id="columns_holder">
    		<p>This site was designed and built by Dennis Simpson.  The site is intended to aid in the annotation of of Rule Based Models of the Cell Cycle.  It could be adapted to any mathmatical model type.
            ECM is short for Extended Contact Map.  The model presented here is an extension of <a href="http://www.ncbi.nlm.nih.gov/pubmed/23266715" target="_blank">Kesseler, et al. 2013</a>.
            The rules have been refactored for <a href="http://emonet.biology.yale.edu/nfsim/" target="_blank">NFsim</a>.  These diagrams are based on 
            <a href="http://www.ncbi.nlm.nih.gov/pubmed/21647530" target="_blank">Chylek, et al. 2011</a> 
            and follow the entity relationship nomencalture recomendations of <a href="http://www.sbgn.org/Main_Page" target="_blank">SBGN</a>.</p>
            
            <p id="t1">To use this package look at the diagrams and find a note that corresponds to a reaction of interest.  Enter that note into the search
            form.  The search will return all rules associated with a given note OR all publications used to justify the rule.  From a Rule one can find all 
            molecules (proteins) associated and all components and states of a given molecule.</p>
            <p id="t2">Not all publication links are in the database yet.</p>
    	</div>
        
        </div>
    <div class="row">
    <div class="col-md-3">
    <label class="label-info" for="project" >Select Project to Explore or Annotate:</label>
    </div>
	   <select class="form-control" name="project_id" style="width:300px" >
            <option value="0"></option>
                <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['related_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['id_project'];?>
" id="project_id"><?php echo $_smarty_tpl->tpl_vars['rel']->value['project_name'];?>
</option>
                <?php } ?>
        </select>
    </div>
        <br />
        <div class="row">
                <?php if (ISSET($_smarty_tpl->tpl_vars['project_id']->value)) {?>
                    <button class="btn btn-success btn-lg btn-block" type="post">
                        <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Select Another Project
                    </button>
                <?php } else { ?>
                    <button class="btn btn-warning btn-lg btn-block" type="post">
                        <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Select Project
                    </button>
                <?php }?>
                
              </div>  
                
    </div><!-- .row -->
<?php echo form_close();?>
<?php }} ?>
