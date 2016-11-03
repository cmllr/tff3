<?php

class adminfiler
{
    private $path;
    private $whitelist;

    public function doFiler($params)
    {
        $action = isset($params[0]) ? $params[0] : 'browse';
        switch ($action) {
            case 'usage':
                $this->show_usage($params);
                break;
            case 'browse':
                $this->browse();
                break;
            case 'upload':
                $this->handle_upload();
                break;
            case 'delete':
                $this->delete($params);

            default:
                $this->browse();
                break;
        }
    }

    public function show_usage($params)
    {
        $id = (int) $params[1];
        $files = $this->browse();
        $thefile = ($files[$id]);
        $out = $thefile['usage'];
        if (is_array($out)) {
            $html = '<ul>';
            foreach ($out as $row => $data) {
                $html .= '<li>'.$data['title'].'</li>';
            }
            $html .= '</ul>';
            echo $html;
            exit();
        }
        echo '';
        exit();
    }

    public function delete($params)
    {
        $id = (int) $params[1];
        $files = $this->browse();
        $thefile = ($files[$id]);
        unlink(DROOT.'/web/_media/'.basename($thefile['filename_info']));
        Controller::redirect('admin/filer');
    }

    public function __construct()
    {
        $this->path = DROOT.'/web/_media';
        $this->whitelist = array('mp3', 'jpg', 'jpeg', 'gif', 'png', 'pdf', 'zip',
            'ogg', 'xm', 'it', 'mod', 'rar', 'mp4', );
    }

    /**
     * Prüfung, in welchen Datensätzen eine Datei hinterlegt ist.
     *
     * @param type $filename
     */
    private function usage_index($filename)
    {
        global $SQL;
        $cachedir = DROOT.'/cache/';
        $index = md5($filename);
        $indexfile = $cachedir.$index.'.idx';
        if (file_exists($indexfile)) {
            // Lese direkt die Index-Datei aus und gib ein Array zurück
            $tmp = file_get_contents($indexfile);
            $out = unserialize($tmp);

            return $out;
        }
        $posts = $SQL->fetch("SELECT p_id,title FROM tff_blog_posts where headimg='$filename' OR contents like '%{$filename}%'");
        if (is_array($posts)) {
            $fp = fopen($indexfile, 'w+');
            fputs($fp, serialize($posts));
            fclose($fp);

            return $posts;
        }

        return false;
    }

    public function browse()
    {
        global $template;
        $scanned_directory = array_diff(scandir($this->path), array('..', '.'));
        $x = 0;
        $files = false;
        rsort($scanned_directory);
        foreach ($scanned_directory as $row => $data) {
            $url = WEB.'web/_media/'.basename($data);
            $files[$x]['filename_display'] = $url;
            $files[$x]['filename_info'] = basename($data);
            $files[$x]['icon'] = $this->filetype($data);
            $files[$x]['usage'] = $this->usage_index($url);
            ++$x;
        }
        if (!$scanned_directory) {
            return false;
        }
        $template->assign('files', $files);
        $template->assign('whitelist', $this->whitelist);

        return $files;
    }

    public function handle_upload()
    {
        global $USER;
        if (isset($_FILES['newfile'])) {
            $t = count($_FILES['newfile']);
        } else {
            return false;
        }
        for ($x = 0; $x < $t; ++$x) {
            //            $filename = $_FILES['newfile']['name'][$x];
            if (!isset($_FILES['newfile']['name'][$x])) {
                Controller::redirect('admin/filer');
                exit;
            }
            $filename = $_FILES['newfile']['name'][$x];
            $tmp = pathinfo($filename);
            if (!in_array(strtolower($tmp['extension']), $this->whitelist)) {
                Controller::exit_app('Ungültiger Dateityp');
            }
            $tmpname = $_FILES['newfile']['tmp_name'][$x];
            $out = $_SESSION['uid'].'_'.time().$tmp['basename'];
            $destination = $this->path.DIRECTORY_SEPARATOR.$out;
            if ($tmp['extension'] == 'jpg') {
                $img = imagecreatefromjpeg($tmpname);
                // Optimierte Version speichern
                imagejpeg($img, $destination, 75);
            }

            if ($tmp['extension'] == 'gif') {
                $img = imagecreatefromgif($tmpname);
                // Optimierte Version speichern
                imagegif($img, $destination);
            }

            if ($tmp['extension'] == 'png') {
                $img = imagecreatefrompng($tmpname);
                // Optimierte Version speichern
                imagepng($img, $destination, 4);
            } else {
                move_uploaded_file($tmpname, $destination);
            }
        }
        Controller::redirect('admin/filer');
    }

    public function filetype($file)
    {
        $x = pathinfo($this->path.DS.$file);
        $x['extension'] = strtolower($x['extension']);
        if ($x['extension'] == 'jpg' or $x['extension'] == 'jpeg' or $x['extension']
            == 'gif' or $x['extension'] == 'png') {
            return WEB.'web/_media/'.$file;
        } else {
            return false;
        }
    }
}
$admin_filer = new adminfiler();
