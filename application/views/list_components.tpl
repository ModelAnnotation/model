{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page lists all the components associated with the selected molecule.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>List of {$information.title} {$information.who}</h3>
            </div>
            {if ! $guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/components/create' >Add Components</a>
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

{if isset ($data[0].component)}

    <table class="table table-striped">
        <thead>
            <th class="col-md-1"><p class="text-center">Component</p></th>
            <th class="col-md-2"><p class="text-center">Component States</p></th>
            <th class="col-md-7"><p class="text-center">Definition</p></th>
            {if !$guest}
                <th class="col-md-2">Actions</th>
            {else}
             <th> </th>
             {/if}
        </thead>
        <tbody>
       	    {foreach $data as $row}
                <tr>
                    <td>{$row.component}</td>
                    <td>{$row.states}</td>
                    <td>{$row.definition}</td>
                    <td>
                        {if !$guest}
                            <a href="index.php/components/edit/{$row.idcomponents}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href='index.php/components/delete/{$row.idcomponents}'onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                        {/if}
                    </td>
                </tr>
           	{/foreach}
       	</tbody>
    </table>
    
    <div class="pagination pagination-large">
        {if !empty( $pager )}
            {$pager}
        {/if}
    </div>                           
                        
    {else}
        <div class="row">
            <div class="alert alert-danger">
                    <h1><p class="text-center">No Components Found</p></h1>
            </div>
        </div>
    {/if}

            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
{form_close()}