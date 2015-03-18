<?php /* Smarty version Smarty-3.1.17, created on 2015-02-24 16:07:25
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\auth\unregister_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2799054eccb645a0b86-74858368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f88acfeeff6be1a689e179824c36f16f49e394a' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\auth\\unregister_form.tpl',
      1 => 1424807221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2799054eccb645a0b86-74858368',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54eccb645cf996_45722689',
  'variables' => 
  array (
    'config' => 0,
    'control' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54eccb645cf996_45722689')) {function content_54eccb645cf996_45722689($_smarty_tpl) {?>

<!DOCTYPE HTML>

<head>
	<meta name="author" content="Dennis A. Simpson" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href= "favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>Model Annotation | New User Registration</title>
    <base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['base_url'];?>
" />
    
    <link rel="stylesheet" href="/model/stylesheets/base.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/model/stylesheets/backend_skins/stylesheets/themes/default/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/model/stylesheets/backend_skins/stylesheets/override.css" type="text/css" media="screen" />
    <script type="text/javascript" src="stylesheets/javascripts/misc.js"></script>   

</head>

<body>

    <div id="container">
        <div id="header">
            <h1><a href="index.php/dashboard">Model Annotation Site</a></h1>
            
                <div id="user-navigation">
                    <ul class="wat-cf">
                        <li><a class="logout" href="index.php/auth/logout"><img src="/model/stylesheets/images/logout.png" alt="Logout"/></a></li>
                    </ul>
                </div>           
        </div>
         <div id="wrapper" class="wat-cf">
            <div id="main">


<form class="form" action='index.php/<?php echo $_smarty_tpl->tpl_vars['control']->value;?>
' method="post" enctype="multipart/form-data">

<table>
	<tr>
		<td><?php echo form_label('Password');?>
</td>
		<td><?php echo form_password('password');?>
</td>
		<td style="color: red;"><?php echo form_error('password');?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?></td>
	</tr>
</table>
<?php echo form_submit('cancel','Delete account');?>

<?php echo form_close();?>



    	<div id="columns_holder">
    		<td style="color: red;"><h1>THIS ACTION CAN NOT BE UNDONE.  MAKE SURE YOU WANT TO DELETE YOUR USER CREDENTIALS BEFORE CONTINUING.<br />
            USER DATA IS NOT DELETED BY THIS METHOD.</h1>
            </td>
    	</div>
        
        <div id="footer">
            <div class="block">
                <p><h4>The backend is built on <a href="http://www.codeigniter.com" target="_blank">CodeIgniter </a> generated with <a href="http://iscaffold.skyweb.hu" target="_blank">iScaffold 2.2</a></h4></p>
            </div>
        </div>
</div><!-- main -->

    <div id="sidebar">
        <div class="block notice">
            <h4>General Notice</h4>
            <p>For more information about this project email me. <br />
                <script type="text/javascript">
                    <!--//--><![CDATA[//><!--                    
                    email("g2", "checkpoint", "gmail", "com");
                    //--><!]]>
                    </script>
            </p>
        </div>
    </div>

        </div><!-- wrapper -->
    </div><!-- container -->
</body>
</html><?php }} ?>
