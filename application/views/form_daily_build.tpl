{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to edit daily build information.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title} {$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/daily_build/create' >Enter New Build Record</a>
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

    <div class="row form-group col-md-12">
        <textarea class="form-control" rows="13" id="focusedInput" placeholder="Enter Notes About This File"  name="notes" >{if isset($data)}{$data.notes}{/if}</textarea>
    </div>
    
    {if $action_mode !== 'create'}
        {if $data.file_link}
            <div class="row">
                <div class="col-md-5"><h4>The Build File for This Date is {$data.file_link}</h4></div>
                
                <div class="col-md-2 pull-left">
                    <a href="index.php/daily_build/download_file/{$data.file_link}"><img src="stylesheets/images/download-icon.gif" alt="Download Build File" /></a>
                    <a href="index.php/daily_build/display_file/{$data.file_link}" target="_blank"><img src="stylesheets/images/File_Open_sm.png" alt="View File" /></a>
                </div>
            </div>
        {else}
            <div class="row form-group">
                <label id="file_input"><h4>Select Daily Build File</h4></label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
        {/if}
    {/if}

    {if $action_mode == 'create'}
            <div class="row form-group">
                <label id="file_input">Select Daily Build File</label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
    {/if}

            <br />
           
            <div class="row">
                <button class="btn btn-warning btn-lg btn-block" type="post">
                    <img src="stylesheets/images/icons/tick.png" alt="Save Build Record"/> Save Daily Build Record
                </button>
            </div>

    {if $data.file_link == TRUE}
            <div class="row">
                <button formmethod="post" formaction="index.php/daily_build/delete_file/{$data.id}" class="btn btn-danger btn-lg btn-block"  type="submit">
                    <img src="stylesheets/images/delete.png" alt="Delete Uploaded File"> Delete Uploaded File
                </button>
            </div>
    {/if}

            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
                
{form_close()}