{* <?php
/**
 *  @author Dennis A. Simpson
 *  @copyright 2013
 *  @version 1.1 Beta
 *  @abstract This form displays a list of the contents of the "doi" table.  Also allows editing and creation of new records.
*/	
?> *} 


<div class="block" id="block-tables">

    <div class="secondary-navigation">
        <ul class="wat-cf">
            <li class="first active"><a href="index.php/doi">Listing</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="inner">
        
            <h3>List of {$table_name}</h3>

            {if !empty( $doi_data )}
                <form action="index.php/doi/delete" method="post" id="listing_form">
                    <table class="table">
                        <thead>
                            <th width="20"> </th>
                            <th><h3>{$doi_fields.iddoi}</h3></th>
                            <th><h3>{$doi_fields.doi}</h3></th>
                            <th><h3>{$doi_fields.iddoi}</h3></th>
                            <th><h3>{$doi_fields.idmolecule}</h3></th>
                            <th width="80">Actions</th>
                        </thead>
                        <tbody>
                            {foreach $doi_data as $row}
                                <tr class="{cycle values='odd,even'}">
                                    <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="{$row.iddoi}" /></td>
                                    <td>{$row.iddoi}</td>
                                    <td><a href="{$row.doi}" target="_blank"><img alt="{$row.doi}"/></a></td>
                                    <td>{$row.doi_idecm}</td>
            				        <td>{$row.idmolecule}</td>
                                    <td width="80">
                                        <a href="index.php/doi/show/{$row.iddoi}"><img src="stylesheets/images/view.png" alt="Show record" /></a>
                                        <a href="index.php/doi/edit/{$row.iddoi}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                        <a href="index.php/doi/delete/{$row.iddoi}"onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    
                    <div class="actions-bar wat-cf">
                        <div class="actions">
                            <button class="button" type="submit">
                                <img src="stylesheets/images/icons/cross.png" alt="Delete"> Delete selected
                            </button>
                        </div>
                        
                        <div class="pagination">
                            {$pager}
                        </div>
                    </div>
                    
                </form>
            {else}
                <div class="flash">
                    <div class="message error">
                        <p>No Records Found</p>
                    </div>
                </div>

            {/if}

        </div><!-- .inner -->
    </div><!-- .content -->
</div><!-- .block -->
