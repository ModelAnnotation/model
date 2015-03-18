<?php /* Smarty version Smarty-3.1.17, created on 2015-03-12 12:01:25
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_rulemol.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1456254fb2abfb631a1-67018485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb6657f63c9ef5a035b1d770a374e75d764e48e1' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_rulemol.tpl',
      1 => 1426176061,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1456254fb2abfb631a1-67018485',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb2abfd10d09_39526180',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'rule' => 0,
    'related_rules' => 0,
    'rel' => 0,
    'related_molecule' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb2abfd10d09_39526180')) {function content_54fb2abfd10d09_39526180($_smarty_tpl) {?>

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

<?php echo form_open_multipart(uri_string());?>

<div class="form-horizontal">            

    	<div class="form-group">
            <label class="col-md-2 control-label">Rule</label>
    		<div class="col-md-10">
    	       	<select class="field select addr large" name="idrules" style="width:800px" >
                <?php if (!empty($_smarty_tpl->tpl_vars['rule']->value)) {?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['rule']->value['idrules'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['rule']->value['rule'];?>
</option>
                <?php } else { ?>
                    <option value=""></option>
                <?php }?>
                <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_rules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                        <option  value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['rules_id'];?>
" id="idrules"><?php echo $_smarty_tpl->tpl_vars['rel']->value['rules_name'];?>
</option>
                <?php } ?>
                </select>
    		</div>
    	</div>

    	<div class="form-group">
            <label class="col-md-2 control-label">Molecule</label>
    		<div class="col-md-10">
    	       	<select class="field select addr large" name="idmolecule" style="width:300px" >
                <option value=""></option>
                <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_molecule']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['molecule_id'];?>
" id="idmolecule"><?php echo $_smarty_tpl->tpl_vars['rel']->value['molecule_name'];?>
</option>
                <?php } ?>
                </select>
    		</div>
    	</div>

            <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
            </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">CANCEL</a>
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>

<?php }} ?>
