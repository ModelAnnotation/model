<?php /* Smarty version Smarty-3.1.17, created on 2015-03-12 16:32:02
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_compartments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74435501f5b5edf0d2-84972227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '828411b36d1aaa17106eff37729f0c1ef36cc3fc' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_compartments.tpl',
      1 => 1426192318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74435501f5b5edf0d2-84972227',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5501f5b600a2f9_35383727',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501f5b600a2f9_35383727')) {function content_5501f5b600a2f9_35383727($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/compartments' >List Compartments</a>
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
        <label class="col-md-2 control-label">Compartment:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Compartment Name" type="text" maxlength="50" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['compartment'];?>
<?php }?>" name="compartment" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Value:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Compartment Value" type="text" maxlength="15" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
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
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Compartment
        </button>
    </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div><!----- Horizontal Form ----->
<?php echo form_close();?>
                
<?php }} ?>
