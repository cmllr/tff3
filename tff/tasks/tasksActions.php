<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');
/*
 * Description of taskActions.
 *
 * @author Marcel Schindler
 */

$template->setTemplateDir(DROOT.'/templates/tasks/');

class tasks
{
    public $tasklist;
    public $whitelist;
    private $path;

    public function __construct()
    {
        global $SQL;
        global $template;
        //setlocale(LC_ALL, 'de_DE');
        $this->whitelist = array('mp3', 'jpg', 'jpeg', 'gif', 'png', 'pdf', 'zip',
            'ogg', 'xm', 'it', 'mod', 'rar', 'mp4', 'csv', 'txt', 'doc', );

        $SQL->set_cache(false);
        $this->path = DROOT.'/web/_task';

        if (!file_exists($this->path)) {
            exit('_task-Verzeichnis nicht vorhanden');
        }
        $tmp = $SQL->fetch('SELECT * from tff_tasks order by id desc');

        if (!$tmp) {
            return false;
        }
        foreach ($tmp as $row => $value) {
            $mask = $this->path.DIRECTORY_SEPARATOR.$value['id'].'_*';
            $out[$row] = $value;
            $out[$row]['creationdate'] = strftime('%x %X', $value['creation']);
            $out[$row]['modificationdate'] = strftime('%x %X', $value['modification']);
            $out[$row]['files'] = glob($mask);
        }
        $template->assign('tasks', $out);
        $this->tasklist = $out;

        return true;
    }

    public function doCalendar($params)
    {
        $tmp = $this->get_entry($params);
        $datum = $this->dateToCal($tmp[0]['creation']);
    }

    public function escapeString($string)
    {
        return preg_replace('/([\,;])/', '\\\$1', $string);
    }

    public function dateToCal($timestamp)
    {
        return date('Ymd\THis\Z', $timestamp);
    }

    public function doDefault()
    {
    }

    public function handle_upload($id)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        if (!empty($_FILES['newfile']['tmp_name'][0])) {
            $t = count($_FILES['newfile']);
        } else {
            return false;
        }
        for ($x = 0; $x < $t; ++$x) {
            $filename = $_FILES['newfile']['name'][$x];
            if (!isset($_FILES['newfile']['name'][$x])) {
                Controller::redirect('tasks');
                exit;
            }
            $filename = $_FILES['newfile']['name'][$x];
            $tmp = pathinfo($filename);
            if (!in_array(strtolower($tmp['extension']), $this->whitelist)) {
                Controller::exit_app('Ungültiger Dateityp');
            }
            $tmpname = $_FILES['newfile']['tmp_name'][$x];
            $out = $id.'_'.$x.'_'.$tmp['basename'];
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
    }

    public function doCreate()
    {
        global $SQL;
        $stamp = time();
        $title = _request('title', '');
        $contents = _request('contents', '');
        $id = _request('id', 0);
        if ($title != '') {
            if ($id == 0) {
                $SQL->query("INSERT INTO tff_tasks(title,contents,creation) values('{$title}','{$contents}',{$stamp}); ");
                $file_handle = $SQL->last_id();
            } else {
                $SQL->query("UPDATE tff_tasks set title='{$title}',contents='{$contents}',modification={$stamp} where id={$id}");
                $file_handle = $id;
            }
            $this->handle_upload($file_handle);
        }
        controller::redirect('tasks');
    }

    public function get_entry($params)
    {
        global $SQL;
        $id = (int) $params[0];
        $tmp = $SQL->fetch("SELECT * FROM tff_tasks where id={$id}");

        return $tmp;
    }

    public function doEdit($params)
    {
        global $SQL;
        global $template;
        $tmp = $this->get_entry($params);
        $template->assign('edit', $tmp[0]);
    }

    public function doDel($params)
    {
        global $SQL;
        $id = (int) $params[0];
        $SQL->query("DELETE FROM tff_tasks where id={$id}");
        $this->delete_files($id);
        controller::redirect('tasks');
    }

    public function delete_files($id)
    {
        $mask = $this->path.DIRECTORY_SEPARATOR.$id.'_*';
        array_map('unlink', glob($mask));
    }
}
