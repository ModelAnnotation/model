{*<?php
/**
 * @author Dennis A. Simpson
 * @copyright  2015
 * @version 0.5
 * @abstract  This generates the page used to input the Rule Snippet search paramaterss.
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
                    <a class="btn btn-primary" href='index.php/rules/find_rulese' >New Snippet Search</a>
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

<div class="row">
    <h4>Paste all or part of a rule into the box and click the "Find Rules" button.  This search uses the MySQL "Like" as opposed to the MySQL "Is" as part
    of the search.  In general the larger the rule snippet used the more specific the search will be.  If the search does not return the expected results
    try it again with fewer paramaters.  This search is especially useful for returning all rules associated with one or a few molecules/entities.
    </h4>
                
</div>
<div class="form-horizontal">
    <div class="form-group">
        
  		<div class="col-md-12">
            <input title="Paste or type a Rule Snippet into box." class="form-control" placeholder="Enter Rule Snippet" type="text" maxlength="400" value="{if isset($rules_data)}{$rules_data.rule}{/if}" name="rulesnippet" />
  		</div>
   	</div>

    <div class="row">
            <button class="btn btn-success btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Rule Search"> Find Associated Rules
            </button>
                        
                                            
            <span class="text_button_padding">or</span>
                <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
        </div>
    </div><!----- Horizontal Form ----->
{form_close()}
