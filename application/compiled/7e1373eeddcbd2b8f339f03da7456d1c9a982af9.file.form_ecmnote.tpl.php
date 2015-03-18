<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 13:34:05
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_ecmnote.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2662254fc74d71337b3-00343537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e1373eeddcbd2b8f339f03da7456d1c9a982af9' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_ecmnote.tpl',
      1 => 1426268033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2662254fc74d71337b3-00343537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fc74d740a155_39406740',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'ecmnote_fields' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fc74d740a155_39406740')) {function content_54fc74d740a155_39406740($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/ecmnote/create' >Enter New Note</a>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['messages'])) {?>
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-5">
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
                <div class="col-md-5">
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
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['ecmnote_fields']->value['ecmnote'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" id="focusedInput" type="text" maxlength="140" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['ecmnote'];?>
<?php }?>" name="ecmnote"/>
            </div>   		
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['ecmnote_fields']->value['comment'];?>
</label>
            <div class="col-md-10">
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Short Description Of This Note"  name="comment" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
<?php }?></textarea>
            </div>
        </div>
        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
        </div>
        <?php }?>
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>


<?php }} ?>
