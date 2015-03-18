<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 12:57:19
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_molecule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2567854ecf04fc1b467-24949121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '083c2e0e0367bf353bbd2fb29c2d5851ddbe74d6' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_molecule.tpl',
      1 => 1426265787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2567854ecf04fc1b467-24949121',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ecf04fc80d87_34386013',
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
<?php if ($_valid && !is_callable('content_54ecf04fc80d87_34386013')) {function content_54ecf04fc80d87_34386013($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/molecule/create' >Enter New Molecule</a>
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
        <table class="table table-striped">
   	        <thead>
                <th class="col-md-1"><h3><?php echo $_smarty_tpl->tpl_vars['fields']->value['molecule'];?>
</h3></th>
                <th class="col-md-7"><h3><p class="text-center">Notes</p></h3></th>
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
                            <a href='index.php/molecule/showall/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
'><img src="stylesheets/images/catel.png" alt="Show Components" /></a>
                            <a href='index.php/molecule/showlinks/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
'><img src="stylesheets/images/link_sm.jpg" alt="External Links" /></a>
                            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                                <a href='index.php/molecule/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
'><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                <a href='index.php/molecule/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['idmolecule'];?>
' onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
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
            <p>No Records Found</p>
        </div>
    </div>
        
<?php echo form_close();?>

<?php }?>
    </div><!-- row -->
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>

<?php }} ?>
