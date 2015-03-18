<?php /* Smarty version Smarty-3.1.17, created on 2015-03-15 00:53:26
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3003054ecc63709c538-50622407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a953bb879532105e6429a2660ab93f0b6082f94' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_users.tpl',
      1 => 1426395123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3003054ecc63709c538-50622407',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ecc6371a20f2_92928549',
  'variables' => 
  array (
    'information' => 0,
    'user' => 0,
    'fields' => 0,
    'data' => 0,
    'group' => 0,
    'gID' => 0,
    'grp' => 0,
    'checked' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ecc6371a20f2_92928549')) {function content_54ecc6371a20f2_92928549($_smarty_tpl) {?>



<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>Editing User: <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['user']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/sysadmin/list_users' >List All Users</a>
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
            <label class="col-md-2 control-label" for="user"><?php echo $_smarty_tpl->tpl_vars['fields']->value['username'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" id="user" type="text" maxlength="50" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
<?php }?>" name="username" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['first_name'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="100" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['first_name'];?>
<?php }?>" name="first_name" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['last_name'];?>
</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" maxlength="100" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['last_name'];?>
<?php }?>" name="last_name" />
                </div>
        </div>

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
                    <label class="checkbox-inline">
                        <input type="checkbox"  id="A1" value="1" name="activated"<?php if ($_smarty_tpl->tpl_vars['data']->value['activated']==1) {?> checked="checked"<?php }?> /><?php echo $_smarty_tpl->tpl_vars['fields']->value['activated'];?>

                    </label>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['phone'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="12" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];?>
<?php }?>" name="phone" />
            </div>
        </div>
    		
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['organization'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="400" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['company'];?>
<?php }?>" name="company" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['email'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="40" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
<?php }?>" name="email" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['password'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="password" maxlength="40" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['password'];?>
<?php }?>" name="password" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['fields']->value['password_confirm'];?>
</label>
            <div class="col-md-10">
                <input class="form-control" type="password" maxlength="40" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['password_confirm'];?>
<?php }?>" name="password_confirm" />
            </div>
        </div>    

        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
            </button>
        </div>

        <div class="row">
            <button formmethod="post" formaction="index.php/sysadmin/delete/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn btn-danger btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/delete.png" alt="Delete User Credentials"> Delete User
            </button>
        </div>
 
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                    
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>

<?php }} ?>
