{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that links molecules to rules.
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
                    <a class="btn btn-primary" href='index.php/rules/create' >Enter New Rule</a>
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
            <label class="col-md-2 control-label">Rule</label>
    		<div class="col-md-10">
    	       	<select class="field select addr large" name="idrules" style="width:800px" >
                {if !empty($rule)}
                    <option value="{$rule.idrules}" selected="selected">{$rule.rule}</option>
                {else}
                    <option value=""></option>
                {/if}
                {foreach $related_rules as $rel}
                        <option  value="{$rel.rules_id}" id="idrules">{$rel.rules_name}</option>
                {/foreach}
                </select>
    		</div>
    	</div>

    	<div class="form-group">
            <label class="col-md-2 control-label">Molecule</label>
    		<div class="col-md-10">
    	       	<select class="field select addr large" name="idmolecule" style="width:300px" >
                <option value=""></option>
                {foreach $related_molecule as $rel}
                        <option value="{$rel.molecule_id}" id="idmolecule">{$rel.molecule_name}</option>
                {/foreach}
                </select>
    		</div>
    	</div>

            <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
            </button>
            </div>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">CANCEL</a>
    </div><!----- Horizontal Form ----->
{form_close()}
