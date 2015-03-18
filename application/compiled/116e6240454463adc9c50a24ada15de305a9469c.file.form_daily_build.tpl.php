<?php /* Smarty version Smarty-3.1.17, created on 2015-03-13 10:12:41
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\form_daily_build.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2516654ecd69ea5d398-71552465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '116e6240454463adc9c50a24ada15de305a9469c' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\form_daily_build.tpl',
      1 => 1426255917,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2516654ecd69ea5d398-71552465',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ecd69eaf1ab9_11736474',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'action_mode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ecd69eaf1ab9_11736474')) {function content_54ecd69eaf1ab9_11736474($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/daily_build/create' >Enter New Build Record</a>
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


    <div class="row form-group col-md-12">
        <textarea class="form-control" rows="13" id="focusedInput" placeholder="Enter Notes About This File"  name="notes" ><?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?><?php echo $_smarty_tpl->tpl_vars['data']->value['notes'];?>
<?php }?></textarea>
    </div>
    
    <?php if ($_smarty_tpl->tpl_vars['action_mode']->value!=='create') {?>
        <?php if ($_smarty_tpl->tpl_vars['data']->value['file_link']) {?>
            <div class="row">
                <div class="col-md-5"><h4>The Build File for This Date is <?php echo $_smarty_tpl->tpl_vars['data']->value['file_link'];?>
</h4></div>
                
                <div class="col-md-2 pull-left">
                    <a href="index.php/daily_build/download_file/<?php echo $_smarty_tpl->tpl_vars['data']->value['file_link'];?>
"><img src="stylesheets/images/download-icon.gif" alt="Download Build File" /></a>
                    <a href="index.php/daily_build/display_file/<?php echo $_smarty_tpl->tpl_vars['data']->value['file_link'];?>
" target="_blank"><img src="stylesheets/images/File_Open_sm.png" alt="View File" /></a>
                </div>
            </div>
        <?php } else { ?>
            <div class="row form-group">
                <label id="file_input"><h4>Select Daily Build File</h4></label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
        <?php }?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['action_mode']->value=='create') {?>
            <div class="row form-group">
                <label id="file_input">Select Daily Build File</label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
    <?php }?>

            <br />
           
            <div class="row">
                <button class="btn btn-warning btn-lg btn-block" type="post">
                    <img src="stylesheets/images/icons/tick.png" alt="Save Build Record"/> Save Daily Build Record
                </button>
            </div>

    <?php if ($_smarty_tpl->tpl_vars['data']->value['file_link']==true) {?>
            <div class="row">
                <button formmethod="post" formaction="index.php/daily_build/delete_file/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn btn-danger btn-lg btn-block"  type="submit">
                    <img src="stylesheets/images/delete.png" alt="Delete Uploaded File"> Delete Uploaded File
                </button>
            </div>
    <?php }?>

            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
                
<?php echo form_close();?>
<?php }} ?>
