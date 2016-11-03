<?php

/**
 * Handle User Comment Input.
 */
class comment
{
    public function doDefault()
    {
        return false;
    }

    /**
     * Speichere den Kommentar.
     *
     * @params array parameter
     */
    public function doSave($params)
    {
        $bid = isset($params[0]) ? (int) $params[0] : false;
        if (!$bid) {
            Controller::exit_app('Fehlerhafter Aufruf. ');
        }
        $user = _request('Name', '');
        $mail = _request('email', '');
        $url = _request('Website', '');
        $comment = _request('Kommentar', '');
        $fight = _request('fight', 0);
        if ($fight) {
            Controller::exitApp('Danke. Der Kommentar wird bald freigeschaltet.');
        }
        $this->save_comment($user, $mail, $url, $comment, $bid);
    }

    private function save_comment($user, $mail, $url, $comment, $bid)
    {
        global $SQL;
        $user = $SQL->escape($user);
        $mail = $SQL->escape($mail);
        $url = $SQL->escape($url);
        $comment = $SQL->escape($comment);
        if (empty($comment)) {
            controller::exit_app('Whoops. Kommentar leer?');
        }
        if (empty($mail)) {
            controller::exit_app('Bitte gib eine Emailadresse an');
        }
        if (empty($user)) {
            controller::exit_app('Bitte gib deinen Namen ein');
        }
        $stamp = time();
        $query = "INSERT INTO tff_comments (blogid,user,mail,url,comment,stamp) VALUES ({$bid},'{$user}','{$mail}','{$url}','{$comment}',{$stamp})";
        //    echo $query;
        $SQL->query($query);
        $urlout = $this->fetch_blog($bid, true);
        $mailstuff = $comment."\r\n".WEB.$urlout;
//        mail(ADMIN_MAIL, 'Blogkommentar', $mailstuff);
        controller::redirect($urlout);
    }

    private function fetch_blog($bid)
    {
        global $SQL;
        $cat_nm = false;
        $url = $SQL->fetch("SELECT title from tff_blog_posts where p_id={$bid}");
        $cat_tmp = $SQL->fetch("SELECT cat_id from tff_blog_relations where blog_id={$bid} LIMIT 1");
        if ($cat_tmp) {
            $id = $cat_tmp[0]['cat_id'];
            $cat_nm = $SQL->fetch("SELECT handle from tff_blog_categories where cat_id={$id}");
        }
        if (!$cat_nm) {
            Controller::exit_app('Whoops');
        }
        $urlout = 'blog/show/'.urlencode($cat_nm[0]['handle']).'/'.urlencode($url[0]['title']);

        return $urlout;
    }

    public function doDelete($params)
    {
        global $USER, $SQL;
        if ($USER->get_level() == 1) {
            $cid = (int) $params[0];
            if ($cid) {
                $SQL->query("DELETE from tff_comments where cid={$cid}");
            }
        }
        controller::redirect();
    }

    public function date3339($timestamp = 0)
    {
        if (!$timestamp) {
            $timestamp = time();
        }
        $date = date('D, d M y H:i:s O', $timestamp);

        return $date;

        $matches = array();
        if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp),
                $matches)) {
            $date .= $matches[1].$matches[2].':'.$matches[3];
        } else {
            $date .= 'Z';
        }

        return $date;
    }

    public function doRss()
    {
        global $SQL, $template;
        $posts = $SQL->fetch('SELECT * from tff_comments  order by stamp desc LIMIT 50');
        if (!$posts) {
            return false;
        }
        foreach ($posts as $row => $data) {
            // Eben die Blogs rausholen
            $blogs[$data['blogid']] = $data['blogid'];
            $comments[$data['blogid']] = $data;
        }
        $list = implode(',', $blogs);
        $qqq = 'SELECT b.title, c.handle from tff_blog_posts b '
            .'LEFT JOIN tff_blog_relations r on r.blog_id=b.p_id '
            .' JOIN tff_blog_categories c ON r.cat_id = c.cat_id '
            ." WHERE b.p_id in ({$list}) and b.vis=1";
        $blogurls = $SQL->fetch($qqq);
        $stamp = time();
        $out['pubDate'] = $this->date3339($stamp);
        $out['PAGEROOT'] = WEB;
        $out['title'] = 'CommentRSS';
        $x = 0;
        foreach ($blogurls as $row => $data) {
            $tmp['url'] = WEB.'blog/'.urlencode($data['handle']).'/'.$data['title'];
            $tmp['author'] = 'TFF';
            $tmp['updated'] = $this->date3339($data['times']);
            $tmp['description'] = $data['contents'];
            $out['blogposts'][] = $tmp;
        }
        $template->assign('title', $out['title']);
        $template->assign('pubDate', $out['pubDate']);
        $template->assign('blogposts', $out['blogposts']);
        $template->display('rss.php');
        exit();
    }
}
