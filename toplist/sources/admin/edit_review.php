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

class edit_review extends base {
  function edit_review() {
    global $CONF, $DB, $FORM, $LNG, $TMPL;

    $TMPL['header'] = $LNG['a_edit_rev_header'];

    $TMPL['id'] = intval($FORM['id']);
    list($TMPL['date']) = $DB->fetch("SELECT date FROM {$CONF['sql_prefix']}_reviews WHERE id = {$TMPL['id']}", __FILE__, __LINE__);
    if ($TMPL['date']) {
      if (!isset($FORM['submit'])) {
        $this->form();
      }
      else {
        $this->process();
      }
    }
    else {
      $this->error($LNG['a_del_rev_invalid_id'], 'admin');
    }
  }

  function form() {
    global $CONF, $DB, $LNG, $TMPL;

    list($TMPL['review']) = $DB->fetch("SELECT review FROM {$CONF['sql_prefix']}_reviews WHERE id = {$TMPL['id']}", __FILE__, __LINE__);
    $TMPL['review']  = str_replace('<br />', '', $TMPL['review']);
    $TMPL['review']  = str_replace('&lt;', '<', $TMPL['review']);
    $TMPL['review']  = str_replace('&gt;', '>', $TMPL['review']);

    $TMPL['admin_content'] = <<<EndHTML
<form action="index.php?a=admin&amp;b=edit_review&amp;id={$TMPL['id']}" method="post">
<fieldset>
<legend>{$LNG['a_edit_rev_header']}</legend>
<label>{$LNG['a_man_rev_rev']}<br />
<textarea cols="40" rows="5" name="review">{$TMPL['review']}</textarea><br /><br />
</label>
<input name="submit" type="submit" value="{$LNG['a_edit_rev_header']}" />
</fieldset>
</form>
EndHTML;
  }

  function process() {
    global $CONF, $DB, $FORM, $LNG, $TMPL;

    $TMPL['review']  = str_replace('<', '&lt;', $FORM['review']);
    $TMPL['review']  = str_replace('>', '&gt;', $TMPL['review']);
    $TMPL['review']  = nl2br($TMPL['review'] );
    $TMPL['review'] = $DB->escape($TMPL['review']);
    $DB->query("UPDATE {$CONF['sql_prefix']}_reviews SET review = '{$TMPL['review']}' WHERE id = {$TMPL['id']}", __FILE__, __LINE__);
 
    $TMPL['admin_content'] = $LNG['a_edit_rev_edited'];
  }
}
?>
