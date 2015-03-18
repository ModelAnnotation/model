<?php /* Smarty version Smarty-3.1.17, created on 2015-03-14 10:37:48
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\ecm_search_results.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92454fb8bc6a50830-41110758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84f826745b9e391ea6b2632d3385e81f65f9dce6' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\ecm_search_results.tpl',
      1 => 1426343692,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92454fb8bc6a50830-41110758',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb8bc6c6b9b5_42350873',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'check' => 0,
    'rules_fields' => 0,
    'row' => 0,
    'pager' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb8bc6c6b9b5_42350873')) {function content_54fb8bc6c6b9b5_42350873($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
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
                <div class="col-md-5">
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
                <div class="col-md-5">
                    <h3>  <?php echo $_smarty_tpl->tpl_vars['information']->value['errors'];?>
</h3>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php echo form_open_multipart(uri_string());?>


<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>
    <?php $_smarty_tpl->tpl_vars["check"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[0]['rule'], null, 0);?>
<?php }?>

  <?php if (!empty($_smarty_tpl->tpl_vars['check']->value)) {?>

        <table class="table table-striped">
            <thead>
                <th class="col-md-5"><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['rule'];?>
</th>
                <th class="col-md-5"><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['rulenote'];?>
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
				        <td class="col-md-5"><?php echo $_smarty_tpl->tpl_vars['row']->value['rule'];?>
</td>
				        <td class="col-md-5"><?php echo $_smarty_tpl->tpl_vars['row']->value['rulenote'];?>
</td>
                        <td class="col-md-2">
                            <a href="index.php/rules/showall/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/mol_sm.jpg" alt="Show Molecules" /></a>
                            <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                                <a href="index.php/rules/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['idrules'];?>
"><img src="stylesheets/images/edit.png" alt="Edit Rule" /></a>
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
    <h1><p class="text-center">No Rules Found</p></h1>
    </div>
    </div>
<?php }?>

        <div class="row">
              
                <button class="btn btn-primary btn-lg btn-block"
                    <input type="button" value="Show Associated Publications" onclick="location.href='index.php/pubmed/pub_list/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
';"/>
                    <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Publications
                </button>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
                  
        </div>

<?php echo form_close();?>
<?php }} ?>
