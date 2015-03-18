{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to confirm deletion of Projects.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title} {$information.who}</h3>
            </div>
        </div>
    </div>
</div>

{if isset($information.messages)}
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-10">
                    <h3>  {$information.messages}</h3>
                </div>
            </div>
        </div>
    </div>
{/if}

{if isset($information.errors) && !empty($information.errors)}
    <div class="row">
        <div class="alert-danger">
            <div class="row">
                <div class="col-md-10">
                    <h3>  {$information.errors}</h3>
                </div>
            </div>
        </div>
    </div>
{/if}

{form_open_multipart( uri_string())}
        <input class="form-control hidden" id="focusedInput"  type="text" maxlength="2" value="77" name="idme" /> 

    <div class="col-md-12 alert-danger"><br />
    <h3>WARNING; You are about to go nuclear on this project!!!</h3><br />
       <img src="stylesheets/images/atomic.gif" class="image-float:right" alt="Atomic Bomb" id="nuclear">

<h3>Removal of a project from the database will result in deletion of all records in all tables 
 associated with this project.  The only data that will be perserved is the data contained in the user tables.</h3><br />
 <div><p class="text-center"><h1>THIS CANNOT BE UNDONE!!!</h1></p></div>
</div>


<div class="row">
    <button class="btn btn-danger btn-lg btn-block" type="post">
        <img src="stylesheets/images/delete.png" alt="Delete Record">Click to Delete
    </button>
</div>

{form_close()}
