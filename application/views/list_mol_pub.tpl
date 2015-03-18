{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page that lists all publications associated with a molecule or ECM Note.
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
                    <a class="btn btn-primary" href='index.php/rules/create' >Enter New Rule</a>
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
{assign var = "check" value = $data[0].PMID|cat:$data[0].ELocationID}
{/if}

    {if !empty($check)}

    <table class="table table-striped"> 
     <tbody>
            {foreach $data as $apub}
                <tr>
                    <td class="col-md-10">
                        {assign var = "title" value = '. '|cat:$apub['ArticleTitle']|cat:' ('|cat:$apub['PubDate']|cat:') '|cat:$apub['Title']|cat:'. '|cat:$apub['Volume']|cat:'('|cat:$apub['Issue']|cat:')'|cat:$apub['MedlinePgn'] }
                        
                        {foreach $apub['authors'] as $apeople}
                            {assign var = "sauthors" value = ''}
                            {if $apub["id"] == $apeople["pubmed_id"]}
                                {assign var = "authors" value = ' '|cat:$apeople['LastName']|cat:' '|cat:$apeople['Initials'] scope="global"}
                                {$authors}
                            {/if}
                        {/foreach}
                        {$title}
                    </td>
                    <td class="col-md-2">
                        <a href="http://www.ncbi.nlm.nih.gov/pubmed/{$apub['PMID']}" target="_blank"><img src="stylesheets/images/pubmed.jpg" alt="Pubmed Link" /></a>
                        {if !$guest}
                            <a href="index.php/pubmed/delete/{$apub['id']}" onclick="return confirm('You Are About to Delete a Record.  This Cannot be Undone.');" ><img src="stylesheets/images/delete.png" alt="Delete Record" /></a>
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
    <div class="alert alert-danger">
        <h1><p class="text-center">No Publications Found</p></h1>
    </div>
{/if}

 {if isset($tag)}
 <div class="row">
    <button class="btn btn-success btn-lg btn-block"
        <input type="button" value="Show Associated Publications" onclick="location.href='index.php/rules/find_molrules/{$tag}';"/>
        <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Rules
    </button>

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
</div>

 {else}
<div class="row">
    <button class="btn btn-success btn-lg btn-block"
        <input type="button" value="Show Associated Publications" onclick="location.href='index.php/rules/ecm_rules/{$data[0].idecm}';"/>
        <img src="stylesheets/images/icons/tick.png" alt="Associated Rules"/>Show Associated Rules
    </button>

    <div class="row">
        <a class="text_button_padding link_button" href="javascript:window.history.back();">GO BACK</a>
    </div>
</div>
{/if}

{form_close()}