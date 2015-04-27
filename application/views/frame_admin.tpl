{* <?php
/**
 * @author Dennis A. Simpson
 * @copyright 2015
 * @version 1.3 Beta
 * @package Model Annotation Site
 * @abstract This is the main page for MODEL project.  Contains navigation and all other pages.
 */
?> *}

<!DOCTYPE HTML>

<head>
	<meta name="author" content="Dennis A. Simpson" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
    {*<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>*}
    <title>Model Annotation</title>
    <base href="{$config.base_url}" />
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
    
        {if isset($image)}
            {include file = 'image.tpl'}
        {/if}

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
              
                    {if isset($information.project_id)}<!-- require a project to be selected for the next sections -->
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pathway Diagrams<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href='index.php/diagrams/index'>List of Diagrams</a></li>
                            {if !$guest}<!-- check group_id, exlcude "guest users" -->
                                <li><a href='index.php/diagrams/diagram_upload'>Upload Diagrams</a></li>
                            {/if}
                            <li class="divider"></li>
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

                        {if !$guest}<!-- check group_id, exlcude "guest users" -->
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daily Builds<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li ><a href='index.php/daily_build'>List Daily Build Records</a></li>
                                </ul>
                              </li>
                        {/if}<!-- End group_id check; Not Guest -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operations <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Molecule Operations</li>
                                <li><a href='index.php/molecule'>List Molecules</a></li>
                                {if !$guest}<!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/molecule/create'>Add New Molecule</a></li>
                                {/if}<!-- End group_id check; Not Guest -->
                       
                                <li class="divider"></li>
                                <li class="dropdown-header">Rule Operations</li>
                                <li><a href='index.php/rules'>List Rules</a></li>
                                {if !$guest}<!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/rules/create'>Enter Rules</a></li>
                                 {/if}<!-- End group_id check; Not Guest -->
                                
                                <li class="divider"></li>
                                <li class="dropdown-header">Contact Map Operations</li>
                                <li><a href='index.php/ecmnote'>List ECM Notes</a></li>
                                {if !$guest}<!-- check group_id, exlcude "guest users" -->
                                      <li><a href='index.php/ecmnote/create'>Enter ECM Notes</a></li>
                                      <li><a href='index.php/pubmed'>Link ECM Notes to Publications</a></li>
                                {/if}<!-- End group_id check; Not Guest -->
                                      
                                <li class="divider"></li>
                                <li class="dropdown-header">Paramaters and Compartments</li>
                                <li><a href='index.php/compartments'>List Compartments</a></li>
                                <li><a href='index.php/parameters'>List Parameters</a></li>

                            </ul>
                        </li>
                    {/if}<!-- End project_id check -->

                    {if !$guest}<!-- check group_id, exlcude "guest users" -->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Functions<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <li><a href='index.php/sysadmin/edit_user/{$user_id}'>Edit User Profile</a></li>
                                    <li{if isset($table_name)}{if $table_name == 'Projects'} class='active'{/if}{/if}><a href='index.php/projects/'>List and Edit Projects</a></li>
                                    </ul>
                                </li>
                    {/if}<!-- group_id check -->
                    
                    {if $admin}<!-- check group_id, allow Administrators only -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">System Administration<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li{if isset($table_name)}{if $table_name == 'Users'} class='active'{/if}{/if}><a href='index.php/sysadmin/list_users'>List Users</a></li>
                                <li{if isset($table_name)}{if $table_name == 'Groups'} class='active'{/if}{/if}><a href='index.php/sysadmin/list_groups'>List and Edit Groups</a></li>
                                <li{if isset($table_name)}{if $table_name == 'Projects'} class='active'{/if}{/if}><a href='index.php/projects'>List and Edit Projects</a></li>
                            </ul>
                        </li>
                    {/if}<!-- group_id check -->
                </ul><!-- nav navbar-nav -->
            
            {if $logged_in == true}
                <ul class="nav nav-bar navbar-right">
                    <a href="index.php/auth/logout"><img src="stylesheets/images/logout.png" alt="Logout"/></a>
                </ul>
            {/if}
          </div><!-- navbar-collapse -->
      </div><!-- Container -->
    </div><!-- navbar-fixed-top -->

<!-- ======================== Subhead ========================== -->

    <div class="jumbotron">
        <div class="container">
            <h2><a href="index.php/dashboard">Rule Based Model Annotation v2.7 Beta</a></h2>
            {if isset($project)}
                <h3>Working with project {$project}</h3>
            {/if}
        </div>
    </div>

    <div class="container">        

        {if $logged_in == true}
            <div class="row">
                {include file="$template"}
            </div>

        {else}
            <a href="index.php/auth/login"></a>
        {/if}

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