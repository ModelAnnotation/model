<?php /* Smarty version Smarty-3.1.17, created on 2015-03-11 19:50:52
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_components.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1449654f8fa46c87b48-50292471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33a953b76d9cfa851099feafa478563f3dce53e4' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_components.tpl',
      1 => 1425948641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1449654f8fa46c87b48-50292471',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f8fa46d89883_30531675',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'record_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8fa46d89883_30531675')) {function content_54f8fa46d89883_30531675($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
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
        <input class="form-control hidden" id="focusedInput"  type="text" maxlength="255" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['idmolecule'];?>
<?php }?>" name="idmolecule" />

            <div class="form-group">
                <label class="col-md-2 control-label">Components</label>
                <div class="col-md-10">
                    <input class="form-control" id="focusedInput"  type="text" maxlength="255" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['component'];?>
<?php }?>" name="component" />
                </div>
            </div>
    
    	   <div class="form-group">
                <label class="col-md-2 control-label">States</label>
                <div class="col-md-10">
    	       	   <input class="form-control" type="text" id="focusedInput" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['states'];?>
<?php }?>" name="states" />
                </div>
    	   </div>
    
    	   <div class="form-group">
                <label class="col-md-2 control-label">Definition</label>
                <div class="col-md-10">
    	       	   <input class="form-control" type="text" id="focusedInput" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['definition'];?>
<?php }?>" name="definition" />
                </div>
    	   </div>

 
            <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
            
            <a class="btn btn-danger btn-lg btn-block" href="index.php/components/delete/<?php echo $_smarty_tpl->tpl_vars['record_id']->value;?>
"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');">
                <img src="stylesheets/images/delete.png" alt="Delete Record"> Don't Like It?  Click to Delete
            </a>

            </div>

            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
<?php echo form_close();?>
                
</div><!----- Horizontal Form -----><?php }} ?>
