{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to edit or enter groups.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>{$information.title} {$information.who}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/sysadmin/list_groups' >List All Groups</a>
            </div>
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

{if isset($information.errors)}
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
            <label for="name" class="col-md-2 control-label">{$fields.group_name}</label>
            <div class="col-md-10">
                <input id="group_name" title="Enter the name of your group." class="form-control" type="text" maxlength="50" value="{if isset($data)}{$data.group_name}{/if}" name="group_name"/>
            </div>
        </div>
    
    <div class="form-group">
        <label for="description" class="col-md-2 control-label">{$fields.description}</label>
        <div class="col-md-10">
            <textarea class="form-control" id="description" rows="2" placeholder="Enter a breif description this working group." maxlength="350" name="description" >{if isset($data)}{$data.description}{/if}</textarea>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <label class="checkbox-inline">
                <input type="checkbox"  id="A1" value="1" name="protect"{if $data.protect == 1} checked="checked"{/if} />{$fields.protect}
            </label>
        </div>
    </div>

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="submit">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
        </button>
    </div> 
    
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
            
{form_close()}
