<?php /* Smarty version Smarty-3.1.17, created on 2015-03-11 19:49:38
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_ecmnote.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1868054fb839f8533a7-79171614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df7fa368e65d1e22ef9b92fe6679a6da217fa151' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_ecmnote.tpl',
      1 => 1426117767,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1868054fb839f8533a7-79171614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb839f96c7e1_92004109',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'ecmnote_data' => 0,
    'ecmnote_fields' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb839f96c7e1_92004109')) {function content_54fb839f96c7e1_92004109($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/ecmnote/create' >Enter New Note</a>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php if (isset($_smarty_tpl->tpl_vars['information']->value['messages'])) {?>
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-8">
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
                <div class="col-md-8">
                    <h3>  <?php echo $_smarty_tpl->tpl_vars['information']->value['errors'];?>
</h3>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php echo form_open_multipart(uri_string());?>

<?php if (!empty($_smarty_tpl->tpl_vars['ecmnote_data']->value)) {?>

        <table class="table table-striped">
                            	<thead>
                        			<th class="col-md-2"><h3>Note</h3></th>
                        			<th class="col-md-7"><h3 ><p class="text-center"><?php echo $_smarty_tpl->tpl_vars['ecmnote_fields']->value['comment'];?>
</p></h3></th>

                                    <th class="col-md-3"><h3>Actions</h3></th>
                            	</thead>
                            	<tbody>
                                	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ecmnote_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                        <tr>
                            				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['ecmnote'];?>
</td>
                            				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['comment'];?>
</td>

                                            <td>
                                                <a href="index.php/rules/ecm_rules/<?php echo $_smarty_tpl->tpl_vars['row']->value['idecm'];?>
"><img src="stylesheets/images/calculus.jpg" alt="Show Rules" height="64" width="90"/></a>
                                                <a href="index.php/pubmed/pub_list/<?php echo $_smarty_tpl->tpl_vars['row']->value['idecm'];?>
"><img src="stylesheets/images/pubmed.jpg" alt="Show Publications" /></a>

                                                <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                                                    <a href="index.php/ecmnote/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idecm'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                                    <a href="index.php/ecmnote/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['idecm'];?>
"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                                                <?php }?>
                                            </td>
                            		    </tr>
                                	<?php } ?>
                            	</tbody>
                            </table>
                            <div class="row">                                
                                <div class="pagination">
                                    <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

                                </div>
                            </div>
                        
                        <?php } else { ?>
                <div class="flash">
                    <div class="message error">
                        <h2><p>No Records Found</p></h2>
                    </div>
                </div>

                        <?php }?>
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php echo form_close();?>
<?php }} ?>
