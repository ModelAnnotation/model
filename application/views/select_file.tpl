{* <?php
/**
 *  @author Dennis A. Simpson
 *  @copyright 2015
 *  @version 1.1 Beta
 *  @abstract Form allows PubMed XML file to be selected for upload.
*/	
?> *}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-8">
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

    <div class="form-group">
        <label id="file_input">File Input</label>
        <input type="file" id="file_input" name="userfile"/>
        <p class="help-block">Select PubMed XML file.</p>
    </div>
                
    <div class="form-group">
        <label id="ecm">{'ECM Note ID'}</label>
        <div >
            <select class="form-control" id="ecm" name="idecm" >
                <option value="0"></option>
                {foreach $related_ecmnote as $rel}
                    <option value="{$rel.ecmnote_id}">{$rel.ecmnote_name}</option>
                {/foreach}
            </select>
        </div>
    </div>
                
    {if isset($data)}
        <div class="row">
            <div class="alert alert-success">
                <p><h2>Inserted Refrence:</h2></p> 
                <p><h4>
                    {$data.LastName},&nbsp;{$data.Initials}.&nbsp;et al. &nbsp;{$data.ArticleTitle}.&nbsp;{$data.PubDate}.&nbsp;
                    {$data.Title}.&nbsp;{$data.PubDate},&nbsp;{$data.Volume}{if isset($data.Issue)}({$data.Issue}) {/if}:{$data.MedlinePgn}
                </h4></p>                
            </div>
        </div>
    {/if}

    <div class="row">
        <button class="btn btn-warning btn-lg btn-block" type="post">
            <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Save Edits
        </button>
    </div>
    <span class="text_button_padding">or</span>
    <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                
{form_close()}