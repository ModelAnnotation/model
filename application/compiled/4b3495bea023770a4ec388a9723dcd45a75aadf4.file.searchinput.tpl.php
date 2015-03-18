<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 13:34:00
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\searchinput.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6454fdba7e643b04-39318852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b3495bea023770a4ec388a9723dcd45a75aadf4' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\searchinput.tpl',
      1 => 1426268033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6454fdba7e643b04-39318852',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fdba7e707031_72877688',
  'variables' => 
  array (
    'information' => 0,
    'related_ecmnote' => 0,
    'rel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fdba7e707031_72877688')) {function content_54fdba7e707031_72877688($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-8">
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


    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">Seclect ECM Note</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="ecmnote_id">
                    <option value=""></option>
                    <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_ecmnote']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_name'];?>
</option>
                    <?php } ?>
       	        </select>
            </div>
        </div>
    
        <div class="row">                    
            <button formmethod="post" formaction="index.php/rules/search/note" class="btn btn-primary btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="ECM Notes"> Find ECM Note
            </button>
        </div>
    
        <div class="row">
            <p class="lead text-center">OR</p>
        </div>

        <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Rule Search"> Find Associated Rules
            </button>
        </div>
    
        <div class="row">
            <p class="lead text-center">OR</p>
        </div>
                    
        <div class="row">                    
            <button formmethod="post" formaction="index.php/rules/search/pub" class="btn btn-info btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Publications"> Find Associated Publications
            </button>
        </div>

        <div class="row">   
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
        </div>
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>

<?php }} ?>
