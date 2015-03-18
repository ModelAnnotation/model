<?php /* Smarty version Smarty-3.1.17, created on 2015-03-15 01:12:06
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\frame_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2017254ebe96e162c48-28971703%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8bb0cdc9418db9a146300132324a3d7f385fc6b' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\frame_admin.tpl',
      1 => 1426395829,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2017254ebe96e162c48-28971703',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ebe96e27ff06_54796895',
  'variables' => 
  array (
    'config' => 0,
    'image' => 0,
    'information' => 0,
    'guest' => 0,
    'user_id' => 0,
    'table_name' => 0,
    'admin' => 0,
    'logged_in' => 0,
    'project' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ebe96e27ff06_54796895')) {function content_54ebe96e27ff06_54796895($_smarty_tpl) {?>

<!DOCTYPE HTML>

<head>
	<meta name="author" content="Dennis A. Simpson" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
    
    <title>Model Annotation</title>
    <base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['base_url'];?>
" />
    <link rel="shortcut icon" type="image/x-icon" href= "Annotation.png" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="skin_round_silver/global.css"/>
    
<!-- ======================== javascript ========================== -->
    
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootbox.js"></script>
    <script type="text/javascript" src="zoom/java/FWDMegazoom.js"></script>
    
<!-- =============================== OLD ZOOMER ================================= -->  
    <link rel="stylesheet" href="zoom/descriptionWindow.css" type="text/css"/>
    <script type="text/javascript" src="zoom/java/FWDZoomer.js"></script>
    
        <?php if (isset($_smarty_tpl->tpl_vars['image']->value)) {?>
            <?php echo $_smarty_tpl->getSubTemplate ('image.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>

<!-- ============================================================================= --> 

    <script type="text/javascript" src="stylesheets/jquery-ui-1.10.2/ui/jquery-ui.js"></script>
    <script type="text/javascript" src="stylesheets/javascripts/misc.js"></script>
    
</head>

<body>

    <div id="wrap">

<!-- =======================   Navbar   =============================== -->
    <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div><!-- navbar-header -->
            
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="index.php/dashboard">Home</a>
                    </li>
              
                    <?php if (isset($_smarty_tpl->tpl_vars['information']->value['project_id'])) {?><!-- require a project to be selected for the next sections -->
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ECM Figures<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href='index.php/dashboard/ecm_1'>Main G2 Figure</a></li>
                            <li><a href='index.php/dashboard/ecm_2'>Generic Transport</a></li>
                            <li><a href='index.php/dashboard/ecm_3'>Glyph Definition</a></li>
                            </ul>
                          </li>
            
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search Functions<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href='index.php/rules/search'>Search by ECM Note</a></li>
                            <li><a href='index.php/rules/find_rules'>Search by Rule Snippets</a></li>
                            </ul>
                          </li>

                        <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?><!-- check group_id, exlcude "guest users" -->
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daily Builds<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li ><a href='index.php/daily_build'>List Daily Build Records</a></li>
                                </ul>
                              </li>
                        <?php }?><!-- End group_id check; Not Guest -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operations <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Molecule Operations</li>
                                <li><a href='index.php/molecule'>List Molecules</a></li>
                                <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?><!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/molecule/create'>Add New Molecule</a></li>
                                <?php }?><!-- End group_id check; Not Guest -->
                       
                                <li class="divider"></li>
                                <li class="dropdown-header">Rule Operations</li>
                                <li><a href='index.php/rules'>List Rules</a></li>
                                <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?><!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/rules/create'>Enter Rules</a></li>
                                 <?php }?><!-- End group_id check; Not Guest -->
                                
                                <li class="divider"></li>
                                <li class="dropdown-header">Contact Map Operations</li>
                                <li><a href='index.php/ecmnote'>List ECM Notes</a></li>
                                <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?><!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/ecmnote/create'>Enter ECM Notes</a></li>
                                      <li><a href='index.php/pubmed'>Link ECM Notes to Publications</a></li>
                                <?php }?><!-- End group_id check; Not Guest -->
                                      
                                <li class="divider"></li>
                                <li class="dropdown-header">Paramaters and Compartments</li>
                                <li><a href='index.php/compartments'>List Compartments</a></li>
                                <li><a href='index.php/parameters'>List Parameters</a></li>

                            </ul>
                        </li>
                    <?php }?><!-- End project_id check -->

                    <?php if (!$_smarty_tpl->tpl_vars['guest']->value) {?><!-- check group_id, exlcude "guest users" -->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Functions<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <li><a href='index.php/sysadmin/edit_user/<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
'>Edit User Profile</a></li>
                                    <li<?php if (isset($_smarty_tpl->tpl_vars['table_name']->value)) {?><?php if ($_smarty_tpl->tpl_vars['table_name']->value=='Projects') {?> class='active'<?php }?><?php }?>><a href='index.php/projects/'>List and Edit Projects</a></li>
                                    </ul>
                                </li>
                    <?php }?><!-- group_id check -->
                    
                    <?php if ($_smarty_tpl->tpl_vars['admin']->value) {?><!-- check group_id, allow Administrators only -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">System Administration<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li<?php if (isset($_smarty_tpl->tpl_vars['table_name']->value)) {?><?php if ($_smarty_tpl->tpl_vars['table_name']->value=='Users') {?> class='active'<?php }?><?php }?>><a href='index.php/sysadmin/list_users'>List Users</a></li>
                                <li<?php if (isset($_smarty_tpl->tpl_vars['table_name']->value)) {?><?php if ($_smarty_tpl->tpl_vars['table_name']->value=='Groups') {?> class='active'<?php }?><?php }?>><a href='index.php/sysadmin/list_groups'>List and Edit Groups</a></li>
                                <li<?php if (isset($_smarty_tpl->tpl_vars['table_name']->value)) {?><?php if ($_smarty_tpl->tpl_vars['table_name']->value=='Projects') {?> class='active'<?php }?><?php }?>><a href='index.php/projects'>List and Edit Projects</a></li>
                            </ul>
                        </li>
                    <?php }?><!-- group_id check -->
                </ul><!-- nav navbar-nav -->
            
            <?php if ($_smarty_tpl->tpl_vars['logged_in']->value==true) {?>
                <ul class="nav nav-bar navbar-right">
                    <a href="index.php/auth/logout"><img src="stylesheets/images/logout.png" alt="Logout"/></a>
                </ul>
            <?php }?>
          </div><!-- navbar-collapse -->
      </div><!-- Container -->
    </div><!-- navbar-fixed-top -->

<!-- ======================== Subhead ========================== -->

    <div class="jumbotron">
        <div class="container">
            <h2><a href="index.php/dashboard">Rule Based Model Annotation v2.7 Beta</a></h2>
            <?php if (isset($_smarty_tpl->tpl_vars['project']->value)) {?>
                <h3>Working with project <?php echo $_smarty_tpl->tpl_vars['project']->value;?>
</h3>
            <?php }?>
        </div>
    </div>

    <div class="container">        

        <?php if ($_smarty_tpl->tpl_vars['logged_in']->value==true) {?>
            <div class="row">
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['template']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </div>

        <?php } else { ?>
            <a href="index.php/auth/login"></a>
        <?php }?>

    </div><!-- container -->
</div><!-- wrap -->

<!-- =================== Footer =================== -->

<div id="footer">
    <div class="container">        
<p class="text-center">For more information click on the @ icon to email me. 

                <script type="text/javascript">
                    <!--//--><![CDATA[//><!--                    
                    email("g2", "checkpoint", "gmail", "com");
                    //--><!]]>
                    </script>
                    
The backend is built on <a href="http://www.codeigniter.com" target="_blank">CodeIgniter </a> <br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.en_US">Creative Commons Attribution-NonCommercial 3.0 Unported License</a>.<a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/88x31.png" /></a></p>
    </div><!-- container -->
</div><!-- footer -->

</body>
</html><?php }} ?>
