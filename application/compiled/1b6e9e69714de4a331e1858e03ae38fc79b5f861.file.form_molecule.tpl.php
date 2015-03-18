<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 10:16:20
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_molecule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:973754f8b4f7cfee70-36891753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b6e9e69714de4a331e1858e03ae38fc79b5f861' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_molecule.tpl',
      1 => 1426256173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '973754f8b4f7cfee70-36891753',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f8b4f7daac97_95185359',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'fields' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8b4f7daac97_95185359')) {function content_54f8b4f7daac97_95185359($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/molecule' >List Molecules</a>
            </div>
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
        <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['information']->value['molecule_label'];?>
:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" type="text" maxlength="255" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['molecule'];?>
<?php }?>" name="molecule"/>
        </div>
    </div>
    <br />      
    <div class="form-group">
        <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['comment'];?>
:</label>
        <div class="col-md-10">
            <textarea class="form-control"  rows="5" id="focusedInput" placeholder="Short Description of Molecule or Entity"  name="comment" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
<?php }?></textarea>
        </div>
    </div>

                
    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Molecule
        </button>
    </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div><!----- Horizontal Form ----->
<?php echo form_close();?>
                
<?php }} ?>
