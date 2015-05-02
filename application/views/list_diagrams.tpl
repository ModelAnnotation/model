{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that lists all the diagrams associated with the project.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>{$information.title} {$information.who}</h3>
            </div>
            {if !$guest}
                {if $information.mode == 'edit'}
                    <div class="col-md-2 pull-right">
                        <a class="btn btn-primary" href='index.php/diagrams/' >List Project Diagrams</a>
                    </div>
                {else}
                    <div class="col-md-2 pull-right">
                        <a class="btn btn-primary" href='index.php/diagrams/diagram_upload' >Upload New Diagram File</a>
                    </div>
                {/if}
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

    <div class="row">
        <table class="table table-striped the-table">
   	        <thead>
                <th class="col-md-1"><h3><p class="text-left">Upload Date</p></h3></th>
                <th class="col-md-2"><h3><p class="text-left">File</p></h3></th>
                <th class="col-md-4"><h3><p class="text-left">Diagram Description</p></h3></th>
                <th class="col-md-2"><h3>Actions</h3></th>
       	    </thead>
       	    <tbody>
       	    {foreach $data as $row}
                <tr>
                    <td>{$row.uploaded}</td>
                    <td>{$row.filename}</td>
                    <td>{$row.description}</td>
                    <td>
                        {if !$guest}
                            <a href="index.php/diagrams/edit/{$row.diagram_id}"><img src="stylesheets/images/edit.png" alt="Edit record" /></a>
                            <a href='index.php/diagrams/delete/{$row.diagram_id}'onclick="return confirm('You Are About to Delete a Record and Uploaded File.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
                        {/if}
                
                        {if $row.filename == TRUE}
                            <a href="index.php/diagrams/download_file/{$row.filename}"><img src="stylesheets/images/download-icon.gif" alt="Download Diagram" /></a>
                            <a href="index.php/diagram/display_file/{$row.file_link}" target="_blank"><img src="stylesheets/images/File_Open_sm.png" alt="View File" /></a>
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
                   <h1><p class="text-center">No Records Found</p></h1>
                </div>
            </div>
        {/if}
    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
{form_close()}