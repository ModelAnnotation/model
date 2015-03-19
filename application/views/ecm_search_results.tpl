{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that lists rules associated with an ecm note.
 */	
?>*}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
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
                <div class="col-md-5">
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
                <div class="col-md-5">
                    <h3>  {$information.errors}</h3>
                </div>
            </div>
        </div>
    </div>
{/if}

{form_open_multipart( uri_string())}

{if !empty($data)}
    {assign var = "check" value = $data[0].rule}
{/if}

  {if !empty( $check )}

        <table class="table table-striped">
            <thead>
                <th class="col-md-5">{$rules_fields.rule}</th>
                <th class="col-md-5">{$rules_fields.rulenote}</th>
                <th class="col-md-2">Actions</th>
            </thead>
            <tbody>
                {foreach $data as $row}
                    <tr>
				        <td class="col-md-5">{$row.rule}</td>
				        <td class="col-md-5">{$row.rulenote}</td>
                        <td class="col-md-2">
                            <a href="index.php/rules/showall/{$row.idrules}"><img src="stylesheets/images/mol_sm.jpg" alt="Show Molecules" /></a>
                            {if !$guest}
                                <a href="index.php/rules/edit/{$row.idrules}"><img src="stylesheets/images/edit.png" alt="Edit Rule" /></a>
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
    <h1><p class="text-center">No Rules Found</p></h1>
    </div>
    </div>
{/if}

        <div class="row">
              
                <button class="btn btn-primary btn-lg btn-block"
                    <input type="button" value="Show Associated Publications" onclick="location.href='index.php/pubmed/pub_list/{$id}';"/>
                    <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Publications
                </button>
            
            <span class="text_button_padding">or</span>
            <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
                  
        </div>

{form_close()}