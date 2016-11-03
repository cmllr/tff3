<?php

if (!defined('DROOT')) {
    exit('hu?');
}

require_once INCL.'/constants.php';
require_once INCL.'/functions.php';
require_once INCL.'/mysql.php';
require_once INCL.'/user.php';
require_once INCL.'/view.php';
require_once INCL.'/controller.php';
$template = new View();
session_start();
$SQL = new DCMS_DB();
$SQL->connect($tmm['database']['server'], $tmm['database']['user'], $tmm['database']['pw']) or die('Datenbank nicht erreichbar');
$SQL->changedb($tmm['database']['database']);
$SQL->cachetime = 1;
$tmplast = $SQL->fetch('SELECT times FROM tff_blog_posts ORDER BY times DESC LIMIT 1');
if ($tmplast) {
    $last_update = date('d.m.Y', $tmplast[0]['times']);
    $template->assign('LASTUPDATE', $last_update);
}
$template->assign('PAGEROOT', WEB);
$template->assign('TPL_FRONT', TPL_FRONT);
$template->assign('SID', '?'.SID);
$template->assign('sessionname', session_name());
$template->assign('sessionid', session_id());
$template->assign('I_AM_AT', Controller::returnPath());
$template->assign('MY_LOCATION', Controller::returnPath());
$template->assign('MP3_ROOT', MP3ROOT);
$template->assign('USER', $USER);
$template->assign('ADDONS', $tmm['addons']);
$template->assign('EDITABLE', $USER->get_level() == 1 ? true : false);
footer_quickload();
