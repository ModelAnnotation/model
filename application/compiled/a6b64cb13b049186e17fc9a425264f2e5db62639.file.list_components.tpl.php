<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 13:02:01
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_components.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2616054f8d300e230d4-95797046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6b64cb13b049186e17fc9a425264f2e5db62639' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_components.tpl',
      1 => 1426266116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2616054f8d300e230d4-95797046',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f8d300ec3372_97309288',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8d300ec3372_97309288')) {function content_54f8d300ec3372_97309288($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>List of <?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/components/create' >Add Components</a>
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


<?php if (isset($_smarty_tpl->tpl_vars['data']->value[0]['component'])) {?>

    <table class="table table-striped">
        <thead>
            <th class="col-md-1"><p class="text-center">Component</p></th>
            <th class="col-md-2"><p class="text-center">Component States</p></th>
            <th class="col-md-7"><p class="text-center">Definition</p></th>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <th class="col-md-2">Actions</th>
            <?php } else { ?>
             <th> </th>
             <?php }?>
        </thead>
        <tbody>
       	    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['component'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['states'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['definition'];?>
</td>
                    <td>
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href="index.php/components/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idcomponents'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href='index.php/components/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['idcomponents'];?>
'onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                        <?php }?>
                    </td>
                </tr>
           	<?php } ?>
       	</tbody>
    </table>
    
    <div class="pagination pagination-large">
        <?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
            <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        <?php }?>
    </div>                           
                        
    <?php } else { ?>
        <div class="row">
            <div class="alert alert-danger">
                    <h1><p class="text-center">No Components Found</p></h1>
            </div>
        </div>
    <?php }?>

            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
<?php echo form_close();?>
<?php }} ?>
