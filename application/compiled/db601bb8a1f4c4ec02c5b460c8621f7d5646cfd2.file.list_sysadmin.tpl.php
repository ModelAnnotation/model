<?php /* Smarty version Smarty-3.1.17, created on 2015-03-14 19:53:22
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_sysadmin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1562854ec06a1685788-72505834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db601bb8a1f4c4ec02c5b460c8621f7d5646cfd2' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_sysadmin.tpl',
      1 => 1426377196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1562854ec06a1685788-72505834',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ec06a16fe926_03647724',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'fields' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ec06a16fe926_03647724')) {function content_54ec06a16fe926_03647724($_smarty_tpl) {?>  

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['information']->value['user']) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/sysadmin/create_user' >New User</a>
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


<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>

<table class="table table-striped">
    <thead>
        <th class="col-md-1"><h4>User</h4></th>
        <th class="col-md-1"><h4><?php echo $_smarty_tpl->tpl_vars['fields']->value['activated'];?>
</h4></th>
        <th class="col-md-2"><h4>Name</h4></th>
        <th class="col-md-3"><h4><?php echo $_smarty_tpl->tpl_vars['fields']->value['organization'];?>
</h4></th>
        <th class="col-md-1"><h4><?php echo $_smarty_tpl->tpl_vars['fields']->value['last_ip'];?>
</h4></th>
        <th class="col-md-1"><h4><?php echo $_smarty_tpl->tpl_vars['fields']->value['last_login'];?>
</h4></th>
        <th class="col-md-1"><h4>Actions</h4></th>
   	</thead>
   	<tbody>
   	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['activated'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['organization'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['last_ip'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['last_login'];?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['information']->value['permission']) {?>
                    <a href='index.php/sysadmin/edit_user/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
'><img src="stylesheets/images/edit.png" alt="Edit User" /></a>
                    <a href="index.php/sysadmin/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"onclick="return confirm('You Are About to Delete a User.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                <?php }?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>   

<?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
<div class="row">
    <div class="pagination pagination-large">
        <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

    </div>
</div>    
<?php }?>
<div class="row">
<?php } else { ?>
    <div class="alert alert-danger">
    <h1><p class="text-center">No Records Found</p></h1>
    </div>
    </div>
<?php }?>
<?php echo form_close();?>


    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php }} ?>
