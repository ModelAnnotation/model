{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page thas lists all the projects in the model.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}</h3>
            </div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-primary" href='index.php/projects/create' >Enter New Project</a>
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
            <th>{$fields.name}</th>
            <th>{$fields.description}</th>
            <th>{$fields.created}</th>
            <th>{$fields.modified}</th>
            <th width="80">Actions</th>
        </thead>
                        
        <tbody>
            {foreach $data as $row}
                <tr>
                    <td>{$row.name}</td>
                    <td>{$row.description}</td>
                    <td>{$row.created}</td>
                    <td>{$row.modified}</td>
                    <td width="80">
                        {if !$guest}
                            <a href="index.php/projects/edit/{$row.id}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            {if !$information.user}
                                <a href="index.php/projects/delete/{$row.id}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                            {/if}
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
