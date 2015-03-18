{*
<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page thas lists all the users or groups in the model.
 */	
?>
*}  

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-10">
                <h3>{$information.title}</h3>
            </div>
            {if !$information.user}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/sysadmin/create_user' >New User</a>
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
        <th class="col-md-1"><h4>User</h4></th>
        <th class="col-md-1"><h4>{$fields.activated}</h4></th>
        <th class="col-md-2"><h4>Name</h4></th>
        <th class="col-md-3"><h4>{$fields.organization}</h4></th>
        <th class="col-md-1"><h4>{$fields.last_ip}</h4></th>
        <th class="col-md-1"><h4>{$fields.last_login}</h4></th>
        <th class="col-md-1"><h4>Actions</h4></th>
   	</thead>
   	<tbody>
   	{foreach $data as $row}
        <tr>
            <td>{$row.username}</td>
            <td>{$row.activated}</td>
            <td>{$row.name}</td>
            <td>{$row.organization}</td>
            <td>{$row.last_ip}</td>
            <td>{$row.last_login}</td>
            <td>
                {if $information.permission}
                    <a href='index.php/sysadmin/edit_user/{$row.id}'><img src="stylesheets/images/edit.png" alt="Edit User" /></a>
                    <a href="index.php/sysadmin/delete/{$row.id}"onclick="return confirm('You Are About to Delete a User.  This Cannot be Undone.');"><img src="stylesheets/images/delete.png" alt="Delete record" /></a>
                {/if}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>   

{if !empty( $pager )}
<div class="row">
    <div class="pagination pagination-large">
        {$pager}
    </div>
</div>    
{/if}
<div class="row">
{else}
    <div class="alert alert-danger">
    <h1><p class="text-center">No Records Found</p></h1>
    </div>
    </div>
{/if}
{form_close()}

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
