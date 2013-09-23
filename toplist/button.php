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

// Change the path to your full path if necessary
$CONF['path'] = '.';

// Connect to the database
require_once("{$CONF['path']}/settings_sql.php");
require_once("{$CONF['path']}/sources/sql/{$CONF['sql']}.php");
$DB = new sql;
$DB->connect($CONF['sql_host'], $CONF['sql_username'], $CONF['sql_password'], $CONF['sql_database']);

// Settings
$settings = $DB->fetch("SELECT * FROM {$CONF['sql_prefix']}_settings", __FILE__, __LINE__);
$CONF = array_merge($CONF, $settings);

// Check id for backwards compatability with 4.x
if (isset($_GET['id']) && $_GET['id'] && !$_GET['u']) {
  $username = $DB->escape($_GET['id']);
}
else {
  $username = $DB->escape($_GET['u']);
}

// Is this a unique hit?
$ip = getenv("REMOTE_ADDR");
list($ip_sql, $unq_pv) = $DB->fetch("SELECT ip_address, unq_pv FROM {$CONF['sql_prefix']}_ip_log WHERE ip_address = '$ip' AND username = '{$username}'", __FILE__, __LINE__);

$unique_sql = ', unq_pv_overall = unq_pv_overall + 1, unq_pv_0_daily = unq_pv_0_daily + 1, unq_pv_0_weekly = unq_pv_0_weekly + 1, unq_pv_0_monthly = unq_pv_0_monthly + 1';
if ($ip == $ip_sql && $unq_pv == 0) {
  $DB->query("UPDATE {$CONF['sql_prefix']}_ip_log SET unq_pv = 1 WHERE ip_address = '{$ip}' AND username = '{$username}'", __FILE__, __LINE__);
}
elseif ($ip != $ip_sql) {
  $DB->query("INSERT INTO {$CONF['sql_prefix']}_ip_log (ip_address, username, unq_pv) VALUES ('{$ip}', '{$username}' ,1)", __FILE__, __LINE__);
}
else {
  $unique_sql = '';
}

// Update stats
$DB->query("UPDATE {$CONF['sql_prefix']}_stats SET tot_pv_overall = tot_pv_overall + 1, tot_pv_0_daily = tot_pv_0_daily + 1, tot_pv_0_weekly = tot_pv_0_weekly + 1, tot_pv_0_monthly = tot_pv_0_monthly + 1{$unique_sql} WHERE username = '{$username}'", __FILE__, __LINE__);

// What button to display?
if ($CONF['ranks_on_buttons']) {
  // See if rank is freshly cached.  If so, use cached value.  If not, calculate rank.
  list($rank_cache, $rank_cache_time) = $DB->fetch("SELECT rank_cache, rank_cache_time FROM {$CONF['sql_prefix']}_stats WHERE username = '{$username}'", __FILE__, __LINE__);

  $current_time = time();
  if ($current_time - (12*3600) < $rank_cache_time) {
    if ($rank_cache > 0 && $rank_cache <= $CONF['button_num']) {
      $rank = $rank_cache;
      $location = "{$CONF['button_dir']}/{$rank}.{$CONF['button_ext']}";
      $rank_on_button = 1;
    }
  }
  else {
    require_once "{$CONF['path']}/sources/misc/classes.php";
    $rank_by = base::rank_by();

    list($hits) = $DB->fetch("SELECT {$rank_by} FROM {$CONF['sql_prefix']}_stats WHERE username = '{$username}'", __FILE__, __LINE__);
    if ($hits) {
      $result = $DB->select_limit("SELECT count(*) FROM {$CONF['sql_prefix']}_stats WHERE ({$rank_by}) >= $hits", $CONF['button_num'], 0, __FILE__, __LINE__);
      list($rank) = $DB->fetch_array($result);

      if ($rank <= $CONF['button_num']) {
        $location = "{$CONF['button_dir']}/{$rank}.{$CONF['button_ext']}";
        $rank_on_button = 1;

        $new_rank_cache = $rank;
      }
      else {
        $new_rank_cache = 0;
      }
    }
    if (isset($new_rank_cache)) {
      $DB->query("UPDATE {$CONF['sql_prefix']}_stats SET rank_cache = {$new_rank_cache}, rank_cache_time = {$current_time} WHERE username = '{$username}'", __FILE__, __LINE__);
    }
  }

  // Stat Buttons
  if ($CONF['ranks_on_buttons'] == 2) {
    require_once "{$CONF['path']}/settings_buttons.php";
    exit;
  }
}

$DB->close();

if (!$rank_on_button) {
  $location = $CONF['button_url'];
}

header("Location: {$location}");
?>
