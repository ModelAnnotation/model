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
            <div class="col-md-12">
                <h3>{$information.title}{$information.who}</h3>
            </div>
            {if !$guest}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/rulemol/create/{$id}' >Link Molecules</a>
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
{if !empty( $data )}
    <table class="table table-striped">
        <thead>
            <th class="col-md-1"><h3>{$rules_fields.molecule}</h3></th>
            <th class="col-md-7"><h3><p class="text-center">Comments</p></h3></th>
            <th class="col-md-3"><h3><p class="text-center">Actions</p></h3></th>
        </thead>
        <tbody>
            {foreach $data as $row}
                <tr>
                    <td>{$row.molecule}</td>
                    <td>{$row.comment}</td>
                    <td>
                        <a href='index.php/rules/find_molrules/{$row.molecule}'><img src="stylesheets/images/calculus.jpg" alt="Show Rules" height="64" width="90"/></a>
                        <a href='index.php/pubmed/mol_pub/{$row.molecule}'><img src="stylesheets/images/books_sm.png" alt="Show Publications" /></a>
                        <a href="index.php/molecule/showall/{$row.idmolecule}"><img src="stylesheets/images/catel.png" alt="Show Components" /></a>
                        <a href='index.php/molecule/showlinks/{$row.idmolecule}'><img src="stylesheets/images/link_sm.jpg" alt="External Links" /></a>
                        {if !$guest}
                            <a href='index.php/molecule/edit/{$row.idmolecule}'><img src="stylesheets/images/edit.png" alt="Edit Molecule" /></a>
                            <a href="index.php/rulemol/delete/{$row.idrulemol}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Molecule from Rule" /></a>
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
            <div class="message error">
                <h2><p>No Records Found</p></h2>
            </div>
        </div>
    {/if}
    </div><!----- Horizontal Form ----->
{form_close()}
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
