{* <?php
/**
 *  @author Dennis A. Simpson
 *  @copyright 2015
 *  @version 2.1 beta
 *  @abstract This file generates the page that displays all external links associated with a Molecule.
*/	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/doi/create' >Add New External Link</a>
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



{if !empty($data) }

    {if $information.tag == 'E'}
        <div class="row">
            <div class="alert alert-success">
                <h3>Inserted Link for Molecule:  {$data[0].molecule}</h3>
                <p class="text-right">
                    <a href="index.php/doi/show/{$data[0].idmolecule}"><img src="stylesheets/images/link.jpg" height="67" width="67" alt="Show All Links" /></a>
                </p>
            </div>
        </div>

    {/if}
    
    {if !empty($data[0].iddoi)}

        <table class="table table-striped">
        
           	<thead>
                <th class="col-md-7"><h3><p class="text-center">External Link</p></h3></th>
                <th class="col-md-2"><h3>Actions</h3></th>
            </thead>
            
            <tbody>
                {foreach $data as $row}
				    <tr>
                        <td class="col-md-7">{$row.doi}</td>
                        <td class="col-md-2">
                            <a href="{$row.doi}" target="_blank"><img src="stylesheets/images/link_sm.jpg" alt="External Link" /></a>
                            {if !$guest}
                                <a href="index.php/doi/delete/{$row.iddoi}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
                                <a href="index.php/doi/edit/{$row.iddoi}"><img src="stylesheets/images/edit.png" alt="Delete Record" /></a>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        
    {else}
    
    <div class="row">
        <div class="alert alert-danger">
            <h1><p class="text-center">No Records Found</p></h1>
        </div>
    </div>
    
    {/if}

{elseif isset ($data.molecule)}

    <div class="row">
        <div class="alert alert-danger">
            <h2><p class="text-center">Database Update Failed.</p></h2>
        </div>
    </div>
{else}

        <div class="row">
            <div class="alert alert-danger">
                <h2>No Records Found</h2>
            </div>
        </div>

{/if}

<a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
