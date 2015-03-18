{* <?php
/**
 *  @author Dennis A. Simpson
 *  @copyright 2015
 *  @version 2.3 Beta
 *  @abstract This form displays the page that allows exteranl refrences to be edited or entered.
*/	
?> *}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/doi/create' >Add New External Link</a>
                </div>
            {/if}
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
            <label class="col-md-3 control-label">External Link</label>
            <div class="col-md-9">
                <input placeholder="Enter the Full URL" class="form-control" type="text"  value="{if isset($data)}{$data.doi}{/if}" name="doi" />
            </div>
        </div>
    
        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Data
            </button>
        
            {if $action_mode == 'edit'}
                <button formmethod="post" formaction="index.php/doi/delete/{$data.id}" class="btn btn-danger btn-lg btn-block" type="submit">
                    <img src="stylesheets/images/delete.png" alt="Delete"> Delete Record
                </button>
            {/if}
        </div>
        
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div><!----- Horizontal Form ----->
{form_close()}     
