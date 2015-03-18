{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page to edit or enter projects.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}{$data.name}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/projects' >List All Projects</a>
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

{if isset($information.errors)}
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
            <label for="name" class="col-md-2 control-label">{$fields.name}</label>
            <div class="col-md-10">
                <input id="name" title="Enter the name of your project." class="form-control" type="text" maxlength="50" value="{if isset($data)}{$data.name}{/if}" name="name"/>
            </div>
        </div>
    
    <div class="form-group">
        <label for="description" class="col-md-2 control-label">{$fields.description}</label>
        <div class="col-md-10">
            <textarea class="form-control" id="description" rows="2" placeholder="Enter a breif description of project." maxlength="350" name="description" >{if isset($data)}{$data.description}{/if}</textarea>
        </div>
    </div>
    <fieldset>
    <legend>Select Groups Project Will Reside In</legend>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            {foreach $data.groups as $group}
                <label class="checkbox-inline">
                    {$gID=$group.id}
                    {$checked = null}
                                
                    {foreach $data.currentGroups as $grp}
                        {if $gID == $grp->id}
                            {$checked= ' checked="checked"'}
                        {/if}
                    {/foreach}
              
                    <input type="checkbox" name="groups[]" value="{$group.id}" {$checked}/>{$group.name|escape}
                </label>
            {/foreach}
        </div>
    </div>
    </fieldset>

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="submit">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
        </button>
    </div> 
    
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div>
{form_close()}
