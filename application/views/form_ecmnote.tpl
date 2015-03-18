{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to edit a diagram note.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>{$information.title} {$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/ecmnote/create' >Enter New Note</a>
                </div>
            {/if}
        </div>
    </div>
</div>

{if isset($information.messages)}
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-5">
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
                <div class="col-md-5">
                    <h3>  {$information.errors}</h3>
                </div>
            </div>
        </div>
    </div>
{/if}

{form_open_multipart( uri_string())}
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">{$ecmnote_fields.ecmnote}</label>
            <div class="col-md-10">
                <input class="form-control" id="focusedInput" type="text" maxlength="140" value="{if isset($data)}{$data.ecmnote}{/if}" name="ecmnote"/>
            </div>   		
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label">{$ecmnote_fields.comment}</label>
            <div class="col-md-10">
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Short Description Of This Note"  name="comment" >{if isset($data)}{$data.comment}{/if}</textarea>
            </div>
        </div>
        {if !$guest}
        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
        </div>
        {/if}
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                
    </div><!----- Horizontal Form ----->
{form_close()}

