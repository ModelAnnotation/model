<?php /* Smarty version Smarty-3.1.17, created on 2015-02-24 16:07:11
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\auth\change_password_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:749154ecc64a659806-87352037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ba937f3951dadbfcea8661816683de046a7870f' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\auth\\change_password_form.tpl',
      1 => 1424803522,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '749154ecc64a659806-87352037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ecc64a6af713_17842017',
  'variables' => 
  array (
    'config' => 0,
    'control' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ecc64a6af713_17842017')) {function content_54ecc64a6af713_17842017($_smarty_tpl) {?>

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
		<td><?php echo form_label('Old Password');?>
</td>
		<td><?php echo form_password('old_password');?>
</td>
		<td style="color: red;"><?php echo form_error('old_password');?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?></td>
	</tr>

	<tr>
		<td><?php echo form_label('New Password');?>
</td>
		<td><?php echo form_password('new_password');?>
</td>
		<td style="color: red;"><?php echo form_error('new_password');?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?></td>
	</tr>

	<tr>
		<td><?php echo form_label('Confirm New Password');?>
</td>
		<td><?php echo form_password('confirm_new_password');?>
</td>
		<td style="color: red;"><?php echo form_error('confirm_new_password');?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?></td>
	</tr>

</table>
<?php echo form_submit('change','Change Password');?>

<?php echo form_close();?>



    	<div id="columns_holder">
    		<p>This site was designed and built by Dennis Simpson.  The site is intended to aid in the annotation of of Rule Based Models of the Cell Cycle.  It could be adapted to any mathmatical model type.
            ECM is short for Extended Contact Map.  The model presented here is an extension of <a href="http://www.ncbi.nlm.nih.gov/pubmed/23266715" target="_blank">Kesseler et al. 2013</a>.
            The rules have been refactored for <a href="http://emonet.biology.yale.edu/nfsim/" target="_blank">NFsim</a>.  These diagrams are based on 
            <a href="http://www.ncbi.nlm.nih.gov/pubmed/21647530" target="_blank">Chylek et al. 2011</a> 
            and follow the entity relationship nomencalture recomendations of <a href="http://www.sbgn.org/Main_Page" target="_blank">SBGN</a>.</p>
            
            <p id="t1">To use this package look at the diagrams and find a note that corresponds to a reaction of interest.  Enter that note into the search
            form.  The search will return all rules associated with a given note OR all publications used to justify the rule.  From a Rule one can find all 
            molecules (proteins) associated and all components and states of a given molecule.</p>
            <p id="t2">Not all publication links are in the database yet.</p>
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
