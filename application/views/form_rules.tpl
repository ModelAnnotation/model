{* <?php
/**
 *  @author Dennis A. Simpson
 *  @copyright 2015
 *  @version 2.3 Beta
 *  @abstract This form displays the page that allows rules to be manipulated.
*/	
?> *}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h4>{$information.title}{$information.who}</h4>
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
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Enter Rule" name="rule" />{if isset($data)}{$data.rule}{/if}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">{$rules_fields.rulenote}</label>
            <div class="col-md-10">
                <textarea class="form-control" id="focusedInput" rows="3" placeholder="Describe This Rule" name="rulenote" />{if isset($data)}{$data.rulenote}{/if}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Associated ECM Note</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="idecm" >
                    <option value={$data.idecm}></option>
                    {foreach $related_ecmnote as $rel}
                            <option value="{$rel.ecmnote_id}"{if isset($data)}{if $data.idecm == $rel.ecmnote_id} selected="selected"{/if}{/if}>{$rel.ecmnote_name}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="text-primary pull-middleP"><p>Link additional Molecules, Paramaters, and Compartments to selected rule.</p></div>
        <div class="form-group">
            <label class="col-md-2 control-label">Link Molecule</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="idmolecule" >
                    <option value={$data.idmolecule}></option>
                    {foreach $related_molecule as $rel}
                            <option value="{$rel.molecule_id}"{if isset($data)}{if $data.molecule == $rel.molecule_id} selected="selected"{/if}{/if}>{$rel.molecule_name}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Link Parameter</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="parameter_id" >
                    <option value={$data.parameter_id}></option>
                    {foreach $related_parameter as $rel}
                            <option value="{$rel.parameter_id}"{if isset($data)}{if $data.parameter_id == $rel.parameter_id} selected="selected"{/if}{/if}>{$rel.parameter_name}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Link Compartment</label>
            <div class="col-md-10">
                <select class="form-control" id="focusedInput" name="compartment_id" >
                    <option value={$data.compartment_id}></option>
                    {foreach $related_compartment as $rel}
                            <option value="{$rel.compartment_id}"{if isset($data)}{if $data.compartment_id == $rel.compartment_id} selected="selected"{/if}{/if}>{$rel.compartment_name}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="post">
                <img src="stylesheets/images/icons/tick.png" alt="Save Edits"/> Save Edits
            </button>
        </div>

        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">CANCEL</a>
                
</div><!----- Horizontal Form ----->
{form_close()}   