<?php
//===========================================================================\\
// Aardvark Topsites PHP 5                                                   \\
// Copyright (c) 2003-2005 Jeremy Scheff.  All rights reserved.              \\
//---------------------------------------------------------------------------\\
// http://www.aardvarkind.com/                        http://www.avatic.com/ \\
//---------------------------------------------------------------------------\\
// This program is free software; you can redistribute it and/or modify it   \\
// under the terms of the GNU General Public License as published by the     \\
// Free Software Foundation; either version 2 of the License, or (at your    \\
// option) any later version.                                                \\
//                                                                           \\
// This program is distributed in the hope that it will be useful, but       \\
// WITHOUT ANY WARRANTY; without even the implied warranty of                \\
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General \\
// Public License for more details.                                          \\
//===========================================================================\\

class approve extends base {
  function approve() {
    global $FORM, $LNG, $TMPL;

    $TMPL['header'] = $LNG['a_approve_header'];

    if (!isset($FORM['u'])) {
      $this->form();
    }
    else {
      $this->process();
    }
  }

  function form() {
    global $CONF, $DB, $LNG, $TMPL;

    $alt = '';
    $num = 0;
    $result = $DB->query("SELECT username, url, title, email FROM {$CONF['sql_prefix']}_sites WHERE active = 0 ORDER BY username ASC", __FILE__, __LINE__);
    if ($DB->num_rows($result)) {
      $TMPL['admin_content'] = <<<EndHTML
<script language="javascript">
function check(form_name, field_name, value)
{
  var check_boxes = document.forms[form_name].elements[field_name];
  var num_check_boxes = check_boxes.length;

  if (!num_check_boxes)
  {
    check_boxes.checked = value;
  }
  else {
    for(var i = 0; i < num_check_boxes; i++)
    {
      check_boxes[i].checked = value;
    }
  }
}
</script>

<form action="index.php?a=admin" method="post" name="approve">
<table class="darkbg" cellpadding="1" cellspacing="1" width="100%">
<tr class="mediumbg">
<td></td>
<td align="center" width="1%">{$LNG['g_username']}</td>
<td width="100%">${LNG['table_title']}</td>
<td align="center" colspan="4">{$LNG['a_man_actions']}</td>
</tr>
EndHTML;

      while (list($username, $url, $title, $email) = $DB->fetch_array($result)) {
        $TMPL['admin_content'] .= <<<EndHTML
<tr class="lightbg{$alt}">
<td><input type="checkbox" name="u[]" value="{$username}" id="checkbox_{$num}" /></td>
<td align="center" valign="top">$username</td>
<td valign="top" width="100%"><a href="{$url}" onclick="out('{$username}');">{$title}</a></td>
<td align="center" valign="top"><a href="{$TMPL['list_url']}/index.php?a=admin&amp;b=approve&amp;u={$username}">{$LNG['a_approve']}</a></td>
<td align="center" valign="top"><a href="{$TMPL['list_url']}/index.php?a=admin&amp;b=edit&amp;u={$username}">{$LNG['a_man_edit']}</a></td>
<td align="center" valign="top"><a href="{$TMPL['list_url']}/index.php?a=admin&amp;b=delete&amp;u={$username}">{$LNG['a_man_delete']}</a></td>
<td align="center"><a href="mailto:{$email}">{$LNG['a_man_email']}</a></td>
</tr>
EndHTML;
        if ($alt) { $alt = ''; }
        else { $alt = 'alt'; }
        $num++;
      }

      $TMPL['admin_content'] .= <<<EndHTML
</table><br />
<a href="javascript:void;" onclick="check('approve', 'u[]', true)">{$LNG['a_man_all']}</a> | 
<a href="javascript:void;" onclick="check('approve', 'u[]', false)">{$LNG['a_man_none']}</a><br /><br />
{$LNG['a_approve_sel']}<br />
<select name="b">
<option value="approve">{$LNG['a_approve']}</option>
<option value="delete">{$LNG['a_man_delete']}</option>
</select>
<input type="submit" value="{$LNG['g_form_submit_short']}" />
</form>
EndHTML;
    }
    else {
      $TMPL['admin_content'] = $this->error($LNG['a_approve_none'], 'admin');
    }
  }

  function process() {
    global $DB, $FORM, $LNG, $TMPL;

    if (is_array($FORM['u']) && count($FORM['u']) > 1) {
      foreach ($FORM['u'] as $username) {
        $this->do_approve($username);
      }

      $LNG['a_approve_done'] = $LNG['a_approve_dones'];
    }
    else {
      if (is_array($FORM['u']) && count($FORM['u']) == 1) {
        $username = $DB->escape($FORM['u'][0]);
      }
      else {
        $username = $DB->escape($FORM['u']);
      }

      $this->do_approve($username);
    }

    $TMPL['admin_content'] = $LNG['a_approve_done'];
  }

  function do_approve($username) {
    global $CONF, $DB;

    $DB->query("UPDATE {$CONF['sql_prefix']}_sites SET active = 1 WHERE username = '{$username}'", __FILE__, __LINE__);
  }
}
?>
