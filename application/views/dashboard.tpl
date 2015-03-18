{*
<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the home page.
 */	
?>
*}  

{if isset($information.project_id)}
    <div class="row">
        <div class="alert-success">
            <div class="row">
                <div class="col-md-10">
                    <h2>Working with Project: {$data.name} </h2>
                </div>
            </div>
        </div>
    </div>
{else}
    <div class="row">
        <div class="alert-danger">
            <div class="row">
                <div class="col-md-12">
                    <h2><p>PLEASE SELECT A PROJECT TO EXPLORE OR ANNOTATE TO PROCEED</p></h2>
                </div>
            </div>
        </div>
    </div>
{/if}
{if isset($information.messages)}
    <div class="row">
        <div class="alert-info">
            <div class="row">
                <div class="col-md-12">
                    <h2><p>{$information.messages}</p></h2>
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
                    <h2><p>Please Select a Project Before Updating.</p></h2>
                </div>
            </div>
        </div>
    </div>
{/if}

{form_open_multipart( uri_string())}

    <div class="row">

    	<div id="columns_holder">
    		<p>This site was designed and built by Dennis Simpson.  The site is intended to aid in the annotation of of Rule Based Models of the Cell Cycle.  It could be adapted to any mathmatical model type.
            ECM is short for Extended Contact Map.  The model presented here is an extension of <a href="http://www.ncbi.nlm.nih.gov/pubmed/23266715" target="_blank">Kesseler, et al. 2013</a>.
            The rules have been refactored for <a href="http://emonet.biology.yale.edu/nfsim/" target="_blank">NFsim</a>.  These diagrams are based on 
            <a href="http://www.ncbi.nlm.nih.gov/pubmed/21647530" target="_blank">Chylek, et al. 2011</a> 
            and follow the entity relationship nomencalture recomendations of <a href="http://www.sbgn.org/Main_Page" target="_blank">SBGN</a>.</p>
            
            <p id="t1">To use this package look at the diagrams and find a note that corresponds to a reaction of interest.  Enter that note into the search
            form.  The search will return all rules associated with a given note OR all publications used to justify the rule.  From a Rule one can find all 
            molecules (proteins) associated and all components and states of a given molecule.</p>
            <p id="t2">Not all publication links are in the database yet.</p>
    	</div>
        
        </div>
    <div class="row">
    <div class="col-md-3">
    <label class="label-info" for="project" >Select Project to Explore or Annotate:</label>
    </div>
	   <select class="form-control" name="project_id" style="width:300px" >
            <option value="0"></option>
                {foreach $data.related_projects as $rel}
                    <option value="{$rel.id_project}" id="project_id">{$rel.project_name}</option>
                {/foreach}
        </select>
    </div>
        <br />
        <div class="row">
                {if ISSET ($project_id)}
                    <button class="btn btn-success btn-lg btn-block" type="post">
                        <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Select Another Project
                    </button>
                {else}
                    <button class="btn btn-warning btn-lg btn-block" type="post">
                        <img src="stylesheets/images/icons/tick.png" alt="Select Project"/> Select Project
                    </button>
                {/if}
                
              </div>  
                
    </div><!-- .row -->
{form_close()}