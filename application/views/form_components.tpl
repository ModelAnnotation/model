{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page for editing a molecule components.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
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
        <input class="form-control hidden" id="focusedInput"  type="text" maxlength="255" value="{if isset($data)}{$data.idmolecule}{/if}" name="idmolecule" />

            <div class="form-group">
                <label class="col-md-2 control-label">Components</label>
                <div class="col-md-10">
                    <input class="form-control" id="focusedInput"  type="text" maxlength="255" value="{if isset($data)}{$data.component}{/if}" name="component" />
                </div>
            </div>
    
    	   <div class="form-group">
                <label class="col-md-2 control-label">States</label>
                <div class="col-md-10">
    	       	   <input class="form-control" type="text" id="focusedInput" value="{if isset($data)}{$data.states}{/if}" name="states" />
                </div>
    	   </div>
    
    	   <div class="form-group">
                <label class="col-md-2 control-label">Definition</label>
                <div class="col-md-10">
    	       	   <input class="form-control" type="text" id="focusedInput" value="{if isset($data)}{$data.definition}{/if}" name="definition" />
                </div>
    	   </div>

 
            <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
            
            <a class="btn btn-danger btn-lg btn-block" href="index.php/components/delete/{$record_id}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');">
                <img src="stylesheets/images/delete.png" alt="Delete Record"> Don't Like It?  Click to Delete
            </a>

            </div>

            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
{form_close()}                
</div><!----- Horizontal Form ----->