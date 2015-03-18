<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 15:40:47
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_daily_builds.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1784654ecd69c144851-91317795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da764dd812bd0114e848b4718ec1a822b2387833' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_daily_builds.tpl',
      1 => 1425930040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1784654ecd69c144851-91317795',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ecd69c1c1862_16579271',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ecd69c1c1862_16579271')) {function content_54ecd69c1c1862_16579271($_smarty_tpl) {?>

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
                    <a class="btn btn-primary" href='index.php/daily_build/create' >Upload New Build File</a>
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


<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)) {?>

    <div class="row">
        <table class="table table-striped the-table">
   	        <thead>
                <th class="col-md-2"><h3><p class="text-left">Build Date</p></h3></th>
                <th class="col-md-2"><h3><p class="text-left">Last Updated</p></h3></th>
                <th class="col-md-3"><h3><p class="text-left">Uploaded Build File</p></h3></th>
                <th class="col-md-2"><h3>Actions</h3></th>
       	    </thead>
       	    <tbody>
       	    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['created'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['updated'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['file_link'];?>
</td>
                    <td>
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href="index.php/daily_build/edit/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href='index.php/daily_build/delete/<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
'onclick="return confirm('You Are About to Delete a Record and Uploaded File.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
                        <?php }?>
                
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['file_link']==true) {?>
                            <a href="index.php/daily_build/download_file/<?php echo $_smarty_tpl->tpl_vars['row']->value['file_link'];?>
"><img src="stylesheets/images/download-icon.gif" alt="Download Build File" /></a>
                            <a href="index.php/daily_build/display_file/<?php echo $_smarty_tpl->tpl_vars['row']->value['file_link'];?>
" target="_blank"><img src="stylesheets/images/File_Open_sm.png" alt="View File" /></a>
                        <?php }?>
                    </td>
                </tr>
       	    <?php } ?>
       	    </tbody>
        </table>
    </div>
        <?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
            <div class="row">
                <div class="pagination pagination-large">
                    <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

                </div>
            </div>
        <?php }?>
        <?php } else { ?>
            <div class="row">
                <div class="alert alert-danger">
                   <h1><p class="text-center">No Records Found</p></h1>
                </div>
            </div>
        <?php }?>
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
<?php echo form_close();?>
<?php }} ?>
