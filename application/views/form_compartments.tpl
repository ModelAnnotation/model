{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page for editing compartments.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/compartments' >List Compartments</a>
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
        <label class="col-md-2 control-label">Compartment:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Compartment Name" type="text" maxlength="50" value="{if isset($data)}{$data.compartment}{/if}" name="compartment" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Value:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" placeholder="Enter Compartment Value" type="text" maxlength="15" value="{if isset($data)}{$data.value}{/if}" name="value" />
        </div>
    </div>

    <br />      
    <div class="form-group">
        <label class="col-md-2 control-label">Description:</label>
        <div class="col-md-10">
            <textarea class="form-control"  rows="5" id="focusedInput" placeholder="Enter Comments" name="description" >{if isset($data)}{$data.description}{/if}</textarea>
        </div>
    </div>

                
    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Compartment
        </button>
    </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div><!----- Horizontal Form ----->
{form_close()}                
