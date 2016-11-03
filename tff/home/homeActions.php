<?php

class home
{
    public $limit = 50;
    public $monate = array(1 => 'Januar', 2 => 'Februar', 3 => 'März', 4 => 'April',
        5 => 'Mai', 6 => 'Juni', 7 => 'Juli', 8 => 'August', 9 => 'September', 10 => 'Oktober',
        11 => 'November', 12 => 'Dezember', );
    public $cdn_active;

    public function __construct()
    {
        $this->cdn_active = false;
        return false;
    }

    public function doDefault()
    {
        global $SQL;
        global $template;
        $template->assign('PAGETITLE', PROJECT_TITLE);

        $home = $SQL->fetch("SELECT * from tff_cmspages where cat_id=0 and handle='index'");
        if ($home) {
            // Statische Startseite
            $template->assign('contents', $home[0]['contents']);
            $template->assign('PAGETITLE', $home[0]['title']);
            $template->assign('OGIMAGE', $home[0]['headimg']);
        }

        $desc = '';
        $additional = ' WHERE BL.vis=1 ';

        $sel = 'SELECT p_id, title, vis, contents, BL.headimg, AU.user_name, times, CA.handle category
      FROM '._BLOG.' AS BL
      JOIN '._AUTHOR.' AU on BL.author_id = AU.user_id
      JOIN '._RELS.' RE ON RE.blog_id = BL.p_id
      JOIN '._CATS.' CA ON RE.cat_id = CA.cat_id
      '.$additional.'
      GROUP BY BL.p_id
      ORDER BY times desc LIMIT 28';
        $posts = $SQL->fetch($sel);
        foreach ($posts as $row => $val) {
            $out[$row] = $val;
            $out[$row]['w'] = 200;
            $out[$row]['h'] = 100;
            $desc .= $val['title'].' ';
            $out[$row]['contents_long'] = $this->clear($val['contents'], 1000);
            $out[$row]['contents'] = $this->clear($val['contents'], 320);
        }
        $template->assign('posts', $out);
        $template->assign('DESCRIPTION', $home[0]['description']);
        $template->assign('KEYWORDS', $home[0]['keywords']);
    }

    public function clear($string, $length = 210)
    {
        $tmp = strip_tags($string);
        $out = substr($tmp, 0, $length);

        return $out;
    }

    public function doPreview($params)
    {
        global $SQL;
        $id = _sanitize($params[0], 0);
        if ($id) {
            $tmp = $SQL->fetch("SELECT * from tff_blog_posts where p_id={$id} limit 1");
            echo json_encode($tmp[0]['contents']);
            exit();
        } else {
            exit();
        }
    }
}
