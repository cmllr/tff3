<?php

class adminblog
{
    public $limit = 255;

    public function __construct()
    {
    }

    public function doChange($id)
    {
        global $SQL;
        $id = (int) $id;
        $tt = time();
        $tmp = $SQL->fetch("SELECT vis from tff_blog_posts where p_id={$id} limit 1");
        $upd = 0;
        if ($tmp[0]['vis'] == 0) {
            $upd = 1;
        }
        $SQL->query("UPDATE tff_blog_posts set vis={$upd}, times={$tt} where p_id={$id} limit 1");
        $page = (int) $_SESSION['view_page'];
        Controller::redirect('admin/blog/list/'.$page);
    }

    public function doBlog($params = false)
    {
        global $template, $SQL;
        $SQL->cachetime = 0;

        if (isset($params[0])) {
            switch ($params[0]) {
                case 'change_status': {
                        $this->doChange($params[1]);
                        break;
                    }
                case 'edit': {
                        if (!isset($params[1])) {
                            break;
                        }
                        $this->blogedit($params[1]);
                        break;
                    }
                case 'new': {
                        $this->doNewblog();
                        break;
                    }
                case'list': {
                        $this->doList($params);
                        break;
                    }
                case'deleteblog': {
                        $this->doDeleteBlog($params[1]);
                        break;
                    }
                case'saveblog': {
                        $this->doSaveblog($params);
                        break;
                    }
                case'newblog': {
                        $this->doNewBlog();
                        break;
                    }
                case 'cleanup': {
                        $this->cleanup();
                        break;
                    }
            }
        }
    }

    public function cleanup()
    {
        global $SQL;
        $SQL->query('DELETE from tff_blog_categories where cat_id not in (SELECT cat_id from tff_blog_relations)');
        controller::redirect('admin');
    }

    public function doList($params)
    {
        global $SQL;
        global $template;
        $page = isset($params[1]) ? (int) $params[1] * $this->limit
                : 0;
        $_SESSION['view_page'] = floor($page / $this->limit);
        $tmp = $SQL->fetch('SELECT p_id from tff_blog_posts');
        $max = count($tmp);
        $page_next = ($page / $this->limit + 1 <= $max / $this->limit)
                ? $page / $this->limit + 1 : floor($max / $this->limit);
        $page_prev = ($page / $this->limit - 1 >= 0) ? $page / $this->limit
            - 1 : 0;
        $template->assign('page_next', $page_next);
        $template->assign('page_prev', $page_prev);
        $template->assign('bloglist',
            $SQL->fetch('SELECT vis, p_id, title,comments_allowed from tff_blog_posts order by vis,times desc limit '.$page.",{$this->limit}"));
    }

    public function doNewblog()
    {
        global $template, $SQL, $USER;
        $template->assign('CK', 1);
        $template->assign('ADMIN_ACTION', 'admin/blog/newblog');
        $template->assign('action', 'editor');
        if (isset($_REQUEST['edit_title'])) {
            $title = $SQL->escape($_REQUEST['edit_title']);
            $contents = $SQL->escape($_REQUEST['edit_content']);
            $headimg = $SQL->escape($_REQUEST['ogimage']);
            $author = $USER->get_id();
            $time = time();
            $save = 'INSERT INTO tff_blog_posts (title,contents,author_id,times,headimg)
					values ("'.$title.'","'.$contents.'",'.$author.','.$time.', "'.$headimg.'")';
            $SQL->query($save);
            $new_id = $SQL->last_id();

            $this->handletags($new_id);
            Controller::redirect('admin/blog/list');
        }
    }

    public function blogedit($mod)
    {
        global $template, $SQL;
        $template->assign('CK', 1);
        $template->assign('action', 'editor');

        $entry = $SQL->fetch('SELECT * FROM tff_blog_posts where p_id='.$mod);
        $tags = $this->get_tags($mod);
        $list_tags = $SQL->fetch('SELECT handle from tff_blog_categories order by handle');
        $template->assign('tags', $list_tags);
        $template->assign('row', $entry[0]);
        $template->assign('edit_tags', $tags);
        $template->assign('edit_content', $entry[0]['contents']);
        $template->assign('edit_title', $entry[0]['title']);
        $template->assign('edit_ogimage', $entry[0]['headimg']);
        $template->assign('ADMIN_ACTION', 'admin/blog/saveblog');
        $template->assign('DELETE_ACTION', 'admin/blog/deleteblog');
        $_SESSION['editid'] = $mod;
    }

    public function get_tags($id)
    {
        global $SQL;
        $qqq = "SELECT r.cat_id, d.handle
                from tff_blog_relations r
                left join tff_blog_categories d on d.cat_id=r.cat_id
                where blog_id=$id";
        $tmp = $SQL->fetch($qqq);
        $out = '';
        if (!$SQL->numrows()) {
            return false;
        }
        foreach ($tmp as $row => $value) {
            $out .= $value['handle'].', ';
        }
        $out = trim($out);

        return $out;
    }

    public function doDeleteblog($edit)
    {
        global $SQL;
        $SQL->query('DELETE from tff_blog_posts where p_id='.$edit);
        $SQL->query('DELETE FROM tff_blog_relations where blog_id='.$edit);
// Zuletzt geänderter Eintrag löschen
        $page = isset($_SESSION['view_page']) ? (int) $_SESSION['view_page'] : 0;
        Controller::redirect('admin/blog/list/'.$page);
    }

    public function doSaveblog()
    {
        global $SQL;
        $_title = $SQL->escape(stripslashes($_REQUEST['edit_title']));
        $_entry = $SQL->escape(stripslashes($_REQUEST['edit_content']));
        $_headimg = $SQL->escape(stripslashes($_REQUEST['ogimage']));
        $time = time();
        $edit = $_SESSION['editid'];
        $this->handletags($edit);
        $update = 'UPDATE tff_blog_posts
			SET contents="'.$_entry.'",
			title="'.$_title.'",
			headimg="'.$_headimg.'"
			where p_id='.$edit.' limit 1';
        $SQL->query($update);
        unset($_SESSION['editid']);
        $page = isset($_SESSION['view_page']) ? (int) $_SESSION['view_page']
                : 0;
        Controller::redirect('admin/blog/list/'.$page);
    }

    public function handletags($post_id)
    {
        global $SQL;
        $tags = _request('tags', '');
        if (stristr($tags, ',')) {
            $tagarray = explode(',', $tags);
        } else {
            $tagarray[0] = $tags;
        }
        $SQL->query("DELETE FROM tff_blog_relations where blog_id=$post_id");
        foreach ($tagarray as $row => $tag) {
            $tmp = false;
            $tag = trim($tag);
            $ins = 0;
            if (strlen($tag) > 0) {
                $tmp = $SQL->fetch("SELECT cat_id from tff_blog_categories where handle='$tag'");
                if ($SQL->numrows() == 1) {
                    $ins = $tmp[0]['cat_id'];
                } else {
                    $SQL->query("insert into tff_blog_categories (handle) values ('$tag');");
                    $ins = $SQL->last_id();
                }
                if ($ins != 0) {
                    $SQL->query("insert into tff_blog_relations (blog_id, cat_id) values ($post_id,$ins) ");
                }
            }
        }
    }
}
$admin_blog = new adminblog();
