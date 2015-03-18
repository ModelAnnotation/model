<?php /* Smarty version Smarty-3.1.17, created on 2015-03-07 12:49:52
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\image.tpl" */ ?>
<?php /*%%SmartyHeaderCode:813854fb2c30c0f663-00455469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04807ec43a5fef707cd62a87df488121a6e28000' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\image.tpl',
      1 => 1379077696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '813854fb2c30c0f663-00455469',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb2c30c8c689_06198508',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb2c30c8c689_06198508')) {function content_54fb2c30c8c689_06198508($_smarty_tpl) {?>

    <?php if ($_smarty_tpl->tpl_vars['image']->value=="ecm_1") {?> 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("lightBox", "zoom/load/config1.xml");
    		});
    	</script>   
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['image']->value=="ecm_2") {?> 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("imageDiv", "zoom/load/config2.xml");
    		});      
    	</script>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['image']->value=="ecm_3") {?> 
        <script type="text/javascript">
    		$(document).ready(function() {
    			var zoomer = new FWDZoomer("lightBox", "zoom/load/config3.xml");
    		});
    	</script>
    <?php }?>
<?php }} ?>
