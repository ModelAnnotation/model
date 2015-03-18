{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page for editing a molecule.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/molecule' >List Molecules</a>
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
        <label class="col-md-2 control-label">{$information.molecule_label}:</label>
        <div class="col-md-10">
    	       <input class="form-control" id="focusedInput" type="text" maxlength="255" value="{if isset($data)}{$data.molecule}{/if}" name="molecule"/>
        </div>
    </div>
    <br />      
    <div class="form-group">
        <label class="col-md-2 control-label">{$fields.comment}:</label>
        <div class="col-md-10">
            <textarea class="form-control"  rows="5" id="focusedInput" placeholder="Short Description of Molecule or Entity"  name="comment" >{if isset($data)}{$data.comment}{/if}</textarea>
        </div>
    </div>

                
    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Molecule
        </button>
    </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
</div><!----- Horizontal Form ----->
{form_close()}                
