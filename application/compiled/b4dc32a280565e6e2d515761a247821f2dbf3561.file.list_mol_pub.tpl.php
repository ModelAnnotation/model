<?php /* Smarty version Smarty-3.1.17, created on 2015-03-09 16:54:20
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\list_mol_pub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1744154fb1fb50777b6-15117829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4dc32a280565e6e2d515761a247821f2dbf3561' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\list_mol_pub.tpl',
      1 => 1425915980,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1744154fb1fb50777b6-15117829',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54fb1fb52e8846_46232551',
  'variables' => 
  array (
    'information' => 0,
    'guest' => 0,
    'data' => 0,
    'check' => 0,
    'apub' => 0,
    'apeople' => 0,
    'authors' => 0,
    'title' => 0,
    'pager' => 0,
    'tag' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fb1fb52e8846_46232551')) {function content_54fb1fb52e8846_46232551($_smarty_tpl) {?>

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
<?php $_smarty_tpl->tpl_vars["check"] = new Smarty_variable(($_smarty_tpl->tpl_vars['data']->value[0]['PMID']).($_smarty_tpl->tpl_vars['data']->value[0]['ELocationID']), null, 0);?>
<?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['check']->value)) {?>

    <table class="table table-striped"> 
     <tbody>
            <?php  $_smarty_tpl->tpl_vars['apub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['apub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['apub']->key => $_smarty_tpl->tpl_vars['apub']->value) {
$_smarty_tpl->tpl_vars['apub']->_loop = true;
?>
                <tr>
                    <td class="col-md-10">
                        <?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable(((((((((((('. ').($_smarty_tpl->tpl_vars['apub']->value['ArticleTitle'])).(' (')).($_smarty_tpl->tpl_vars['apub']->value['PubDate'])).(') ')).($_smarty_tpl->tpl_vars['apub']->value['Title'])).('. ')).($_smarty_tpl->tpl_vars['apub']->value['Volume'])).('(')).($_smarty_tpl->tpl_vars['apub']->value['Issue'])).(')')).($_smarty_tpl->tpl_vars['apub']->value['MedlinePgn']), null, 0);?>
                        
                        <?php  $_smarty_tpl->tpl_vars['apeople'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['apeople']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['apub']->value['authors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['apeople']->key => $_smarty_tpl->tpl_vars['apeople']->value) {
$_smarty_tpl->tpl_vars['apeople']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars["sauthors"] = new Smarty_variable('', null, 0);?>
                            <?php if ($_smarty_tpl->tpl_vars['apub']->value["id"]==$_smarty_tpl->tpl_vars['apeople']->value["pubmed_id"]) {?>
                                <?php $_smarty_tpl->tpl_vars["authors"] = new Smarty_variable((((' ').($_smarty_tpl->tpl_vars['apeople']->value['LastName'])).(' ')).($_smarty_tpl->tpl_vars['apeople']->value['Initials']), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["authors"] = clone $_smarty_tpl->tpl_vars["authors"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["authors"] = clone $_smarty_tpl->tpl_vars["authors"];?>
                                <?php echo $_smarty_tpl->tpl_vars['authors']->value;?>

                            <?php }?>
                        <?php } ?>
                        <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

                    </td>
                    <td class="col-md-2">
                        <a href="http://www.ncbi.nlm.nih.gov/pubmed/<?php echo $_smarty_tpl->tpl_vars['apub']->value['PMID'];?>
" target="_blank"><img src="stylesheets/images/pubmed.jpg" alt="Pubmed Link" /></a>
                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?>
                            <a href="index.php/pubmed/delete/<?php echo $_smarty_tpl->tpl_vars['apub']->value['id'];?>
" onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');" ><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
                        <?php }?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <div class="pagination pagination-large">
        <?php if (!empty($_smarty_tpl->tpl_vars['pager']->value)) {?>
            <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        <?php }?>
    </div>

<?php } else { ?>
    <div class="alert alert-danger">
        <h1><p class="text-center">No Publications Found</p></h1>
    </div>
<?php }?>

 <?php if (isset($_smarty_tpl->tpl_vars['tag']->value)) {?>
 <div class="row">
    <button class="btn btn-success btn-lg btn-block"
        <input type="button" value="Show Associated Publications" onclick="location.href='index.php/rules/find_molrules/<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
';"/>
        <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Rules
    </button>

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
</div>

 <?php } else { ?>
<div class="row">
    <button class="btn btn-success btn-lg btn-block"
        <input type="button" value="Show Associated Publications" onclick="location.href='index.php/rules/ecm_rules/<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['idecm'];?>
';"/>
        <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Rules
    </button>

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
</div>
<?php }?>

<?php echo form_close();?>
<?php }} ?>
