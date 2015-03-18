<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 17:13:58
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_rules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2114354fa1b63d2e6e0-53031567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffb042f48174c5367bb92d979d8da1cb6ac9c884' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_rules.tpl',
      1 => 1426267290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2114354fa1b63d2e6e0-53031567',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fa1b63dbef80_07310703',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'rules_fields' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fa1b63dbef80_07310703')) {function content_54fa1b63dbef80_07310703($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/rules/create' >Enter New Rule</a>
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

<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>

<?php echo form_open_multipart(uri_string());?>


    <div class="row">
        <table class="table table-striped the-table">
   	        <thead>
                <th class="col-md-5 "><h3><p class="text-center"><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['rule'];?>
</p></h3></th>
                <th class="col-md-4"><h3><p class="text-center"><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['rulenote'];?>
</p></h3></th>
                <th class="col-md-3"><h3>Actions</h3></th>
       	    </thead>
            
       	    <tbody>
       	        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                    <tr>
                        <td class="col-md-5"><?php echo $_smarty_tpl->tpl_vars['row']->value['rule'];?>
</td>
                        <td class="col-md-4"><?php echo $_smarty_tpl->tpl_vars['row']->value['rulenote'];?>
</td>
                        <td class="col-md-3">
                            <a href="index.php/rules/showall/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/mol_sm.jpg" alt="Show Molecules" height="64" width="64"/></a>
                            <a href="index.php/parameters/ruleprams/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/parameters-512.png" alt="Show Parameters" height="64" width="64"/></a>
                            <a href="index.php/compartments/rulecomparts/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/cell_compartment.jpg" alt="Show Compartments" height="64" width="64"/></a>
                            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                                <a href="index.php/rules/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                <a href='index.php/rules/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
'onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                            <?php }?>
                        </td>
                    </tr>
       	        <?php } ?>
       	    </tbody>
        </table>
    </div>
    <?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
        <div class="row">
            <div class="pagination pagination-large">
                <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

            </div>
        </div>
    <?php }?>
<?php } else { ?>
        <div class="row">
            <div class="alert alert-danger">
                <div class="message error">
                   <h1><p class="text-center">No Records Found</p></h1>
                </div>
            </div>
        </div>
    <?php }?>
    
<?php echo form_close();?>


    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php }} ?>
