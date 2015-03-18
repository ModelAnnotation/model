<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 16:17:33
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\select_file.tpl" */ ?>
<?php /*%%SmartyHeaderCode:694454fcac779e80d9-44039946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80ec1dec7e7feb5291434e639afa33660f0d2dc0' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\select_file.tpl',
      1 => 1425907934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '694454fcac779e80d9-44039946',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fcac77b20917_23741144',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'related_ecmnote' => 0,
    'rel' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fcac77b20917_23741144')) {function content_54fcac77b20917_23741144($_smarty_tpl) {?>

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-8">
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


    <div class="form-group">
        <label id="file_input">File Input</label>
        <input type="file" id="file_input" name="userfile"/>
        <p class="help-block">Select PubMed XML file.</p>
    </div>
                
    <div class="form-group">
        <label id="ecm"><?php echo 'ECM Note ID';?>
</label>
        <div >
            <select class="form-control" id="ecm" name="idecm" >
                <option value="0"></option>
                <?php  $_smarty_tpl->tpl_vars['rel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_ecmnote']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rel']->key => $_smarty_tpl->tpl_vars['rel']->value) {
$_smarty_tpl->tpl_vars['rel']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rel']->value['ecmnote_name'];?>
</option>
                <?php } ?>
            </select>
        </div>
    </div>
                
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?>
        <div class="row">
            <div class="alert alert-success">
                <p><h2>Inserted Refrence:</h2></p> 
                <p><h4>
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['LastName'];?>
,&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['Initials'];?>
.&nbsp;et al. &nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['ArticleTitle'];?>
.&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['PubDate'];?>
.&nbsp;
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['Title'];?>
.&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['PubDate'];?>
,&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['Volume'];?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['Issue'])) {?>(<?php echo $_smarty_tpl->tpl_vars['data']->value['Issue'];?>
) <?php }?>:<?php echo $_smarty_tpl->tpl_vars['data']->value['MedlinePgn'];?>

                </h4></p>                
            </div>
        </div>
    <?php }?>

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
        </button>
    </div>
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                
<?php echo form_close();?>
<?php }} ?>
