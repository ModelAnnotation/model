<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 17:13:49
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_projects.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2646954f6168add9ad2-09164675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5b905397ec23bf76ff1dbe62cf799ea351d74aa' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_projects.tpl',
      1 => 1426281151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2646954f6168add9ad2-09164675',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f6168ae85909_78783082',
  'variables' => 
  array (
    'information' => 0,
    'data' => 0,
    'fields' => 0,
    'row' => 0,
    'guest' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f6168ae85909_78783082')) {function content_54f6168ae85909_78783082($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/projects/create' >Enter New Project</a>
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
            <th><?php echo $_smarty_tpl->tpl_vars['fields']->value['name'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['fields']->value['description'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['fields']->value['created'];?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['fields']->value['modified'];?>
</th>
            <th width="80">Actions</th>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['created'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['modified'];?>
</td>
                    <td width="80">
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href="index.php/projects/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <?php if (!$_smarty_tpl->tpl_vars['information']->value['user']) {?>
                                <a href="index.php/projects/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                            <?php }?>
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
