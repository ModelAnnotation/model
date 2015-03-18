<?php /* Smarty version Smarty-3.1.17, created on 2015-03-14 10:42:20
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_rules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2271354fa2bb67db2b8-80284564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68d8f553e3cbdf0cda6b3bc2a926637538793040' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_rules.tpl',
      1 => 1426344103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2271354fa2bb67db2b8-80284564',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fa2bb69c37a4_77730534',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'rules_fields' => 0,
    'related_ecmnote' => 0,
    'rel' => 0,
    'related_molecule' => 0,
    'related_parameter' => 0,
    'related_compartment' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fa2bb69c37a4_77730534')) {function content_54fa2bb69c37a4_77730534($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h4><?php echo $_smarty_tpl->tpl_vars['information']->value['title'];?>
<?php echo $_smarty_tpl->tpl_vars['information']->value['who'];?>
</h4>
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
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Enter Rule" name="rule" /><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['rule'];?>
<?php }?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label"><?php echo $_smarty_tpl->tpl_vars['rules_fields']->value['rulenote'];?>
</label>
            <div class="col-md-10">
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Describe This Rule" name="rulenote" /><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['rulenote'];?>
<?php }?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Associated ECM Note</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="idecm" >
                    <option value=<?php echo $_smarty_tpl->tpl_vars['data']->value['idecm'];?>
></option>
                    <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_ecmnote']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php if ($_smarty_tpl->tpl_vars['data']->value['idecm']==$_smarty_tpl->tpl_vars['rel']->value['ecmnote_id']) {?> selected="selected"<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_name'];?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="text-primary pull-middleP"><p>Link additional Molecules, Paramaters, and Compartments to selected rule.</p></div>
        <div class="form-group">
            <label class="col-md-2 control-label">Link Molecule</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="idmolecule" >
                    <option value=<?php echo $_smarty_tpl->tpl_vars['data']->value['idmolecule'];?>
></option>
                    <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_molecule']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['molecule_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php if ($_smarty_tpl->tpl_vars['data']->value['molecule']==$_smarty_tpl->tpl_vars['rel']->value['molecule_id']) {?> selected="selected"<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['rel']->value['molecule_name'];?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Link Parameter</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="parameter_id" >
                    <option value=<?php echo $_smarty_tpl->tpl_vars['data']->value['parameter_id'];?>
></option>
                    <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_parameter']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['parameter_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php if ($_smarty_tpl->tpl_vars['data']->value['parameter_id']==$_smarty_tpl->tpl_vars['rel']->value['parameter_id']) {?> selected="selected"<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['rel']->value['parameter_name'];?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Link Compartment</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="compartment_id" >
                    <option value=<?php echo $_smarty_tpl->tpl_vars['data']->value['compartment_id'];?>
></option>
                    <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_compartment']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['compartment_id'];?>
"<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php if ($_smarty_tpl->tpl_vars['data']->value['compartment_id']==$_smarty_tpl->tpl_vars['rel']->value['compartment_id']) {?> selected="selected"<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['rel']->value['compartment_name'];?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
        </div>

        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">CANCEL</a>
                
</div><!----- Horizontal Form ----->
<?php echo form_close();?>
   <?php }} ?>
