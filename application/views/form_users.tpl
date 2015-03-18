{* @abstract This file is used to add new records to users table and to edit exsisting users *}
{* @author  Dennis A. Simpson *}
{* @copyright 2015 *}

<div class="row">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-5">
                <h3>Editing User: {$information.who}</h3>
            </div>
            {if !$user}
                <div class="col-md-2 pull-right">
                    <a class="btn btn-primary" href='index.php/sysadmin/list_users' >List All Users</a>
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

{if isset($information.errors)}
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
    <div class="form-horizontal">
                
        <div class="form-group">
            <label class="col-md-2 control-label" for="user">{$fields.username}</label>
            <div class="col-md-10">
                <input class="form-control" id="user" type="text" maxlength="50" value="{if isset($data)}{$data.username}{/if}" name="username" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.first_name}</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="100" value="{if isset($data)}{$data.first_name}{/if}" name="first_name" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.last_name}</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" maxlength="100" value="{if isset($data)}{$data.last_name}{/if}" name="last_name" />
                </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                {foreach $data.groups as $group}
                    <label class="checkbox-inline">
                        {$gID=$group.id}
                        {$checked = null}
                                
                        {foreach $data.currentGroups as $grp}
                            {if $gID == $grp->id}
                                {$checked= ' checked="checked"'}
                            {/if}
                        {/foreach}
              
                        <input type="checkbox" name="groups[]" value="{$group.id}" {$checked}/>{$group.name|escape}
                    </label>
                {/foreach}
                    <label class="checkbox-inline">
                        <input type="checkbox"  id="A1" value="1" name="activated"{if $data.activated == 1} checked="checked"{/if} />{$fields.activated}
                    </label>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.phone}</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="12" value="{if isset($data)}{$data.phone}{/if}" name="phone" />
            </div>
        </div>
    		
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.organization}</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="400" value="{if isset($data)}{$data.company}{/if}" name="company" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.email}</label>
            <div class="col-md-10">
                <input class="form-control" type="text" maxlength="40" value="{if isset($data)}{$data.email}{/if}" name="email" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.password}</label>
            <div class="col-md-10">
                <input class="form-control" type="password" maxlength="40" value="{if isset($data)}{$data.password}{/if}" name="password" />
            </div>
        </div>
                
        <div class="form-group">
            <label class="col-md-2 control-label">{$fields.password_confirm}</label>
            <div class="col-md-10">
                <input class="form-control" type="password" maxlength="40" value="{if isset($data)}{$data.password_confirm}{/if}" name="password_confirm" />
            </div>
        </div>    

        <div class="row">
            <button class="btn btn-warning btn-lg btn-block" type="submit">
                <img src="stylesheets/images/icons/tick.png" alt="Save"/> Save Edits
            </button>
        </div>

        <div class="row">
            <button formmethod="post" formaction="index.php/sysadmin/delete/{$data.id}" class="btn btn-danger btn-lg btn-block"  type="submit">
                <img src="stylesheets/images/delete.png" alt="Delete User Credentials"> Delete User
            </button>
        </div>
 
        <span class="text_button_padding">or</span>
        <a class="text_button_padding link_button" href="javascript:window.history.back();">Cancel</a>
                    
    </div><!----- Horizontal Form ----->
{form_close()}
