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

// When you make a new translation, fill out the following four variables to
// get credit for you work.
$translation = 'Danish';
$translator_name = 'Helmuth Mikkelsen';
$translator_email = 'helmuthm@gmail.com';
$translator_url = 'http://www.helmuth.dk/';

// Global
$LNG['g_form_submit_short'] = "Udf�r";
$LNG['g_username'] = "Brugernavn";
$LNG['g_url'] = "URL";
$LNG['g_title'] = "Titel";
$LNG['g_description'] = "Beskrivelse"; 
$LNG['g_category'] = "Kategori"; // 4.1.0
$LNG['g_email'] = "Email";
$LNG['g_banner_url'] = "Banner URL";
$LNG['g_password'] = "Kodeord";
$LNG['g_average'] = "Gennemsnit"; 
$LNG['g_today'] = "I dag";
$LNG['g_yesterday'] = "I g�r";
$LNG['g_daily'] = "Dagligt"; // 5.0
$LNG['g_this_month'] = "Denne m�ned"; // 5.0
$LNG['g_last_month'] = "Seneste m�ned"; // 5.0
$LNG['g_monthly'] = "M�nedligt"; // 5.0
$LNG['g_this_week'] = "Denne uge"; // 5.0
$LNG['g_last_week'] = "Seneste uge"; // 5.0
$LNG['g_weekly'] = "Ugentlig"; // 5.0
$LNG['g_pv'] = 'Sidevisninger'; // 5.0
$LNG['g_overall'] = 'I alt'; // 5.0
$LNG['g_in'] = 'Ind'; // 5.0
$LNG['g_out'] = 'Ud'; // 5.0
$LNG['g_unq_pv'] = "Unikke sidevisninger"; // 5.0
$LNG['g_tot_pv'] = "Sidevisninger i alt"; // 5.0
$LNG['g_unq_in'] = "Unikke ind"; // 5.0
$LNG['g_tot_in'] = "Ind i alt"; // 5.0
$LNG['g_unq_out'] = "Unikke ud"; // 5.0
$LNG['g_tot_out'] = "Unikke ud"; // 5.0
$LNG['g_invalid_u_or_p'] = "Ikke gyldigt brugernavn eller kodeord.  Pr�v venligst igen."; // 5.0
$LNG['g_invalid_u'] = "Ugyldigt brugernavn.  Pr�v venligst igen."; // 5.0
$LNG['g_invalid_p'] = "Ugyldigt kodeord.  Pr�v venligst igen."; // 5.0
$LNG['g_session_expired'] = "Din session er udl�bet.  Pr�v venligst igen."; // 5.0
$LNG['g_error'] = "Fejl"; // 5.0
$LNG['g_delete_install'] = "Af sikkerheds�rsager skal du slette installations-folderen f�r scriptet kan afvikles."; // 5.0

// Edit Account
$LNG['edit_header'] = "Rediger konto";
$LNG['edit_info_edited'] = "Din konto er blevet opdateret.";
$LNG['edit_password_blank'] = "Lad st� tom for at beholde nuv�rende kodeord"; // 4.0

// Gateway Page
$LNG['gateway_header'] = "Topsites portalside";
$LNG['gateway_text'] = "For at forhindre snyd er der opsat en s�kaldt portalside. Klik for at komme til denne topliste.";
$LNG['gateway_vote'] = "G� til side og afgiv din stemme"; 
$LNG['gateway_no_vote'] = "G� til side uden at stemme"; // 5.0

// Install
$LNG['install_header'] = "Installer";
$LNG['install_welcome'] = "Velkommen til Aardvark Topsites PHP 5.  Udfyld formularen nedenfor for at installere scriptet.";
$LNG['install_sql_prefix'] = "Tabel pr�fiks - skift kun denne hvis du har mere end en liste der k�rer fra samme database"; 
$LNG['install_error_chmod'] = "Kunne ikke skrive til settings_sql.php.  Tjek at settings_sql.php er sat til CHMOD 666.";
$LNG['install_error_sql'] = "Kunne ikke forbinde til SQL-databasen.  G� tilbage og tjek dine SQL-indstillinger."; 
$LNG['install_done'] = "Din topsites liste er blevet installeret.  Slet denne folder nu.";
$LNG['install_your'] = "Din Topsites liste";
$LNG['install_admin'] = "Admin";
$LNG['install_manual'] = "Manual"; 
$LNG['upgrade_header'] = "Opgrader";
$LNG['upgrade_welcome'] = "Velkommen til Aardvark Topsites PHP 5.  F�r du opgraderer skal du huske at tage backup af dine data.";
$LNG['upgrade_error_version'] = "Opgradering er kun tilg�ngelig for Aardvark Topsites PHP 4.1.0 eller h�jere.";
$LNG['upgrade_done'] = "Din topsites liste er blevet opgraderet.  Slet denne folder nu.";

// Join
$LNG['join_header'] = "Tilmeld";
$LNG['join_enter_text'] = "Indtast teksten som den vises i billedet herunder:"; // 4.2.2
$LNG['join_user'] = "Bruger"; // 5.0
$LNG['join_website'] = "Hjemmeside"; // 5.0
$LNG['join_error_forgot'] = "Du glemte at:";
$LNG['join_error_username'] = "Indtaste et gyldigt brugernavn: benyt kun bogstaver, tal, understregning og tankestreger."; // 5.0
$LNG['join_error_username_duplicate'] = "Indtaste et gyldigt brugernavn: dit brugernavn benyttes allerede."; // 5.0
$LNG['join_error_url'] = "Indtaste en gyldig URL.";
$LNG['join_error_email'] = "Indtaste en gyldig emailadresse.";
$LNG['join_error_title'] = "Indtaste en titel til din hjemmeside."; 
$LNG['join_error_password'] = "Indtaste et kodeord.";
$LNG['join_error_urlbanner'] = "Indtaste et gyldigt banner.  Lad denne st� tom, hvis ikke du har et.  Det skal v�re mindre end"; // 4.0
$LNG['join_error_back'] = "G� venligst tilbage og ret disse fejl."; 
$LNG['join_error_time'] = "Undlad at genindl�se tilmeldingssiden."; // 4.2.0
$LNG['join_error_captcha'] = "Koden du indtastede er ikke det samme som p� billedet."; // 4.2.2
$LNG['join_thanks'] = "Tak for tilmeldingen!  Inds�t denne kode p� din side for at blive listet."; 
$LNG['join_change_warning'] = "Hvis du �ndrer koden, virker det m�ske ikke.";
$LNG['join_welcome'] = "Velkommen til %s";
$LNG['join_welcome_admin'] = "En ny bruger har tilmeldt sig din topsites liste.";

// Link Code
$LNG['link_code_header'] = "Link kode"; // 5.0

// Lost Password
$LNG['lost_pw_header'] = "Mistet kodeord"; // 5.0
$LNG['lost_pw_forgot'] = "Glemt dit kodeord?"; // 5.0
$LNG['lost_pw_get'] = "Hent kodeord"; // 5.0
$LNG['lost_pw_emailed'] = "Tjek din email for yderligere instruktioner."; // 5.0
$LNG['lost_pw_email'] = "For at f� et nyt kodeord til din hjemmeside, skal du bare g� til denne URL:"; // 5.0
$LNG['lost_pw_new'] = "Indtast nyr kodeord"; // 5.0
$LNG['lost_pw_set_new'] = "Gem nyt kodeord"; // 5.0
$LNG['lost_pw_finish'] = "Dit kodeord er nu sat til at v�re det nye du netop har valgt."; // 5.0

// Main Page
$LNG['main_header'] = "Bed�mmelser"; // 5.0
$LNG['main_all'] = "Alle sites"; // 4.2.0
$LNG['main_method'] = "Bed�mmelsesmetode";
$LNG['main_members'] = "Brugere"; 
$LNG['main_menu_rankings'] = "Bed�mmelser";
$LNG['main_menu_join'] = "Tilmeld";
$LNG['main_menu_random'] = "Tilf�ldig bruger";
$LNG['main_menu_search'] = "S�g";
$LNG['main_menu_lost_code'] = "Mistet kode"; // 5.0
$LNG['main_menu_lost_password'] = "Mistet kodeord"; // 5.0
$LNG['main_menu_edit'] = "Rediger bruger info";
$LNG['main_menu_user_cp'] = "Bruger kontrol panel"; // 5.0
$LNG['main_featured'] = "Udvalgt bruger"; // 4.0.2
$LNG['main_executiontime'] = "Script afviklingstid"; // 4.0
$LNG['main_queries'] = "SQL foresp�rgsler"; // 4.0
$LNG['main_powered'] = "Powered by";

// Ranking Table
$LNG['table_stats'] = "Statistik";
$LNG['table_unique'] = "Unikke";
$LNG['table_total'] = "Total";
$LNG['table_rank'] = "Rang";
$LNG['table_title'] = "Titel"; // 4.0
$LNG['table_description'] = "Beskrivelse"; // 4.0
$LNG['table_movement'] = "�ndring";
$LNG['table_up'] = "Op"; // 5.0
$LNG['table_down'] = "Ned"; // 5.0
$LNG['table_neutral'] = "U�ndret"; // 5.0

// Rate and Review
$LNG['rate_header'] = "Bed�m og komment�r";
$LNG['rate_rating'] = "Bed�mmelse";
$LNG['rate_review'] = "Kommentar - ingen HTML tilladt"; // 5.0
$LNG['rate_thanks'] = "Tak for din bed�mmelse."; 
$LNG['rate_error'] = "Du har allerede bed�mt dette site.";
$LNG['rate_back'] = "Tilbage til statistik";

// Search
$LNG['search_header'] = "S�g";
$LNG['search_off'] = "S�gefunktionen er sl�et fra.";
$LNG['search_for'] = "Du s�gte efter";
$LNG['search_no_sites'] = "Desv�rre, ingen sites matcher dine s�gekriterier."; // 5.0
$LNG['search_prev'] = "Forrige"; // 3.2.1
$LNG['search_next'] = "N�ste"; // 3.2.1

// Stats
$LNG['stats_header'] = "Statistik";
$LNG['stats_info'] = "Info";
$LNG['stats_member_since'] = "Bruger siden"; // 5.0
$LNG['stats_rating_avg'] = "Gennemsnitlig bed�mmelse"; 
$LNG['stats_rating_num'] = "Antal bed�mmelser";
$LNG['stats_rate'] = "Bed�m og komment�r dette site";
$LNG['stats_reviews'] = "Kommentarer";
$LNG['stats_allreviews'] = "Vis alle kommentarer"; // 4.0
$LNG['stats_week'] = "Uge"; // 5.0
$LNG['stats_highest'] = "H�jeste"; // 5.0

// ssi.php
$LNG['ssi_top'] = "Top %s sites"; // 4.0
$LNG['ssi_new'] = "%s nyeste brugere"; // 5.0
$LNG['ssi_all'] = "Alle sites"; // 4.0

// User Control Panel // 5.0
$LNG['user_cp_header'] = "Bruger kontrol panel"; // 5.0
$LNG['user_cp_login'] = "Log ind"; // 5.0
$LNG['user_cp_logout'] = "Log ud"; // 5.0
$LNG['user_cp_welcome'] = "Velkommen til bruger kontrol panel.  Benyt linksene til venstre for at ordne din konto."; // 5.0
$LNG['user_cp_logout_message'] = "Du er nu logget ud af bruger kontrol panelet."; // 5.0

// Admin > Approve New Members // 4.0
$LNG['a_approve_header'] = "Godkend nye brugere"; // 5.0
$LNG['a_approve'] = "Godkend"; // 4.0
$LNG['a_approve_none'] = "Der er ingen nye brugere der venter p� godkendelse."; // 4.0
$LNG['a_approve_done'] = "Brugeren er blevet godkendt."; // 4.0
$LNG['a_approve_dones'] = "Brugerne er blevet godkendt."; // 4.0
$LNG['a_approve_sel'] = "Med det valgte:"; // 5.0

// Admin > Approve New Reviews // 5.0
$LNG['a_approve_rev_header'] = "Godkend nye kommentarer"; // 5.0
$LNG['a_approve_rev_none'] = "Der er ingen kommentarer der venter p� godkendelse."; // 5.0
$LNG['a_approve_rev_done'] = "Kommentaren er blevet godkendt."; // 5.0
$LNG['a_approve_rev_dones'] = "Kommentarerne er blevet godkendt."; // 5.0

// Admin > Delete Member
$LNG['a_del_header'] = "Slet bruger"; // 5.0
$LNG['a_del_headers'] = "Slet brugere"; // 5.0
$LNG['a_del_done'] = "Brugeren er nu slettet."; // 5.0
$LNG['a_del_dones'] = "Brugerne er nu slettede."; // 5.0
$LNG['a_del_warn'] = "Er du sikker p� at du vil slette %s?"; // 5.0
$LNG['a_del_multi'] = "disse %s brugere"; //5.0

// Admin > Delete Review // 5.0
$LNG['a_del_rev_header'] = "Slet kommentar"; // 5.0
$LNG['a_del_rev_headers'] = "Slet kommentarer"; // 5.0
$LNG['a_del_rev_done'] = "Kommentaren er nu slettet."; // 5.0
$LNG['a_del_rev_dones'] = "Kommentarerne er nu slettede."; // 5.0
$LNG['a_del_rev_warn'] = "Er du sikker p� at du vil slette denne kommentar?"; //5.0
$LNG['a_del_rev_warns'] = "Er du sikker p� at du vil slette disse kommentarer?"; //5.0 
$LNG['a_del_rev_invalid_id'] = "Ugyldigt kommentar ID.  Pr�v venligst igen."; // 5.0

// Admin > Edit Member
$LNG['a_edit_header'] = "Rediger bruger"; // 5.0
$LNG['a_edit_site_is'] = "Dette site er"; // 4.0
$LNG['a_edit_active'] = "Aktiv (listet)"; // 4.0
$LNG['a_edit_inactive'] = "Ikke aktiv (ikke listet)"; // 5.0
$LNG['a_edit_edited'] = "Brugeren er nu redigeret.";

// Admin > Edit Review // 5.0
$LNG['a_edit_rev_header'] = "Rediger kommentar"; // 5.0
$LNG['a_edit_rev_edited'] = "Kommentaren er nu redigeret.";

// Admin > Email Members
$LNG['a_email_header'] = "Email brugere"; // 5.0
$LNG['a_email_subject'] = "Emne"; // 4.2.0
$LNG['a_email_message'] = "Besked"; // 4.2.0
$LNG['a_email_msg_sent'] = "En email er sendt til %s"; // 5.0
$LNG['a_email_not_sent'] = "En email kunne ikke sendes til %s"; // 5.0
$LNG['a_email_sent'] = "%s brugere fik tilsendt en email."; // 4.2.0
$LNG['a_email_failed'] = "%s brugere fik ikke tilsendt en email."; // 4.2.0

// Admin > Logout
$LNG['a_logout_message'] = "Du er nu logget ud fra administrationen."; // 5.0

// Admin > Main
$LNG['a_header'] = "Administration"; // 5.0
$LNG['a_main'] = "Velkommen til administrationen.  Benyt linksene til venstre til at ordne din topsites liste."; // 5.0
$LNG['a_main_approve'] = "1 site venter p� godkendelse."; // 5.0
$LNG['a_main_approves'] = "%s sites venter p� godkendelse."; // 5.0
$LNG['a_main_approve_rev'] = "1 kommentar venter p� godkendelse."; // 5.0
$LNG['a_main_approve_revs'] = "%s kommentarer venter p� godkendelse."; // 5.0
$LNG['a_main_your'] = "Din version"; // 5.0
$LNG['a_main_latest'] = "Seneste version"; // 5.0
$LNG['a_main_new'] = "<a href=\"http://www.aardvarkind.com/\">Aardvark Topsites PHP Website</a>"; // 5.0

// Admin > Manage Members
$LNG['a_man_header'] = "Rediger brugere"; // 5.0
$LNG['a_man_actions'] = "Handlinger"; // 4.2.0
$LNG['a_man_edit'] = "Rediger"; // 4.2.0
$LNG['a_man_delete'] = "Slet"; // 4.2.0
$LNG['a_man_email'] = "Email"; // 4.2.0
$LNG['a_man_all'] = "V�lg alle"; // 5.0
$LNG['a_man_none'] = "Frav�lg alle"; // 5.0
$LNG['a_man_del_sel'] = "Slet valgte"; // 5.0

// Admin > Manage Reviews // 5.0
$LNG['a_man_rev_header'] = "Rediger kommentarer"; // 5.0
$LNG['a_man_rev_enter'] = "For at redigere et sites kommentarer, indtast brugerens brugernavn nedenfor."; // 5.0
$LNG['a_man_rev_id'] = "ID"; // 5.0
$LNG['a_man_rev_rev'] = "Kommentar"; // 5.0
$LNG['a_man_rev_date'] = "Dato"; // 5.0

// Admin > Menu
$LNG['a_menu'] = "Menu";
$LNG['a_menu_main'] = "Hovedside"; // 5.0
$LNG['a_menu_approve'] = "Godkend nye brugere";
$LNG['a_menu_manage'] = "Rediger brugere"; // 4.2.0
$LNG['a_menu_settings'] = "Skift indstillinger"; // 5.0
$LNG['a_menu_skins'] = "Skins og kategorier"; // 5.0
$LNG['a_menu_approve_reviews'] = "Godkend nye kommentarer"; // 5.0
$LNG['a_menu_manage_reviews'] = "Rediger kommentarer"; // 5.0
$LNG['a_menu_email'] = "Email brugere";
$LNG['a_menu_delete_review'] = "Slet kommentar";
$LNG['a_menu_logout'] = "Log ud"; 
$LNG['a_menu_delete'] = "Slet bruger";
$LNG['a_menu_edit'] = "Rediger bruger";
$LNG['a_header_members'] = "Brugere"; // 5.0
$LNG['a_header_settings'] = "Indstillinger"; // 5.0
$LNG['a_header_reviews'] = "Kommentarer"; // 5.0

// Admin > Settings
$LNG['a_s_header'] = "Skift indstillinger";
$LNG['a_s_general'] = "Generelt";
$LNG['a_s_admin_password'] = "Admin kodeord";
$LNG['a_s_list_name'] = "Navnet p� din topsites liste"; 
$LNG['a_s_list_url'] = "URL til topsites-folderen";
$LNG['a_s_default_language'] = "Standard sprog";
$LNG['a_s_your_email'] = "Din emailadresse";

$LNG['a_s_sql'] = "SQL indstillinger";
$LNG['a_s_sql_type'] = "Database type"; // 4.1.0
$LNG['a_s_sql_host'] = "V�rt";
$LNG['a_s_sql_database'] = "Database";
$LNG['a_s_sql_username'] = "Brugernavn"; 
$LNG['a_s_sql_password'] = "Kodeord";

$LNG['a_s_ranking'] = "Bed�mmelses indstillinger";
$LNG['a_s_num_list'] = "Antal brugere der skal vises pr. side"; // 5.0
$LNG['a_s_ranking_period'] = "Bed�mmelsesperiode"; // 5.0
$LNG['a_s_ranking_method'] = "Bed�mmelsesmetode"; // 5.0
$LNG['a_s_ranking_average'] = "Rang efter gennemsnit eller efter %s"; // 5.0
$LNG['a_s_featured_member'] = 'Udvalgt bruger - Du skal tilf�je {$featured_member} til wrapper.html efter at du har sl�et det til.'; // 4.1.0
$LNG['a_s_top_skin_num'] = "Antal medlemmer som skal vises i den specielle top template (p� for eksempel din hovedside for at markedsf�re din topliste)"; 
$LNG['a_s_ad_breaks'] = "Vis en reklame efter disse bed�mmelser (adskil med komma)";

$LNG['a_s_member'] = "Bruger indstillinger";
$LNG['a_s_active_default'] = "Nye brugere skal godkendes f�r de kommer p� listen";
$LNG['a_s_active_default_review'] = "Nye kommentarer skal godkendes f�r de kommer p� listen"; 
$LNG['a_s_delete_after'] = "Slet ikke aktive brugere efter x antal dage (s�t til 0 for at sl� fra)"; // 4.1.0
$LNG['a_s_email_admin_on_join'] = "F� email n�r ny bruger tilmeldes";
$LNG['a_s_max_banner_width'] = "Brugernes max bredde p� banner (s�t til 0 for at sl� fra)"; // 4.2.0
$LNG['a_s_max_banner_height'] = "Brugernes max h�jde p� banner (s�t til 0 for at sl� fra)"; // 4.2.0
$LNG['a_s_default_banner'] = "Standard banner for medlemmer der ikke indtaster et banner";

$LNG['a_s_button'] = "Knap indstillinger";
$LNG['a_s_ranks_on_buttons'] = "Rang p� knapper -  Se <a href=\"http://www.aardvarkind.com/topsitesphp/manual/\">manualen</a> for yderligere.  V�lg kun Knap statistik efter at du har l�st i manualen.  Hvis du v�lger Knap statistik, vil indstillingerne i denne sektion ikke have nogen virkning."; // 4.2.0
$LNG['a_s_stat_buttons'] = "Knap statistik"; // 4.2.0
$LNG['a_s_button_url'] = "Hvis Ja/Nej - URL til knappen du vil vise p� medlemmernes sider"; // 4.0
$LNG['a_s_button_dir'] = "Hvis Ja - URL til folderen disse knapper er i"; // 4.0
$LNG['a_s_button_ext'] = "Hvis Ja - fil-endelse p� disse knapper (gif, png, jpg, etc.)"; // 4.0
$LNG['a_s_button_num'] = "Hvis Ja - Antal knapper du har lagret."; // 4.0

$LNG['a_s_other'] = "Andre indstillinger";
$LNG['a_s_search'] = "S�g";
$LNG['a_s_time_offset'] = "Tidsforskel for din server (i timer)";
$LNG['a_s_gateway'] = "Portalside for at forhindre snyd p� hits"; 
$LNG['a_s_captcha'] = "Sl� ord-verifikation til ved tilmelding - ekstra sikkerhed imod spammere"; // 4.2.2

$LNG['a_s_on'] = "Til";
$LNG['a_s_off'] = "Fra";
$LNG['a_s_days'] = "Dage";
$LNG['a_s_months'] = "M�neder";
$LNG['a_s_weeks'] = "Uger"; // 4.2.0
$LNG['a_s_yes'] = "Ja"; 
$LNG['a_s_no'] = "Nej";

$LNG['a_s_updated'] = "Dine indstillinger er �ndret.";

// Admin > Skins and Categories // 5.0
$LNG['a_skins_header'] = "Skins og kategorier"; // 5.0
$LNG['a_skins_default'] = "Standard skin"; // 5.0
$LNG['a_skins_set_default'] = "S�t standard skin"; // 5.0
$LNG['a_skins_anon'] = "Anonym"; // 5.0
$LNG['a_skins_default_done'] = "Standard skin er nu sat."; // 5.0
$LNG['a_skins_categories_done'] = "Kategori skins er nu sat."; // 5.0
$LNG['a_skins_new_category_done'] = "Ny kategori er nu oprettet."; // 5.0
$LNG['a_skins_delete_done'] = "Kategorien er blevet slettet."; // 5.0
$LNG['a_skins_edit_done'] = "Kategorien er blevet redigeret."; // 5.0
$LNG['a_skins_invalid_skin'] = "Ugyldigt skin: %s.  Pr�v venligst igen."; // 5.0
$LNG['a_skins_categories'] = "Kategorier"; // 5.0
$LNG['a_skins_new_category'] = "Opret ny kategori"; // 5.0
$LNG['a_skins_set_skins'] = "S�t kategori skins"; // 5.0
$LNG['a_skins_edit_category'] = "Rediger kategori"; // 5.0
$LNG['a_skins_category_name'] = "Kategorinavn"; // 5.0
$LNG['a_skins_diff_skins'] = "Hvis du vil have forskellige skins for forskellige kategorier, skift dem herunder."; // 5.0
?>
