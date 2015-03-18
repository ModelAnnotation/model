<?php /* Smarty version Smarty-3.1.17, created on 2015-02-24 10:58:18
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\auth\login_test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206754ec918a46fb01-76114324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcd43b3a2a2b256398a63f74293803030eab3cf5' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\auth\\login_test.tpl',
      1 => 1424754318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206754ec918a46fb01-76114324',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'data' => 0,
    'control' => 0,
    'login_label' => 0,
    'captcha' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54ec918a588f42_71850728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ec918a588f42_71850728')) {function content_54ec918a588f42_71850728($_smarty_tpl) {?>

<!DOCTYPE HTML>

<head>
	<meta name="author" content="Dennis A. Simpson" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href= "favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>Model Annotation | Login</title>
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

<?php if ($_smarty_tpl->tpl_vars['data']->value['login_by_username']==1) {?>
        <?php $_smarty_tpl->tpl_vars['login_label'] = new Smarty_variable('Email or Login', null, 0);?>
    <?php } elseif ($_smarty_tpl->tpl_vars['data']->value['login_by_username']) {?>
        <?php $_smarty_tpl->tpl_vars['login_label'] = new Smarty_variable('Login', null, 0);?>
    <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['login_label'] = new Smarty_variable('Email', null, 0);?>
<?php }?>
<form class="form" action='index.php/<?php echo $_smarty_tpl->tpl_vars['control']->value;?>
/' method="post" enctype="multipart/form-data">
            
<table>
<tr>

    <div class="group wat-cf">
	<td><h4><?php echo form_label($_smarty_tpl->tpl_vars['login_label']->value);?>
: </h4></td>
	<td><h4><?php echo form_input('login');?>
</h4></td>
	<td style="color : red"><h4><?php echo form_error('login');?>
<?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?> </h4></td>
        
       </div>
</tr>
    <div class="group wat-cf">
<tr>	
	
	<td><h4>Password:</h4></td>
	<td><h4><?php echo form_password('password');?>
</h4></td>
	<td style="color: red;"><h4><?php echo form_error('password');?>
 <?php if (isset($_smarty_tpl->tpl_vars['data']->value['errors'])) {?><?php }?> </h4></td>
</tr>	
</div>
<br />

	<?php if ($_smarty_tpl->tpl_vars['data']->value['show_captcha']) {?> 
        <?php if ($_smarty_tpl->tpl_vars['data']->value['use_recaptcha']) {?> 
            <tr>
                <td colspan="2">
                    <div id="recaptcha_image"></div>
                </td>
                <td>
                    <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
                    <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                    <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="recaptcha_only_if_image">Enter the words above</div>
                    <div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
                </td>
                <td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
                <td style="color: red;"><?php echo form_error('recaptcha_response_field');?>
</td>
		          { $recaptcha_html}
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="3">
                    <p>Enter the code exactly as it appears:</p>
                    { $recaptcha_html}
                </td>
            </tr>
            <tr>
                <td><?php echo form_label('Captcha Confirmation Code');?>
</td>
                <td><?php echo form_input($_smarty_tpl->tpl_vars['captcha']->value);?>
</td>
                <td style="color: red;"><?php echo form_error($_smarty_tpl->tpl_vars['captcha']->value);?>
</td>
            </tr>
        <?php }?>
    <?php }?>

	<tr>
    
		<td ><h4><?php echo form_checkbox('remember');?>

        <?php echo form_label('Remember Me');?>
</h4></td>
			
		
        
        </tr>
        
        <tr>
                <div class="group navform wat-cf"></div>
                    <div class="left"></div>
                    <td>
                        <button class="buttons" type="submit">
                            <img src="/model/stylesheets/images/icons/keys.png" alt="Login" height="32" width="32"/> Login
                        </button>
                    </td>
<td>
        <button 
            <input type="button" value="Open Window" onclick="forgot_pwd()"/><img src="/model/stylesheets/images/forgot_pwd.jpg" alt="Forgot Password" width="32" height="32"/>
            Forgot Password
            </button>
            
</td>            
    <?php if ($_smarty_tpl->tpl_vars['data']->value['allow_registration']) {?>
            <td>
            
            <button
            <input type="button" value="Open Window" onclick="register()"/><img src="/model/stylesheets/images/icons/register.png" alt="Register" width="32" height="32"/>Register
            </button>
            </td>
    <?php }?>

    </tr>
</table>
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
            </div>

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
