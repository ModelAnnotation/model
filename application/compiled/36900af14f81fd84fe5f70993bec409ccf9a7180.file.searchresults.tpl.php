<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 12:38:34
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\searchresults.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1928054fb1580c93717-36008948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36900af14f81fd84fe5f70993bec409ccf9a7180' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\searchresults.tpl',
      1 => 1425919111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1928054fb1580c93717-36008948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb1580d8d757_93202356',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'id' => 0,
    'data' => 0,
    'rules_fields' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb1580d8d757_93202356')) {function content_54fb1580d8d757_93202356($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-12">
                <h3><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h3>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/rulemol/create/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
' >Link Molecules</a>
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

<div class="form-horizontal">
<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>
    <table class="table table-striped">
        <thead>
            <th class="col-md-1"><h3><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['molecule'];?>
</h3></th>
            <th class="col-md-7"><h3><p class="text-center">Comments</p></h3></th>
            <th class="col-md-3"><h3><p class="text-center">Actions</p></h3></th>
        </thead>
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['molecule'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['comment'];?>
</td>
                    <td>
                        <a href='index.php/rules/find_molrules/<?php echo $_smarty_tpl->tpl_vars['row']->value['molecule'];?>
'><img src="stylesheets/images/calculus.jpg" alt="Show Rules" height="64" width="90"/></a>
                        <a href='index.php/pubmed/mol_pub/<?php echo $_smarty_tpl->tpl_vars['row']->value['molecule'];?>
'><img src="stylesheets/images/books_sm.png" alt="Show Publications" /></a>
                        <a href="index.php/molecule/showall/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
"><img src="stylesheets/images/catel.png" alt="Show Components" /></a>
                        <a href='index.php/molecule/showlinks/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
'><img src="stylesheets/images/link_sm.jpg" alt="External Links" /></a>
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href='index.php/molecule/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
'><img src="stylesheets/images/edit.png" alt="Edit Molecule" /></a>
                            <a href="index.php/rulemol/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrulemol'];?>
"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Molecule from Rule" /></a>
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
            <div class="message error">
                <h2><p>No Records Found</p></h2>
            </div>
        </div>
    <?php }?>
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php }} ?>
