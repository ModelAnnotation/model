<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 10:12:52
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_doi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2647354f9f73f6c8e68-95716219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3babffd60994df63c4263fde439a77a8055a74b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_doi.tpl',
      1 => 1426255947,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2647354f9f73f6c8e68-95716219',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f9f73f78c383_15167824',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'action_mode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9f73f78c383_15167824')) {function content_54f9f73f78c383_15167824($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/doi/create' >Add New External Link</a>
                </div>
            <?php }?>
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

    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label">External Link</label>
            <div class="col-md-9">
                <input placeholder="Enter the Full URL" class="form-control" type="text"  value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['doi'];?>
<?php }?>" name="doi" />
            </div>
        </div>
    
        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Data
            </button>
        
            <?php if ($_smarty_tpl->tpl_vars['action_mode']->value=='edit') {?>
                <button formmethod="post" formaction="index.php/doi/delete/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn btn-danger btn-lg btn-block" type="submit">
                    <img src="stylesheets/images/delete.png" alt="Delete"> Delete Record
                </button>
            <?php }?>
        </div>
        
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>
     
<?php }} ?>
