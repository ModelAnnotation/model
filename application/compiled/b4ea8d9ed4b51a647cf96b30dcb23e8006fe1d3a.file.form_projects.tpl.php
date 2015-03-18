<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 14:49:31
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_projects.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3202654f668772ade78-29030826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4ea8d9ed4b51a647cf96b30dcb23e8006fe1d3a' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_projects.tpl',
      1 => 1426269481,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3202654f668772ade78-29030826',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f6687732ae84_38014238',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'fields' => 0,
    'group' => 0,
    'gID' => 0,
    'grp' => 0,
    'checked' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f6687732ae84_38014238')) {function content_54f6687732ae84_38014238($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/projects' >List All Projects</a>
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

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['errors'])) {?>
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
            <label for="name" class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['name'];?>
</label>
            <div class="col-md-10">
                <input id="name" title="Enter the name of your project." class="form-control" type="text" maxlength="50" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
<?php }?>" name="name"/>
            </div>
        </div>
    
    <div class="form-group">
        <label for="description" class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['description'];?>
</label>
        <div class="col-md-10">
            <textarea class="form-control" id="description" rows="2" placeholder="Enter a breif description of project." maxlength="350" name="description" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
<?php }?></textarea>
        </div>
    </div>
    <fieldset>
    <legend>Select Groups Project Will Reside In</legend>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
                <label class="checkbox-inline">
                    <?php $_smarty_tpl->tpl_vars['gID'] = new Smarty_variable($_smarty_tpl->tpl_vars['group']->value['id'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable(null, null, 0);?>
                                
                    <?php  $_smarty_tpl->tpl_vars['grp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['grp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['currentGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['grp']->key => $_smarty_tpl->tpl_vars['grp']->value) {
$_smarty_tpl->tpl_vars['grp']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['gID']->value==$_smarty_tpl->tpl_vars['grp']->value->id) {?>
                            <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable(' checked="checked"', null, 0);?>
                        <?php }?>
                    <?php } ?>
              
                    <input type="checkbox" name="groups[]" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" <?php echo $_smarty_tpl->tpl_vars['checked']->value;?>
/><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                </label>
            <?php } ?>
        </div>
    </div>
    </fieldset>

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="submit">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
        </button>
    </div> 
    
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div>
<?php echo form_close();?>

<?php }} ?>
