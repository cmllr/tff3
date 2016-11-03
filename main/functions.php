<?php

if (!defined('DROOT')) {
    exit('hu?');
}

function clear($string)
{
    $out = strip_tags($string);
    $ret = substr($out, 0, 100).'...';

    return $ret;
}

// Handle USER Input / forced = pflichtfeld
function _request($content, $type = false, $forced = false)
{
    global $SQL;
    $type = gettype($type);
    if (!isset($_REQUEST[$content])) {
        // Variable existiert nicht, also ist sie FALSCH!
        if ($type == 'string') {
            return false;
        } else {
            return 0;
        }
    }
    if ($forced and empty($_REQUEST[$content])) {
        // Feld ist leer
        return false;
    }

    // Handle and Escape Requestvars
    switch ($type) {
        case 'integer': {
            // Auf Integer überprüfen
            $ret = (int) $_REQUEST[$content];

            return (int) $ret;
            break;
        }
        case 'double': {
            // Auf FLOAT überprüfen
            $ret = (float) $_REQUEST[$content];

            return (float) $ret;
            break;
        }
        case 'string': {
            // User hat nen String übergeben
            // User müssen kein HTML übergeben, echt nicht (Javascript sowieso nicht)
            $ret = strip_tags($_REQUEST[$content]);
            // Evtl. Slashes escapen - hilft gegen Injections
            $ret = $SQL->escape($ret);
            $ret = trim($ret);
            // Steht nun überhaupt noch was drin? - Falls nö, kick it.
            $ret = strlen($ret) == 0 ? false : $ret;

            return (string) $ret;
            break;
        }
        default: {
            break;
        }
    }

    return false;
}

function _mailchecker($string)
{
    if (strpos($string, '@') and strpos($string, '.')) {
        return true;
    }

    return false;
}

function _sanitize($var, $type)
{
    $_REQUEST['params'] = $var;

    return _request('params', $type);
}

function _medialister()
{
    global $SQL, $template;
    $albums = $SQL->fetch('SELECT * FROM '.DB.'albums');
    foreach ($albums as $r => $v) {
        $albums[$r]['url'] = urlencode($v['alb_title']);
    }

    return $albums;
}

function footer_quickload()
{
    global $template;
    global $SQL;
    // Statischen Footer laden
    $cat = $SQL->fetch('SELECT cat_id from tff_blog_categories where handle="qload"');
    // Posts rausholen
    if (!$cat) {
        return false;
    }
    $qq = "SELECT blog_id from tff_blog_relations where cat_id={$cat[0]['cat_id']}";
    $tmp = $SQL->fetch($qq);
    $find = '';
    foreach ($tmp as $r => $v) {
        $find .= "{$v['blog_id']},";
    }
    if ($find == '') {
        return true;
    }
    $find = substr($find, 0, -1);
    $qqq = "SELECT * from tff_blog_posts where p_id in ($find) and vis=0 order by times desc";
    $out = $SQL->fetch($qqq);

    // Navigationstagcloud laden
    $tt = $SQL->fetch('SELECT cat_id,count(blog_id) anz from tff_blog_relations  group by cat_id order by anz desc limit 20 ');
    $in = '';
    foreach ($tt as $r => $v) {
        $in .= "{$v['cat_id']},";
    }
    $in = substr($in, 0, -1);
    $findcats = 'SELECT handle from tff_blog_categories where handle!="qload" and cat_id in ('.$in.') order by handle';
//    echo $findcats;
    $cats = $SQL->fetch($findcats);
    $template->assign('blcats', $cats);
    $template->assign('quickload', $out);
}

function get_startpage()
{
    global $SQL;
    $sel = 'SELECT  from_unixtime(times) datum,month(from_unixtime(times)) monat,p_id, title,contents,headimg, vis, AU.user_name, times,  CA.handle category
            FROM tff_blog_posts AS BL
            JOIN tff_users AU on BL.author_id = AU.user_id
            JOIN tff_blog_relations RE ON RE.blog_id = BL.p_id
            JOIN tff_blog_categories CA ON RE.cat_id = CA.cat_id
            where vis = 1
            and headimg is not null
            GROUP BY RE.blog_id
            ORDER BY times desc
            LIMIT 0,4';
    $tmp = $SQL->fetch($sel);
    $x = 0;
    foreach ($tmp as $row => $data) {
        $out2[$x] = $data;

        $out2[$x]['contents'] = subclear($data['contents'], 300);
        $out2[$x]['contentsf'] = $data['contents'];
        $out2[$x]['titleurl'] = urlencode($data['title']);
        $out2[$x]['categoryurl'] = urlencode($data['category']);
        $out2[$x]['headimg'] = $data['headimg'];
        $out2[$x]['datum'] = $data['datum'];
        ++$x;
    }

    return $out2;
}

function subclear($string, $length = 210)
{
    $tmp = strip_tags($string);
    $out = substr($tmp, 0, $length);

    return $out;
}

function dirToArray($dir)
{
    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
        if (!in_array($value, array('.', '..'))) {
            if (is_dir($dir.DIRECTORY_SEPARATOR.$value)) {
                $result[$value] = dirToArray($dir.DIRECTORY_SEPARATOR.$value);
            } else {
                $result[] = $value;
            }
        }
    }

    return $result;
}

function fake_ticker()
{
    global $SQL;
    $out[]['contents'] = 'Testposting';
    $out[]['contents'] = 'Testposting2';
    $out[]['contents'] = 'Testposting3';
    $out[]['contents'] = 'Testposting4';
    $out[]['contents'] = 'Testposting5';
    $out[]['contents'] = 'Testposting6';

    return $out;
}

function purge_cache()
{
    $p = DROOT.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR;
    $cachedir = DROOT.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.'*';
    $files = glob($cachedir);
    $now = time();
    if (!file_exists($p.'.purge') or filemtime($p.'.purge') <= time() - 3600) {
        if ($files) {
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    unlink($file); // delete file
                }
            }
            $fp = fopen($p .= '.purge', 'w+');
            fputs($fp, '');
            fclose($fp);
        }
    }
}
