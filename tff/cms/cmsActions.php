<?php

class cms
{
    public function doDefault($params = false)
    {
        $cat = $params['action'];
        $page = !empty($params['params'][0]) ? $params['params'][0] : 'index';
        $this->get_page($cat, $page);
    }

    public function get_page($cat, $page)
    {
        global $SQL, $template;
        $cat = _sanitize($cat, '');
        $page = _sanitize($page, '');
        $cat_id = $SQL->fetch("SELECT cat_id,category_description from tff_categories where handle='{$cat}'");
        if (!$cat_id) {
            Controller::pagenotfound_handler('Diese Seite wurde nicht gefunden');
        }
        $cat_title = $cat_id[0]['category_description'];
        // Noch sind wir nicht rausgeflogen.
        $query = "SELECT * from tff_cmspages where cat_id={$cat_id[0]['cat_id']} and handle='{$page}'";
        // Unterseiten auslesen
        $otherpages = $SQL->fetch("SELECT * from tff_cmspages where cat_id={$cat_id[0]['cat_id']} and visible=1 and handle!='index'");
        //var_dump($otherpages);exit();
        if ($otherpages) {
            $out['title'] = $cat_title;

            $x = 0;
            foreach ($otherpages as $row => $data) {
                $out['items'][$x]['url'] = WEB.'cms/'.urlencode($cat).'/'.$data['handle'];
                $out['items'][$x]['title'] = $data['title'];
                $out['items'][$x]['img'] = $data['headimg'];
                ++$x;
            }
            $template->assign('otherpages', $out);
        }
        $pagedata = $SQL->fetch($query);

        if ($pagedata) {
            if ($pagedata[0]['headimg']) {
                $template->assign('OGIMAGE', $pagedata[0]['headimg']);
            }

            $template->assign('page', $pagedata[0]);
        } else {
            Controller::pagenotfound_handler('Diese Seite wurde nicht gefunden');
        }
    }
}
