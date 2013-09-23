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

$translation = 'Polish';
$translator_name = 'Dawid Surmik';
$translator_email = 'dawid@surmik.int.pl';
$translator_url = 'http://www.surmik.int.pl/';

//===========================================================================\\
//====                    Rozwijaj swoj� stron� www                      ====\\
//====                w w w . s u r m i k . i n t . p l                  ====\\
//===========================================================================\\



// Global
$LNG['g_form_submit_short'] = "Wy�lij";
$LNG['g_username'] = "Nazwa u�ytkownika";
$LNG['g_url'] = "URL";
$LNG['g_title'] = "Tytu�";
$LNG['g_description'] = "Opis";
$LNG['g_category'] = "Kategoria"; // 4.1.0
$LNG['g_email'] = "Email";
$LNG['g_banner_url'] = "Banner URL";
$LNG['g_password'] = "Has�o";
$LNG['g_average'] = "Przeci�tnie";
$LNG['g_today'] = "Dzi�";
$LNG['g_yesterday'] = "Wczoraj";
$LNG['g_daily'] = "Dziennie"; // 5.0
$LNG['g_this_month'] = "W tym miesi�cu"; // 5.0
$LNG['g_last_month'] = "W ostatnim miesi�cu"; // 5.0
$LNG['g_monthly'] = "Miesi�cznie"; // 5.0
$LNG['g_this_week'] = "W tym tygodniu"; // 5.0
$LNG['g_last_week'] = "Tydzie� temu"; // 5.0
$LNG['g_weekly'] = "Tygodniowo"; // 5.0
$LNG['g_pv'] = 'Klinkni�cia'; // 5.0
$LNG['g_overall'] = 'Overall'; // 5.0
$LNG['g_in'] = 'Wej�cia'; // 5.0
$LNG['g_out'] = 'Wyj�cia'; // 5.0
$LNG['g_unq_pv'] = "Unikalne klikni�cia"; // 5.0
$LNG['g_tot_pv'] = "Wszystkie klikni�cia"; // 5.0
$LNG['g_unq_in'] = "Unikalne klikni�cia w czasie"; // 5.0
$LNG['g_tot_in'] = "Wszystkie klikni�cia w czasie"; // 5.0
$LNG['g_unq_out'] = "Unikalne wyj�cia"; // 5.0
$LNG['g_tot_out'] = "Wszystkie wyj�cia"; // 5.0
$LNG['g_invalid_u_or_p'] = "Nieprawid�owa nazwa u�ytkownika lub has�o.  Spr�buj ponownie."; // 5.0
$LNG['g_invalid_u'] = "Nieprawid�owa nazwa u�ytkownika.  Spr�buj ponownie."; // 5.0
$LNG['g_invalid_p'] = "Nieprawid�owe has�o.  Spr�buj ponownie."; // 5.0
$LNG['g_session_expired'] = "Sesja wygas�a.  Spr�buj ponownie."; // 5.0
$LNG['g_error'] = "B��d"; // 5.0
$LNG['g_delete_install'] = "Z powodu bezpiecze�stwa powiniene� usun�� katalog nstall przed uruchomieniem skryptu."; // 5.0

// Edit Account
$LNG['edit_header'] = "Edycja konta.";
$LNG['edit_info_edited'] = "Edycja Twojego konta zosta�o zako�czone sukcesem";
$LNG['edit_password_blank'] = "Zostaw pole puste je�li chcesz zachowa� obecne has�o."; // 4.0

// Gateway Page
$LNG['gateway_header'] = "Topsites Gateway Page";
$LNG['gateway_text'] = "Z powodi cheatowania, strona w Gateway zosta�a zawieszona.  Kliknij poni�szy link, by przej�� do strony z Toplist�.";
$LNG['gateway_vote'] = "Wejd� i zag�osuj.";
$LNG['gateway_no_vote'] = "Wejd� bez g�osowania."; // 5.0

// Install
$LNG['install_header'] = "Instaluj";
$LNG['install_welcome'] = "Witaj w Aardvark Topsites PHP 5.  Wype�nij poni�esz pola, aby zainstalowa� skrypt.";
$LNG['install_sql_prefix'] = "Prefix tabeli - only change this if you are running more than one list from the same database";
$LNG['install_error_chmod'] = "Nie mo�na zapisa� zmian w settings_sql.php.  Upewnij si�, �e plik settings_sql.php posiada CHMOD 666.";
$LNG['install_error_sql'] = "Nie mo�na po��czy� z baz� SQL-a.  Wr��, aby ponownie sprawdzi� ustawienia SQL..";
$LNG['install_done'] = "Tw�j ranking zosta� zainstalowany.  Mo�esz usun�� teraz ten katalog z serwera.";
$LNG['install_your'] = "Your Topsites List";
$LNG['install_admin'] = "Administracja";
$LNG['install_manual'] = "R�czne";
$LNG['upgrade_header'] = "Aktualizacja";
$LNG['upgrade_welcome'] = "Witaj w Aardvark Topsites PHP 5.  Przed wykonaniem aktualizacji pami�tam o zachowaniu danych.";
$LNG['upgrade_error_version'] = "Upgrading is only supported for Aardvark Topsites PHP 4.1.0 or higher.";
$LNG['upgrade_done'] = "Tw�j skrypt zosta� w�a�nie zaktualizowany.  Mo�esz usun�� teraz ten katalog z serwera.";

// Join
$LNG['join_header'] = "Do��cz";
$LNG['join_enter_text'] = "Prosz� wpisa� tekst z poni�szego obrazka:"; // 4.2.2
$LNG['join_user'] = "U�ytkownik"; // 5.0
$LNG['join_website'] = "Strona internetowa"; // 5.0
$LNG['join_error_forgot'] = "Zapomnia�e�:";
$LNG['join_error_username'] = "Nazwa u�ytkownika: nazwa powinna zawiera� tylko litery i cyfry."; // 5.0
$LNG['join_error_username_duplicate'] = "B��dna nazwa u�ytkownika: nazwa, kt�r� poda�e� jest ju� u�ywana."; // 5.0
$LNG['join_error_url'] = "Wprowad� poprawny URL.";
$LNG['join_error_email'] = "Wpisz poprawny adres e-mail.";
$LNG['join_error_title'] = "Wpisz tytu� swojej strony.";
$LNG['join_error_password'] = "Wprowad� has�o.";
$LNG['join_error_urlbanner'] = "Podaj poprawny adres bannera.  Pozostaw to miejsce puste, je�li takowego nie masz.  Musi by� mniejszy ni�"; // 4.0
$LNG['join_error_back'] = "Wr�� i popraw b��dy.";
$LNG['join_error_time'] = "Prosz� nie od�wie�a� strony z potwierdzeniem do��czenia."; // 4.2.0
$LNG['join_error_captcha'] = "S�owo, kt�re wprowadzi�e�, nie pasuje do pokazanego na grafice."; // 4.2.2
$LNG['join_thanks'] = "Dzi�kujemy!  Wpisz ten kod na swojej stronie, by mo�na by�o na ni� g�osowa�.";
$LNG['join_changewarning'] = "Je�li zmienisz kod, mo�e nie dzia�a�.";
$LNG['join_welcome'] = "Witamy na %s";
$LNG['join_welcome_admin'] = "Nowy Cz�onek do��czy� do Twojego Rankingu";

// Link Code
$LNG['link_code_header'] = "Link Code"; // 5.0

// Lost Password
$LNG['lost_pw_header'] = "Zgubione has�o"; // 5.0
$LNG['lost_pw_forgot'] = "Zapomnia�e� has�a?"; // 5.0
$LNG['lost_pw_get'] = "Odzyskaj hass�o"; // 5.0
$LNG['lost_pw_emailed'] = "Instrukcje dotycz�ce resetowania has�a zosta�y wys�ane e-mailem.";
$LNG['lost_pw_email'] = "By wybra� nowe has�o dla swojej strony, udaj si� pod poni�szy adres:"; // 5.0
$LNG['lost_pw_new'] = "Wprowad� nowe has�o"; // 5.0
$LNG['lost_pw_set_new'] = "Pobierz nowe has�o"; // 5.0
$LNG['lost_pw_finish'] = "Nowe has�o jakie wprowadzi�e� zosta�o ju� zapisane w bazie danych."; // 5.0

// Main Page
$LNG['main_header'] = "Rankingi - Strona g��wna"; // 5.0
$LNG['main_all'] = "Wszystkie strony"; // 4.2.0
$LNG['main_method'] = "Metoda rankingu";
$LNG['main_members'] = "Cz�onkowie";
$LNG['main_menu_rankings'] = "Rankingi";
$LNG['main_menu_join'] = "Do��cz";
$LNG['main_menu_random'] = "Losowy U�ytkownik";
$LNG['main_menu_search'] = "Szukaj";
$LNG['main_menu_lost_code'] = "Utracony kod"; // 5.0
$LNG['main_menu_lost_password'] = "Utracone has�o"; // 5.0
$LNG['main_menu_edit'] = "Edycja informacji o U�ytkowniku";
$LNG['main_menu_user_cp'] = "Panel kontrolny U�ytkownika"; // 5.0
$LNG['main_featured'] = "Cz�onek"; // 4.0.2
$LNG['main_executiontime'] = "Czas wykonania skryptu"; // 4.0
$LNG['main_queries'] = "Polecenia SQL"; // 4.0
$LNG['main_powered'] = "Powered by";

// Ranking Table
$LNG['table_stats'] = "Statystyki";
$LNG['table_unique'] = "Unikalne";
$LNG['table_total'] = "Wszystki";
$LNG['table_rank'] = "Ranga";
$LNG['table_title'] = "Tytu�"; // 4.0
$LNG['table_description'] = "Opis"; // 4.0
$LNG['table_movement'] = "Zmiana pozycji";
$LNG['table_up'] = "W g�r�"; // 5.0
$LNG['table_down'] = "w d�"; // 5.0
$LNG['table_neutral'] = "Bez zmian"; // 5.0

// Rate and Review
$LNG['rate_header'] = "Wpis i oce�";
$LNG['rate_rating'] = "Ocena";
$LNG['rate_review'] = "Ocena - bez przyzwolenia HTML"; // 5.0
$LNG['rate_thanks'] = "Dzi�kuj� za ocen�.";
$LNG['rate_error'] = "Ju� ocenia�e� t� stron�.";
$LNG['rate_back'] = "Powr�t do statystyk";

// Search
$LNG['search_header'] = "Wyszukaj";
$LNG['search_off'] = "Cecha, kt�rej wyszukujesz jest niedost�pna.";
$LNG['search_for'] = "Szuka�e�";
$LNG['search_no_sites'] = "Niestety, nie znaleziono stron spe�niaj�cych podane kryteria."; // 5.0
$LNG['search_prev'] = "Poprzednie"; // 3.2.1
$LNG['search_next'] = "Nast�pne"; // 3.2.1

// Stats
$LNG['stats_header'] = "Statystyki";
$LNG['stats_info'] = "Informacja";
$LNG['stats_member_since'] = "Cz�onek od"; // 5.0
$LNG['stats_rating_avg'] = "�rednia ocena";
$LNG['stats_rating_num'] = "Liczba ocen";
$LNG['stats_rate'] = "Oce� i opisz t� stron�";
$LNG['stats_reviews'] = "Opisy";
$LNG['stats_allreviews'] = "Poka� wszystkie opisy"; // 4.0
$LNG['stats_week'] = "W tygodniu"; // 5.0
$LNG['stats_highest'] = "Najwi�cej"; // 5.0

// ssi.php
$LNG['ssi_top'] = "Najlepszych %s stron"; // 4.0
$LNG['ssi_new'] = "%s nowych Cz�onk�w"; // 5.0
$LNG['ssi_all'] = "Wszystkie strony rankingu"; // 4.0

// User Control Panel // 5.0
$LNG['user_cp_header'] = "Panel kontrolny U�ytkownika"; // 5.0
$LNG['user_cp_login'] = "Loguj"; // 5.0
$LNG['user_cp_logout'] = "Wyloguj"; // 5.0
$LNG['user_cp_welcome'] = "Witaj w panelu kontrolnym u�ytkownika.  U�yj poni�szych odsy�aczy do zarz�dzania Twoim kontem."; // 5.0
$LNG['user_cp_logout_message'] = "Obecnie wylogowa�e� si� z Panelu kontrolnego."; // 5.0

// Admin > Approve New Members // 4.0
$LNG['a_approve_header'] = "Zatwierd� nowych U�ytkownik�w"; // 5.0
$LNG['a_approve'] = "Zatwierdzam"; // 4.0
$LNG['a_approve_none'] = "Nie ma U�ytkownik�w czekaj�cych na zatwierdzenie Administratora."; // 4.0
$LNG['a_approve_done'] = "U�ytkownik zosta� zatwierdzony."; // 4.0
$LNG['a_approve_dones'] = "U�ytkownicy zostali zatwierdzeni."; // 4.0
$LNG['a_approve_sel'] = "Z zaznaczonymi:"; // 5.0

// Admin > Approve New Reviews // 5.0
$LNG['a_approve_rev_header'] = "Zatwierd� nowe recenzje"; // 5.0
$LNG['a_approve_rev_none'] = "Nie ma nowych recenzji czekaj�cych na zatwierdzenie."; // 5.0
$LNG['a_approve_rev_done'] = "Recenzja zosta�a zatwierdzona."; // 5.0
$LNG['a_approve_rev_dones'] = "Recenzja zosta�y zatwierdzone."; // 5.0

// Admin > Delete Member
$LNG['a_del_header'] = "Usu� wybranego u�ytkownika"; // 5.0
$LNG['a_del_headers'] = "Usu� wybranych u�ytkownik�w"; // 5.0
$LNG['a_del_done'] = "Wybrany u�ytkownik zosta� usuni�ty."; // 5.0
$LNG['a_del_dones'] = "Wybrani u�ytkownicy zostali usuni�ci."; // 5.0
$LNG['a_del_warn'] = "Czy jeste� pewien, �e chcesz usun�� %s?"; // 5.0
$LNG['a_del_multi'] = "tych %s u�ytkownik�w"; //5.0

// Admin > Delete Review // 5.0
$LNG['a_del_rev_header'] = "Usu� wybran� recenzj�"; // 5.0
$LNG['a_del_rev_headers'] = "Usu� wybrane recenzje"; // 5.0
$LNG['a_del_rev_done'] = "Wybrana recenzja zosta�a usuni�ta."; // 5.0
$LNG['a_del_rev_dones'] = "Wybrane recenzje zosta�y usuni�te."; // 5.0
$LNG['a_del_rev_warn'] = "Czy napewno chcesz usun�� wybran� recenzj�?"; //5.0
$LNG['a_del_rev_warns'] = "Czy napewno chcesz usun�� wybrane recenzje?"; //5.0
$LNG['a_del_rev_invalid_id'] = "B��dy ID recenzji.  Spr�buj ponownie."; // 5.0

// Admin > Edit Member
$LNG['a_edit_header'] = "Edytuj u�ytkownika"; // 5.0
$LNG['a_edit_site_is'] = "Ta strona jest"; // 4.0
$LNG['a_edit_active'] = "Aktywna (Listowana)"; // 4.0
$LNG['a_edit_inactive'] = "Nieaktywna (Nielistowana)"; // 5.0
$LNG['a_edit_edited'] = "U�ytkownik zosta� wyedytowany.";

// Admin > Edit Review // 5.0
$LNG['a_edit_rev_header'] = "Edytuj recenzj�"; // 5.0
$LNG['a_edit_rev_edited'] = "Recenzja zosta�a wyedytowana.";

// Admin > Email Members
$LNG['a_email_header'] = "Wy�lij Email do u�ytkownik�w"; // 5.0
$LNG['a_email_subject'] = "Temat"; // 4.2.0
$LNG['a_email_message'] = "Tre��"; // 4.2.0
$LNG['a_email_msg_sent'] = "Email zosta� wys�any do %s"; // 5.0
$LNG['a_email_not_sent'] = "Email nie m�g� zosta� wys�any do %s"; // 5.0
$LNG['a_email_sent'] = "%s u�ytkownik�w odebra�o wiadomo��."; // 4.2.0
$LNG['a_email_failed'] = "%s u�ytkownik�w nie odebra�o wiadomo�ci."; // 4.2.0

// Admin > Logout
$LNG['a_logout_message'] = "W tej chwili zosta�e� wylogowany z poziomu Administratora."; // 5.0

// Admin > Main
$LNG['a_header'] = "Administracja"; // 5.0
$LNG['a_main'] = "Witaj w Panelu Administatora.  U�yj poni�szych odsy�aczy do zarz�dzania rankingami."; // 5.0
$LNG['a_main_approve'] = "Jedna strona czeka na Twoje zatwierdzenie."; // 5.0
$LNG['a_main_approves'] = "%s stron czeka na Twoje zatwierdzenie."; // 5.0
$LNG['a_main_approve_rev'] = "Jedna recenzja czeka na Twoje zatwierdzenie."; // 5.0
$LNG['a_main_approve_revs'] = "%s recenzji czeka na Twoje zatwierdzenie."; // 5.0
$LNG['a_main_your'] = "Twoja wersja"; // 5.0
$LNG['a_main_latest'] = "Ostatnia wersja"; // 5.0
$LNG['a_main_new'] = "<a href=\"http://www.aardvarkind.com/\">Aardvark Topsites PHP Website</a>"; // 5.0

// Admin > Manage Members
$LNG['a_man_header'] = "Zarz�dzaj u�ytkownikami"; // 5.0
$LNG['a_man_actions'] = "Akcje"; // 4.2.0
$LNG['a_man_edit'] = "Edytuj"; // 4.2.0
$LNG['a_man_delete'] = "Usu�"; // 4.2.0
$LNG['a_man_email'] = "Wy�lij email"; // 4.2.0
$LNG['a_man_all'] = "Zaznacz wszystkich"; // 5.0
$LNG['a_man_none'] = "Odznacz wszystkich"; // 5.0
$LNG['a_man_del_sel'] = "Usu� zaznaczonych"; // 5.0

// Admin > Manage Reviews // 5.0
$LNG['a_man_rev_header'] = "Zarz�dzaj recenzjami"; // 5.0
$LNG['a_man_rev_enter'] = "Do zarz�dzania recenzjami stron wprowad� nazw� u�ytkownika poni�ej."; // 5.0
$LNG['a_man_rev_id'] = "ID"; // 5.0
$LNG['a_man_rev_rev'] = "Recenzja"; // 5.0
$LNG['a_man_rev_date'] = "Data"; // 5.0

// Admin > Menu
$LNG['a_menu'] = "Menu";
$LNG['a_menu_main'] = "Strona g��wna"; // 5.0
$LNG['a_menu_approve'] = "Zatwierd� nowego u�ytkownika";
$LNG['a_menu_manage'] = "Zarz�dzaj cz�onkami"; // 4.2.0
$LNG['a_menu_settings'] = "Zmie� ustawienia"; // 5.0
$LNG['a_menu_skins'] = "Skiny i kategorie"; // 5.0
$LNG['a_menu_approve_reviews'] = "Zatwierd� nowe recenzje"; // 5.0
$LNG['a_menu_manage_reviews'] = "Zarz�dzanie recenzjami"; // 5.0
$LNG['a_menu_email'] = "Email do cz�onk�w";
$LNG['a_menu_delete_review'] = "Usu� recenzje";
$LNG['a_menu_logout'] = "Wyloguj";
$LNG['a_menu_delete'] = "Usu� cz�onka";
$LNG['a_menu_edit'] = "Edytuj cz�onka";
$LNG['a_header_members'] = "Cz�onkowie"; // 5.0
$LNG['a_header_settings'] = "Ustawienia"; // 5.0
$LNG['a_header_reviews'] = "Recenzje"; // 5.0

// Admin > Settings
$LNG['a_s_header'] = "Zmiana ustawie�";
$LNG['a_s_general'] = "G��wne ustawienia";
$LNG['a_s_admin_password'] = "Has�o Administratora";
$LNG['a_s_list_name'] = "Nazwa Twojego rankingu";
$LNG['a_s_list_url'] = "URL do Twojego rankingu";
$LNG['a_s_default_language'] = "Domy�lny j�zyk";
$LNG['a_s_your_email'] = "Tw�j adres email";

$LNG['a_s_sql'] = "Ustawienia SQL";
$LNG['a_s_sql_type'] = "Typ bazy danych"; // 4.1.0
$LNG['a_s_sql_host'] = "Host";
$LNG['a_s_sql_database'] = "Baza danych";
$LNG['a_s_sql_username'] = "U�ytkownik";
$LNG['a_s_sql_password'] = "Has�o";

$LNG['a_s_ranking'] = "Ustawienia rankingu";
$LNG['a_s_num_list'] = "Ilo�� u�ytkownik�w na stron�"; // 5.0
$LNG['a_s_ranking_period'] = "Czas rankingu"; // 5.0
$LNG['a_s_ranking_method'] = "Metoda rankingu"; // 5.0
$LNG['a_s_ranking_average'] = "Ustaw jako przeci�tny lub jako %s"; // 5.0
$LNG['a_s_featured_member'] = 'Konkretny u�ytkownik - Musisz doda� {$featured_member} do wrapper.html po uaktywnieniu tego.'; // 4.1.0
$LNG['a_s_top_skin_num'] = "Liczba cz�onk�w, do kt�rych odnosi si� sk�rka _top";
$LNG['a_s_ad_breaks'] = "Poka� przerw� po tych rangach (oddzielone przecinkami)";

$LNG['a_s_member'] = "Ustawienia cz�onk�w";
$LNG['a_s_active_default'] = "Wymaga zaakceptowania przez Ciebie nowych cz�onk�w nim trafi� na list�";
$LNG['a_s_active_default_review'] = "Wymaga zaakceptowania przez Ciebie nowych recenzji zanim zostan� wylistowane";
$LNG['a_s_delete_after'] = "Usu� nieaktywnych cz�onk�w po tylu dniach (ustaw 0, aby wy��czyc)"; // 4.1.0
$LNG['a_s_email_admin_on_join'] = "Wy�lij do mnie wiadomo��, gdy kto� do��czy";
$LNG['a_s_max_banner_width'] = "Maksymalna szeroko�� bannera cz�onka (ustaw 0 by wy��czy� ograniczenie)"; // 4.2.0
$LNG['a_s_max_banner_height'] = "Maksymalna wysoko�� bannera cz�onka (ustaw 0 by wy��czy� ograniczenie)"; // 4.2.0
$LNG['a_s_default_banner'] = "Domy�lny banner, kt�ry b�dzie wy�wietlany, gdy cz�onek nie posiada swojego";

$LNG['a_s_button'] = "Ustawienia przycisk�w";

$LNG['a_s_ranks_on_buttons'] = "Czy ranga cz�onka ma by� wy�wietlana na jego przycisku?  Zobacz <a href=\"http://www.aardvarkind.com/topsitesphp/manual/\" target=\"_blank\">podr�cznik</a> dla szczeg��w.  Wybierz Buttony Statystyk tylko, je�li czyta�e� ju� ten fragment podr�cznika.  Je�li wybierzesz Buttony Statystyk, reszta tej sekcji nie przyniesie efekt�w."; // 4.2.0
$LNG['a_s_stat_buttons'] = "Przyciski statystyk"; // 4.2.0
$LNG['a_s_button_url'] = "<b>Je�li nie</b> - URL do buttona, kt�ry b�dzie si� pojawia� na stronie cz�onka"; // 4.0
$LNG['a_s_button_dir'] = "<b>Je�li tak</b> - URL do katalogu z buttonami (przyciskami)"; // 4.0
$LNG['a_s_button_ext'] = "<b>Je�li tak</b> - Rozszerzenie buttonu (gif, png, jpg, etc.)"; // 4.0
$LNG['a_s_button_num'] = "<b>Je�li tak</b> - Liczba button�w, kt�re zrobi�e� - im wy�sza liczba, tym wi�cej zasob�w b�dzie u�ywa� skrypt"; // 4.0

$LNG['a_s_other'] = "Inne ustawienia";
$LNG['a_s_search'] = "Wyszukaj";
$LNG['a_s_time_offset'] = "Offset czasu z Twojego serwera (w godzinach)";
$LNG['a_s_gateway'] = "Strona Gateway by anulowa� klikni�cia strony cheater�w";
$LNG['a_s_captcha'] = "Aktywuj s�own� weryfikacj� przyst�pienia - dodatkowa ochrona przeciwko spammerom"; // 4.2.2

$LNG['a_s_on'] = "W��czone";
$LNG['a_s_off'] = "Wy��czone";
$LNG['a_s_days'] = "Dni";
$LNG['a_s_months'] = "Miesi�cy";
$LNG['a_s_weeks'] = "Tygodni"; // 4.2.0
$LNG['a_s_yes'] = "Tak";
$LNG['a_s_no'] = "Nie";

$LNG['a_s_updated'] = "Twoja ustawienia zosta�y zaktualizowane.";

// Admin > Skins and Categories // 5.0
$LNG['a_skins_header'] = "Skiny i kategorie"; // 5.0
$LNG['a_skins_default'] = "Domy�lny skin (sk�rk�)"; // 5.0
$LNG['a_skins_set_default'] = "Ustaw domy�lny skin"; // 5.0
$LNG['a_skins_anon'] = "Anonimowy"; // 5.0
$LNG['a_skins_default_done'] = "Domy�lny skin zosta� ustawiony."; // 5.0
$LNG['a_skins_categories_done'] = "Skiny kategorii zosta� ustawiony."; // 5.0
$LNG['a_skins_new_category_done'] = "Nowa kategoria zosta�a utworzona."; // 5.0
$LNG['a_skins_delete_done'] = "Kategoria zosta�a usuni�ta."; // 5.0
$LNG['a_skins_edit_done'] = "Wybrana kategoria zosta�a wyedytowana."; // 5.0
$LNG['a_skins_invalid_skin'] = "Nieprawid�owy skin: %s.  Spr�buj ponownie."; // 5.0
$LNG['a_skins_categories'] = "Kategorie"; // 5.0
$LNG['a_skins_new_category'] = "Utw�r now� kategori�"; // 5.0
$LNG['a_skins_set_skins'] = "Ustaw skiny kategorii"; // 5.0
$LNG['a_skins_edit_category'] = "Edytuj kategori�"; // 5.0
$LNG['a_skins_category_name'] = "Nazwa kategorii"; // 5.0
$LNG['a_skins_diff_skins'] = "Je�li chcesz ustawi� innym skin do innej kategorii, wybierz go poni�ej."; // 5.0
?>
