{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that lists rules.
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

{if !empty( $data )}

{form_open_multipart( uri_string())}

    <div class="row">
        <table class="table table-striped the-table">
   	        <thead>
                <th class="col-md-5 "><h3><p class="text-center">{$rules_fields.rule}</p></h3></th>
                <th class="col-md-4"><h3><p class="text-center">{$rules_fields.rulenote}</p></h3></th>
                <th class="col-md-3"><h3>Actions</h3></th>
       	    </thead>
            
       	    <tbody>
       	        {foreach $data as $row}
                    <tr>
                        <td class="col-md-5">{$row.rule}</td>
                        <td class="col-md-4">{$row.rulenote}</td>
                        <td class="col-md-3">
                            <a href="index.php/rules/showall/{$row.idrules}"><img src="stylesheets/images/mol_sm.jpg" alt="Show Molecules" height="64" width="64"/></a>
                            <a href="index.php/parameters/ruleprams/{$row.idrules}"><img src="stylesheets/images/parameters-512.png" alt="Show Parameters" height="64" width="64"/></a>
                            <a href="index.php/compartments/rulecomparts/{$row.idrules}"><img src="stylesheets/images/cell_compartment.jpg" alt="Show Compartments" height="64" width="64"/></a>
                            {if !$guest}
                                <a href="index.php/rules/edit/{$row.idrules}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                <a href='index.php/rules/delete/{$row.idrules}'onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                            {/if}
                        </td>
                    </tr>
       	        {/foreach}
       	    </tbody>
        </table>
    </div>
    {if !empty( $pager )}
        <div class="row">
            <div class="pagination pagination-large">
                {$pager}
            </div>
        </div>
    {/if}
{else}
        <div class="row">
            <div class="alert alert-danger">
                <div class="message error">
                   <h1><p class="text-center">No Records Found</p></h1>
                </div>
            </div>
        </div>
    {/if}
    
{form_close()}

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
