{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that lists the ecm notes for the project.
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
                    <a class="btn btn-primary" href='index.php/ecmnote/create' >Enter New Note</a>
                </div>
            {/if}
        </div>
    </div>
</div>

{if isset($information.messages)}
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-8">
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
                <div class="col-md-8">
                    <h3>  {$information.errors}</h3>
                </div>
            </div>
        </div>
    </div>
{/if}

{form_open_multipart( uri_string())}
{if !empty( $ecmnote_data )}

        <table class="table table-striped">
                            	<thead>
                        			<th class="col-md-2"><h3>Note</h3></th>
                        			<th class="col-md-7"><h3 ><p class="text-center">{$ecmnote_fields.comment}</p></h3></th>

                                    <th class="col-md-3"><h3>Actions</h3></th>
                            	</thead>
                            	<tbody>
                                	{foreach $ecmnote_data as $row}
                                        <tr>
                            				<td>{$row.ecmnote}</td>
                            				<td>{$row.comment}</td>

                                            <td>
                                                <a href="index.php/rules/ecm_rules/{$row.idecm}"><img src="stylesheets/images/calculus.jpg" alt="Show Rules" height="64" width="90"/></a>
                                                <a href="index.php/pubmed/pub_list/{$row.idecm}"><img src="stylesheets/images/pubmed.jpg" alt="Show Publications" /></a>

                                                {if !$guest}
                                                    <a href="index.php/ecmnote/edit/{$row.idecm}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                                                    <a href="index.php/ecmnote/delete/{$row.idecm}"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                                                {/if}
                                            </td>
                            		    </tr>
                                	{/foreach}
                            	</tbody>
                            </table>
                            <div class="row">                                
                                <div class="pagination">
                                    {$pager}
                                </div>
                            </div>
                        
                        {else}
                <div class="flash">
                    <div class="message error">
                        <h2><p>No Records Found</p></h2>
                    </div>
                </div>

                        {/if}
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
{form_close()}