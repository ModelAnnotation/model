<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 13:11:08
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_parameters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2260955021d849939a1-73669759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ace98fa1feaffbd0901757c000002991a8b7a534' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_parameters.tpl',
      1 => 1426266655,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2260955021d849939a1-73669759',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55021d84a186c3_16390273',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'fields' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55021d84a186c3_16390273')) {function content_55021d84a186c3_16390273($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-9">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-3 pull-right">
                    <a class="btn btn-primary" href='index.php/parameters/create' >Enter New Parameters</a>
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
            <th class="col-md-2"><?php echo $_smarty_tpl->tpl_vars['fields']->value['compartment'];?>
</th>
            <th class="col-md-7"><?php echo $_smarty_tpl->tpl_vars['fields']->value['description'];?>
</th>
            <th class="col-md-1"><?php echo $_smarty_tpl->tpl_vars['fields']->value['value'];?>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['parameter'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['description'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['value'];?>
</td>
                    <td>
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href="index.php/parameters/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><img src="stylesheets/images/edit.png" alt="Edit Record" /></a>
                            <a href="index.php/parameters/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
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
