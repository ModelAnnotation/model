<?php /* Smarty version Smarty-3.1.17, created on 2015-03-12 13:52:27
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\biohazard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3048054fe2c2ba00257-67143328%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd647a45e5d220c4739baf67293b06313ac59e03' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\biohazard.tpl',
      1 => 1426182741,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3048054fe2c2ba00257-67143328',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fe2c2ba8cc77_04234033',
  'variables' => 
  array (
    'information' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fe2c2ba8cc77_04234033')) {function content_54fe2c2ba8cc77_04234033($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['messages'])) {?>
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-10">
                    <h3>  <?php echo $_smarty_tpl->tpl_vars['information']->value['messages'];?>
</h3>
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
                    <h3>  <?php echo $_smarty_tpl->tpl_vars['information']->value['errors'];?>
</h3>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php echo form_open_multipart(uri_string());?>

        <input class="form-control hidden" id="focusedInput"  type="text" maxlength="2" value="77" name="idme" />

<div class="row alert-danger">
<div class="col-md-2 "><img src="stylesheets/images/biohazard.gif" width="100" height="100" alt="Biohazard Image"/></div>
<div class="col-md-8 "><h3>You are about to do something potentially quite hazardous.  Deletion of an ECM Note will result in deletion of all the 
PubMed documents and rules associated with this note.  If this action results in molecules that are not linked to any rules then those molecules
and their associated components as well as external links will also be removed.</h3>  <div><p class="text-center"><h1>THIS CANNOT BE UNDONE!!!</h1></p></div></div>
<div class="col-md-2 text-right"><img src="stylesheets/images/biohazard.gif" width="100" height="100" alt="Biohazard Image"/></div>
</div>

<div class="row">
    <button class="btn btn-danger btn-lg btn-block" type="post">
        <img src="stylesheets/images/delete.png" alt="Delete Record">Click to Delete
    </button>
</div>
            



<?php echo form_close();?>

<?php }} ?>
