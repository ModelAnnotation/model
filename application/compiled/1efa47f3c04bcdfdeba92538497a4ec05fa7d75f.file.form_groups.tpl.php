<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 10:15:16
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_groups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2852554f765ba763572-18027585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1efa47f3c04bcdfdeba92538497a4ec05fa7d75f' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_groups.tpl',
      1 => 1426256106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2852554f765ba763572-18027585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f765ba7c5005_35289575',
  'variables' => 
  array (
    'information' => 0,
    'fields' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f765ba7c5005_35289575')) {function content_54f765ba7c5005_35289575($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/sysadmin/list_groups' >List All Groups</a>
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

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['errors'])) {?>
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
            <label for="name" class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['group_name'];?>
</label>
            <div class="col-md-10">
                <input id="group_name" title="Enter the name of your group." class="form-control" type="text" maxlength="50" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['group_name'];?>
<?php }?>" name="group_name"/>
            </div>
        </div>
    
    <div class="form-group">
        <label for="description" class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['description'];?>
</label>
        <div class="col-md-10">
            <textarea class="form-control" id="description" rows="2" placeholder="Enter a breif description this working group." maxlength="350" name="description" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
<?php }?></textarea>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <label class="checkbox-inline">
                <input type="checkbox"  id="A1" value="1" name="protect"<?php if ($_smarty_tpl->tpl_vars['data']->value['protect']==1) {?> checked="checked"<?php }?> /><?php echo $_smarty_tpl->tpl_vars['fields']->value['protect'];?>

            </label>
        </div>
    </div>

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="submit">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
        </button>
    </div> 
    
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
            
<?php echo form_close();?>

<?php }} ?>
