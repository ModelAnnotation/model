{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to confirm deletion of ECM Notes.
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

<div class="row alert-danger">
<div class="col-md-2 "><img src="stylesheets/images/biohazard.gif" width="100" height="100" alt="Biohazard Image"/></div>
<div class="col-md-8 "><h3>You are about to do something potentially quite hazardous.  Deletion of an ECM Note will result in deletion of all the 
PubMed documents and rules associated with this note.  If this action results in molecules that are not linked to any rules then those molecules
and their associated components as well as external links will also be removed.</h3>  <div><p class="text-center"><h1>THIS CANNOT BE UNDONE!!!</h1></p></div></div>
<div class="col-md-2 text-right"><img src="stylesheets/images/biohazard.gif" width="100" height="100" alt="Biohazard Image"/></div>
</div>

<div class="row">
    <button class="btn btn-danger btn-lg btn-block" type="post">
        <img src="stylesheets/images/delete.png" alt="Delete Record">Click to Delete
    </button>
</div>
            



{form_close()}
