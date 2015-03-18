<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 11:55:04
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_groups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:420854f75850b16ff7-06995736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d75efe8547a692d838e4d0b74d5f66539f4e795' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_groups.tpl',
      1 => 1426262100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '420854f75850b16ff7-06995736',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f75850b94015_91658523',
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
<?php if ($_valid && !is_callable('content_54f75850b94015_91658523')) {function content_54f75850b94015_91658523($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>List of <?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/sysadmin/create_group' >Enter New Group</a>
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

<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>
    <table class="table table-striped">
        <thead>
            <th class="col-md-4">Group Name</th>
            <th class="col-md-4"><?php echo $_smarty_tpl->tpl_vars['fields']->value['description'];?>
</th>
            <th class="col-md-2">Actions</th>
        </thead>
                        
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['description'];?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['information']->value['permission']) {?>
                            <a href="index.php/sysadmin/edit_group/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href="index.php/sysadmin/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                        <?php }?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
        <div class="pagination pagination-large">
            <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        </div>     
    <?php }?>
                
    <?php } else { ?>
        <div class="alert alert-danger">
            <h1><p class="text-center">No Records Found</p></h1>
        </div>
    <?php }?>
    
<?php echo form_close();?>


    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php }} ?>
