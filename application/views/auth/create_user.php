
<!DOCTYPE HTML>

<head>
	<meta name="author" content="Dennis A. Simpson" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>

    <title>Model Annotation</title>
    <base href="http://localhost/model/" />
    <link rel="shortcut icon" type="image/x-icon" href= "favicon.ico" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="skin_round_silver/global.css"/>
    
<!-- ======================== javascript ========================== -->
    
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootbox.js"></script>
    <script type="text/javascript" src="zoom/java/FWDMegazoom.js"></script>

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
              
                    {if isset($project_id)}
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
                            <li{if isset($table_name)}{if $table_name == 'Rules'} class='active'{/if}{/if}><a href='index.php/rules/search'>Search by ECM Note</a></li>
                            <li{if isset($table_name)}{if $table_name == 'Rules'} class='active'{/if}{/if}><a href='index.php/rules/find_rules'>Search by Rule Snippets</a></li>
                            <li{if isset($table_name)}{if $table_name == 'Rules'} class='active'{/if}{/if}><a href='index.php/rules'>List All Rules</a></li>
                            <li{if isset($table_name)}{if $table_name == 'Molecule'} class='active'{/if}{/if}><a href='index.php/molecule'>List All Molecules or Entities</a></li>
                            </ul>
                          </li>

                        {if $group_id != 300}<!-- check group_id, exlcude "guest users" -->
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daily Builds<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li ><a href='index.php/daily_build'>List Daily Build Records</a></li>
                                </ul>
                              </li>

                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operations <b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                      <li class="dropdown-header">Molecule Operations</li>
                      
                                      <li{if isset($table_name)}{if $table_name == 'Molecule'} class='active'{/if}{/if}><a href='index.php/molecule'>Molecule</a></li>                           
                                      <li{if isset($table_name)}{if $table_name == 'Doi'} class='active'{/if}{/if}><a href='index.php/doi/create'>Add External Link</a></li>
                                      <li{if isset($table_name)}{if $table_name == 'Components'} class='active'{/if}{/if}><a href='index.php/components/create'>Add Components</a></li>
                       
                                      <li class="divider"></li>
                            
                                      <li class="dropdown-header">Rule Operations</li>
                                      <li{if isset($table_name)}{if $table_name == 'Rules'} class='active'{/if}{/if}><a href='index.php/rules'>List and Enter Rules</a></li>
                                      <li{if isset($table_name)}{if $table_name == 'Rulemol'} class='active'{/if}{/if}><a href='index.php/rulemol/create'>Link Rules to Molecules</a></li>
                                
                                      <li class="divider"></li>
                                    
                                      <li class="dropdown-header">Contact Map Operations</li>
                                      <li{if isset($table_name)}{if $table_name == 'Ecmnote'} class='active'{/if}{/if}><a href='index.php/ecmnote'>ECM Notes</a></li>
                                      <li{if isset($table_name)}{if $table_name == 'Doi'} class='active'{/if}{/if}><a href='index.php/pubmed'>Link ECM Notes to Publications</a></li>
                                  </ul>
                                </li>
                                
                        {/if}<!-- group_id check -->
                    {/if}<!-- project_id check -->
                    
                    {if $group_id != 300}<!-- check group_id, exlcude "guest users" -->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Functions<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <li><a href='index.php/sysadmin/edit_users/{$user_id}'>Edit User Profile</a></li>
                                    <li{if isset($table_name)}{if $table_name == 'Projects'} class='active'{/if}{/if}><a href='index.php/projects/'>List and Edit Projects</a></li>
                                    </ul>
                                </li>
                    {/if}<!-- group_id check -->
                    
            
                    {if $group_id == 100}<!-- check group_id, allow Administrators only -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">System Administration<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li{if isset($table_name)}{if $table_name == 'Users'} class='active'{/if}{/if}><a href='index.php/sysadmin/list_users'>List Users</a></li>
                                <li{if isset($table_name)}{if $table_name == 'Group_key'} class='active'{/if}{/if}><a href='index.php/sysadmin/list_groups'>List User Groups</a></li>
                                <li{if isset($table_name)}{if $table_name == 'Projects'} class='active'{/if}{/if}><a href='index.php/projects'>List and Edit Projects</a></li>
                            </ul>
                        </li>
                    <!-- group_id check -->
                </ul><!-- nav navbar-nav -->
            
            {if $logged_in == true}
                <ul class="nav nav-bar navbar-right">
                    <a href="index.php/auth/logout"><img src="stylesheets/images/logout.png" alt="Logout"/></a>
                </ul>

          </div><!-- navbar-collapse -->
      </div><!-- Container -->
    </div><!-- navbar-fixed-top -->


<!-- ======================== Subhead ========================== -->

    <div class="jumbotron">
        <div class="container">
            <h2><a href="index.php/dashboard">Rule Based Model Annotation v2.6 Beta</a></h2>
        </div>
    </div>

    <div class="container">        

            <div class="row">
        <h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>

      <p>
            <?php echo lang('create_user_username_label', 'username');?> <br />
            <?php echo form_input($username);?>
      </p>

      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>

            </div>

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
</html>