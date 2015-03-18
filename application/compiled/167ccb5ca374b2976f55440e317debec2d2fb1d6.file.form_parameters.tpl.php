<?php /* Smarty version Smarty-3.1.17, created on 2015-03-14 13:45:47
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_parameters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2783155021f83b3e4b8-58296510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '167ccb5ca374b2976f55440e317debec2d2fb1d6' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_parameters.tpl',
      1 => 1426353941,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2783155021f83b3e4b8-58296510',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55021f83b9ff56_96815322',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55021f83b9ff56_96815322')) {function content_55021f83b9ff56_96815322($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/parameters' >List Parameters</a>
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
        <label class="col-md-2 control-label">Parameter:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Parameter Name" type="text" maxlength="50" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['parameter'];?>
<?php }?>" name="parameter" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Value:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Parameter Value" type="text" maxlength="15" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
<?php }?>" name="value" />
        </div>
    </div>

    <br />      
    <div class="form-group">
        <label class="col-md-2 control-label">Description:</label>
        <div class="col-md-10">
            <textarea class="form-control"  rows="5" id="focusedInput" placeholder="Enter Comments" name="description" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
<?php }?></textarea>
        </div>
    </div>

                
    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Parameter
        </button>
    </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div><!----- Horizontal Form ----->
<?php echo form_close();?>
                
<?php }} ?>
