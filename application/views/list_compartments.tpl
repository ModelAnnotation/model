{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page thas lists all the compartments in the working project.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-9">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-3 pull-right">
                    <a class="btn btn-primary" href='index.php/compartments/create' >Create New Compartments</a>
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
{if !empty( $data )}
    <table class="table table-striped">
        <thead>
            <th class="col-md-2">{$fields.compartment}</th>
            <th class="col-md-7">{$fields.description}</th>
            <th class="col-md-1">{$fields.value}</th>
            <th class="col-md-2">Actions</th>
        </thead>
                        
        <tbody>
            {foreach $data as $row}
                <tr>
                    <td>{$row.compartment}</td>
                    <td>{$row.description}</td>
                    <td>{$row.value}</td>
                    <td>
                        {if !$guest}
                             <input type="hidden" class="form-control" name="compartment_id" value={$row.compartment_id}> 
                            <a href="index.php/compartments/edit/{$row.id}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <button class="btn btn-sm" type="post" onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');">
                                <img src="stylesheets/images/delete.png" alt="Delete record" />
                            </button>
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    {if !empty( $pager )}
        <div class="pagination pagination-large">
            {$pager}
        </div>     
    {/if}
                
    {else}
        <div class="alert alert-danger">
            <h1><p class="text-center">No Records Found</p></h1>
        </div>
    {/if}
{form_close()}

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
