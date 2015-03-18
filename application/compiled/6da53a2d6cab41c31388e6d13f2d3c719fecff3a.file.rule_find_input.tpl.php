<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 10:42:13
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\rule_find_input.tpl" */ ?>
<?php /*%%SmartyHeaderCode:233254fda8fce77fb4-17462834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6da53a2d6cab41c31388e6d13f2d3c719fecff3a' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\rule_find_input.tpl',
      1 => 1425912021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '233254fda8fce77fb4-17462834',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fda8fcf2bae4_64301556',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'rules_data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fda8fcf2bae4_64301556')) {function content_54fda8fcf2bae4_64301556($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/rules/find_rulese' >New Snippet Search</a>
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


<div class="row">
    <h4>Paste all or part of a rule into the box and click the "Find Rules" button.  This search uses the MySQL "Like" as opposed to the MySQL "Is" as part
    of the search.  In general the larger the rule snippet used the more specific the search will be.  If the search does not return the expected results
    try it again with fewer paramaters.  This search is especially useful for returning all rules associated with one or a few molecules/entities.
    </h4>
                
</div>
<div class="form-horizontal">
    <div class="form-group">
        
  		<div class="col-md-12">
            <input title="Paste or type a Rule Snippet into box." class="form-control" placeholder="Enter Rule Snippet" type="text" maxlength="400" value="<?php if (isset($_smarty_tpl->tpl_vars['rules_data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['rules_data']->value['rule'];?>
<?php }?>" name="rulesnippet" />
  		</div>
   	</div>

    <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Rule Search"> Find Associated Rules
            </button>
                        
                                            
            <span class="text_button_padding">or</span>
                <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
        </div>
    </div><!----- Horizontal Form ----->
<?php echo form_close();?>

<?php }} ?>
