{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that allows ECM Note searches.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-8">
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

    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">Seclect ECM Note</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="ecmnote_id">
                    <option value=""></option>
                    {foreach $related_ecmnote as $rel}
                        <option value="{$rel.ecmnote_id}">{$rel.ecmnote_name}</option>
                    {/foreach}
       	        </select>
            </div>
        </div>
    
        <div class="row">                    
            <button formmethod="post" formaction="index.php/rules/search/note" class="btn btn-primary btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="ECM Notes"> Find ECM Note
            </button>
        </div>
    
        <div class="row">
            <p class="lead text-center">OR</p>
        </div>

        <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Rule Search"> Find Associated Rules
            </button>
        </div>
    
        <div class="row">
            <p class="lead text-center">OR</p>
        </div>
                    
        <div class="row">                    
            <button formmethod="post" formaction="index.php/rules/search/pub" class="btn btn-info btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Publications"> Find Associated Publications
            </button>
        </div>

        <div class="row">   
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
        </div>
    </div><!----- Horizontal Form ----->
{form_close()}
