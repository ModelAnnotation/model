<?php /* Smarty version Smarty-3.1.17, created on 2015-03-12 15:06:36
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\nuclear.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149575500de9cb2a064-57094529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88def10ca7e1c84128ae56137788b06d7dfa0b2b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\nuclear.tpl',
      1 => 1426187186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149575500de9cb2a064-57094529',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5500de9cb6c6f3_57314264',
  'variables' => 
  array (
    'information' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5500de9cb6c6f3_57314264')) {function content_5500de9cb6c6f3_57314264($_smarty_tpl) {?>

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

    <div class="col-md-12 alert-danger"><br />
    <h3>WARNING; You are about to go nuclear on this project!!!</h3><br />
       <img src="stylesheets/images/atomic.gif" class="image-float:right" alt="Atomic Bomb" id="nuclear">

<h3>Removal of a project from the database will result in deletion of all records in all tables 
 associated with this project.  The only data that will be perserved is the data contained in the user tables.</h3><br />
 <div><p class="text-center"><h1>THIS CANNOT BE UNDONE!!!</h1></p></div>
</div>


<div class="row">
    <button class="btn btn-danger btn-lg btn-block" type="post">
        <img src="stylesheets/images/delete.png" alt="Delete Record">Click to Delete
    </button>
</div>

<?php echo form_close();?>

<?php }} ?>
