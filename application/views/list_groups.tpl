{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page lists the contents of the GROUPS table and allows editing, creation, and deletion of the records.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>List of {$information.title}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/sysadmin/create_group' >Enter New Group</a>
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
{if !empty( $data )}
    <table class="table table-striped">
        <thead>
            <th class="col-md-4">Group Name</th>
            <th class="col-md-4">{$fields.description}</th>
            <th class="col-md-2">Actions</th>
        </thead>
                        
        <tbody>
            {foreach $data as $row}
                <tr>
                    <td>{$row.name}</td>
                    <td>{$row.description}</td>
                    <td>
                        {if $information.permission}
                            <a href="index.php/sysadmin/edit_group/{$row.id}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href="index.php/sysadmin/delete/{$row.id}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
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
