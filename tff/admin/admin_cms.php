<?php

/**
 * Seiten bearbeiten. CMS-Teil vom TFF-Framework. Alles nicht so doll aber
 * es funktioniert, und das ist die Hauptsache.
 *
 * @author: Marcel Schindler <info@trancefish.de>
 */
class admincms
{
    private $categories;
    private $pages;

    public function __construct()
    {
        global $SQL;
        $out = array();
        $categories = $SQL->fetch('select * from tff_categories order by handle');
        $this->categories [0] = array(
            'handle' => '',
        );
        foreach ($categories as $row => $value) {
            $this->categories [$value ['cat_id']] = $value;
        }
        // Seitentitel
        $seiten = $SQL->fetch('SELECT p_id,handle, title, cat_id,visible,headimg from tff_cmspages');
        foreach ($seiten as $row => $value) {
            $cat = $value ['cat_id'];
            $pid = $value ['p_id'];
            $out [$cat] ['category'] = $this->categories [$cat];
            $out [$cat] ['inhalt'] [$pid] = $value;
        }
        $this->cleanup($out);
        $this->pages = $out;
    }

    private function cleanup($list)
    {
        global $SQL;
        $in = false;
        foreach ($this->categories as $id => $val) {
            if (!isset($list [$id])) {
                $in .= $id.',';
            }
        }
        if ($in) {
            $in = substr($in, 0, -1);
            $SQL->query("DELETE from tff_categories where cat_id in ($in)");
        }
    }

    public function list_pages()
    {
        global $template;
        $template->assign('pagelist', $this->pages);
    }

    public function doCMS($params)
    {
        global $template;
        $template->assign('cms', 1);
        switch ($params [0]) {
            case 'category':
                $this->category($params);
                break;
            case 'page':
                $this->page($params);
                break;
            default:
                $this->list_pages();
                break;
        }
    }

    public function page($params)
    {
        global $template, $SQL;

        switch ($params [1]) {
            case 'visible':
                $id = $params[2];
                $tmp = $SQL->fetch("SELECT visible from tff_cmspages where p_id=$id");
                $vis = $tmp[0]['visible'];
                $newvis = $vis == 0 ? $vis = 1 : $vis = 0;
                $SQL->query("UPDATE tff_cmspages set visible=$newvis where p_id=$id");
                Controller::redirect('admin/cms');
                break;

            case 'edit':
                $id = $params [2];
                $tmp = $SQL->fetch("SELECT * from tff_cmspages where p_id=$id");
                $template->assign('page_editor', $tmp [0]);
                $template->assign('categories', $this->categories);
                break;
            case 'edit_save':
                $p_id = _request('p_id', 0);
                $handle = _request('handle', '');
                $title = _request('title', '');
                $cat_id = _request('cat_id', 0);
                $keywords = _request('keywords', '');
                $description = _request('description', '');
                $contents = $SQL->escape($_REQUEST ['contents']);
                $bild = _request('headerbild_url', '');
                $add = ", headimg='{$bild}'";
                $SQL->query("UPDATE tff_cmspages set keywords='{$keywords}', description='{$description}',handle='{$handle}', title='{$title}',cat_id={$cat_id}, contents='{$contents}' {$add} where p_id={$p_id}");
                Controller::redirect('admin/cms/');
                break;
            case 'delete':
                $id = (int) $params [2];
                $SQL->query("DELETE from tff_cmspages where p_id={$id}");
                Controller::redirect('admin/cms/');
                break;
            case 'new':
                $handle = $SQL->escape($params [2]);
                $cat_id = $SQL->fetch("SELECT cat_id from tff_categories where handle='{$handle}'");
                $defaultpage = array(
                    'title' => 'Neuer Seitentitel',
                    'handle' => 'index',
                    'contents' => 'Dein Text',
                    'cat_id' => $cat_id [0] ['cat_id'],
                );
                $template->assign('categories', $this->categories);
                $template->assign('new_editor', $defaultpage);
                break;
            case 'new_save':
                $handle = _request('handle', '');
                $title = _request('title', '');
                $cat_id = _request('cat_id', 0);
                $contents = $SQL->escape($_REQUEST ['contents']);
                $keywords = _request('keywords', '');
                $description = _request('description', '');
                $SQL->query("INSERT INTO tff_cmspages (keywords,description,p_id,handle,title,cat_id,contents) VALUES('{$keywords}','{$description}',NULL,'{$handle}','{$title}','{$cat_id}','{$contents}')");
                Controller::redirect('admin/cms/');
                break;
        }
    }

    public function category($params)
    {
        global $SQL, $template;
        switch ($params [1]) {
            case 'edit':
                $tmp = $SQL->fetch("SELECT * from tff_categories where handle = '{$SQL->escape($params[2])}'");
                $template->assign('category_edit', $tmp [0]);
                break;
            case 'new':
                $template->assign('category_new', 1);
                break;

            case 'edit_save':
                $upd = _request('cat_id', 0);
                $handle = _request('handle', '');
                $desc = _request('category_description', '');
                if ($upd and $handle and $desc) {
                    $SQL->query("UPDATE tff_categories set handle = '{$handle}', category_description='{$desc}' where cat_id=$upd LIMIT 1");
                }
                Controller::redirect('admin/cms');
                break;
            case 'new_save':
                $handle = _request('handle', '');
                $desc = _request('category_description', '');
                if ($handle and $desc) {
                    $SQL->query("INSERT into tff_categories (handle,category_description) values ('{$handle}','{$desc}')");
                    $id = $SQL->last_id();
                    $SQL->query("INSERT into tff_cmspages (visible, cat_id,handle, title,contents) values(1,{$id},'index','Index','')");
                }
                Controller::redirect('admin/cms');
                break;
        }
    }
}

$admin_cms = new admincms();
