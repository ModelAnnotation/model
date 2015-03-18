<?php /* Smarty version Smarty-3.1.17, created on 2015-03-01 20:27:01
         compiled from "C:\Program Files (x86)\Zend\Apache2\htdocs\model\application\views\auth\edit_user.php" */ ?>
<?php /*%%SmartyHeaderCode:1487454f3ae558083c6-38061266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47d9df582304a469d8a51752a3bf84375b5640c4' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache2\\htdocs\\model\\application\\views\\auth\\edit_user.php',
      1 => 1425239978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1487454f3ae558083c6-38061266',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f3ae5585e2e3_76409990',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f3ae5585e2e3_76409990')) {function content_54f3ae5585e2e3_76409990($_smarty_tpl) {?><h1><<?php ?>?php echo lang('edit_user_heading');?<?php ?>></h1>
<p><<?php ?>?php echo lang('edit_user_subheading');?<?php ?>></p>

<div id="infoMessage"><<?php ?>?php echo $message;?<?php ?>></div>

<<?php ?>?php echo form_open(uri_string());?<?php ?>>

      <p>
            <<?php ?>?php echo lang('edit_user_username_label', 'username');?<?php ?>> <br />
            <<?php ?>?php echo form_input($username);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_fname_label', 'first_name');?<?php ?>> <br />
            <<?php ?>?php echo form_input($first_name);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_lname_label', 'last_name');?<?php ?>> <br />
            <<?php ?>?php echo form_input($last_name);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_company_label', 'company');?<?php ?>> <br />
            <<?php ?>?php echo form_input($company);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_phone_label', 'phone');?<?php ?>> <br />
            <<?php ?>?php echo form_input($phone);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_password_label', 'password');?<?php ?>> <br />
            <<?php ?>?php echo form_input($password);?<?php ?>>
      </p>

      <p>
            <<?php ?>?php echo lang('edit_user_password_confirm_label', 'password_confirm');?<?php ?>><br />
            <<?php ?>?php echo form_input($password_confirm);?<?php ?>>
      </p>

      <<?php ?>?php if ($this->ion_auth->is_admin()): ?<?php ?>>

          <h3><<?php ?>?php echo lang('edit_user_groups_heading');?<?php ?>></h3>
          <<?php ?>?php foreach ($groups as $group):?<?php ?>>
              <label class="checkbox">
              <<?php ?>?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?<?php ?>>
              <input type="checkbox" name="groups[]" value="<<?php ?>?php echo $group['id'];?<?php ?>>"<<?php ?>?php echo $checked;?<?php ?>>>
              <<?php ?>?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?<?php ?>>
              </label>
          <<?php ?>?php endforeach?<?php ?>>

      <<?php ?>?php endif ?<?php ?>>

      <<?php ?>?php echo form_hidden('id', $user->id);?<?php ?>>
      <<?php ?>?php echo form_hidden($csrf); ?<?php ?>>

      <p><<?php ?>?php echo form_submit('submit', lang('edit_user_submit_btn'));?<?php ?>></p>

<<?php ?>?php echo form_close();?<?php ?>>
<?php }} ?>
