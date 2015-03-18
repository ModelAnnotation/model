<?php /* Smarty version Smarty-3.1.17, created on 2015-03-12 10:41:46
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\show_doi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1225654f9e1565cf9a4-09327837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd444042f2ef7f45f3d6768199c0f77fffc2fdb56' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\show_doi.tpl',
      1 => 1426171071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1225654f9e1565cf9a4-09327837',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f9e15666fc48_94685409',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9e15666fc48_94685409')) {function content_54f9e15666fc48_94685409($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/doi/create' >Add New External Link</a>
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

    <?php if ($_smarty_tpl->tpl_vars['information']->value['tag']=='E') {?>
        <div class="row">
            <div class="alert alert-success">
                <h3>Inserted Link for Molecule:  <?php echo $_smarty_tpl->tpl_vars['data']->value[0]['molecule'];?>
</h3>
                <p class="text-right">
                    <a href="index.php/doi/show/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['idmolecule'];?>
"><img src="stylesheets/images/link.jpg" height="67" width="67" alt="Show All Links" /></a>
                </p>
            </div>
        </div>

    <?php }?>
    
    <?php if (!empty($_smarty_tpl->tpl_vars['data']->value[0]['iddoi'])) {?>

        <table class="table table-striped">
        
           	<thead>
                <th class="col-md-7"><h3><p class="text-center">External Link</p></h3></th>
                <th class="col-md-2"><h3>Actions</h3></th>
            </thead>
            
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
				    <tr>
                        <td class="col-md-7"><?php echo $_smarty_tpl->tpl_vars['row']->value['doi'];?>
</td>
                        <td class="col-md-2">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['doi'];?>
" target="_blank"><img src="stylesheets/images/link_sm.jpg" alt="External Link" /></a>
                            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                                <a href="index.php/doi/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['iddoi'];?>
"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
                                <a href="index.php/doi/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['iddoi'];?>
"><img src="stylesheets/images/edit.png" alt="Delete Record" /></a>
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
    <?php } else { ?>
    
    <div class="row">
        <div class="alert alert-danger">
            <h1><p class="text-center">No Records Found</p></h1>
        </div>
    </div>
    
    <?php }?>

<?php } elseif (isset($_smarty_tpl->tpl_vars['data']->value['molecule'])) {?>

    <div class="row">
        <div class="alert alert-danger">
            <h2><p class="text-center">Database Update Failed.</p></h2>
        </div>
    </div>
<?php } else { ?>

        <div class="row">
            <div class="alert alert-danger">
                <h2>No Records Found</h2>
            </div>
        </div>

<?php }?>

<a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
<?php }} ?>
