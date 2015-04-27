{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to edit diagram information and upload diagram files.
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
                    <a class="btn btn-primary" href='index.php/diagrams/create' >Enter New Diagram</a>
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
        <textarea class="form-control" rows="11" id="focusedInput" placeholder="**REQUIRED** Notes About This File"  name="description" >{if isset($data)}{$data.description}{/if}</textarea>
    </div>
    
    {if $action_mode !== 'create'}
        {if $data.filename}
            <div class="row">
                <div class="col-md-5"><h4>The Diagram File for This Date is {$data.filename}</h4></div>
                
                <div class="col-md-2 pull-left">
                    <a href="index.php/diagrams/download_file/{$data.file_link}"><img src="stylesheets/images/download-icon.gif" alt="Download Diagram File" /></a>
                    <a href="index.php/fix_me/display_file/{$data.file_link}" target="_blank"><img src="stylesheets/images/File_Open_sm.png" alt="View File" /></a>
                </div>
            </div>
        {else}
            <div class="row form-group">
                <label id="file_input"><h4>Select Diagram File</h4></label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
        {/if}
    {/if}

    {if $action_mode == 'create'}
            <div class="row form-group">
                <label id="file_input">Select Diagram File</label>
                <input type="file" id="file_input" name="userfile"/>
            </div>
    {/if}
            <br />
            <div class="row">
                <button class="btn btn-warning btn-lg btn-block" type="post">
                    <img src="stylesheets/images/icons/tick.png" alt="Save Diagram Record"/> Save Diagram Record
                </button>
            </div>

    {if $data.filename == TRUE}
            <div class="row">
                <button formmethod="post" formaction="index.php/diagrams/delete_file/{$data.diagram_id}" class="btn btn-danger btn-lg btn-block"  type="submit">
                    <img src="stylesheets/images/delete.png" alt="Delete Uploaded File"> Delete Uploaded File
                </button>
            </div>
    {/if}

            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
                
{form_close()}