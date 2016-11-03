<?php

if (!defined('DROOT')) {
    exit('hu?');
}

class user
{
    public $username = false;
    public $logged;
    public $level = 0;
    private $salt = SALT;

    public function __construct()
    {
        $this->username = isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME'] : false;
        $this->logged = isset($_SESSION['user_logged_in']);
    }

    public function logged()
    {
        $this->username = isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME'] : false;
        $this->logged = isset($_SESSION['user_logged_in']);

        return $this->logged;
    }

    public function register($username, $password)
    {
        global $SQL;
        $SQL->query('INSERT into tff_users (user_name,password,lvl,user_mail)'
            ." values ('{$username}','{$password}',2,'{$username}')");
        $new_id = $SQL->last_id();
        // Create additional Data
        $this->save_additional_data($new_id);
    }

    public function save_additional_data($id)
    {
        global $SQL;
        $additional['vorname'] = _request('vorname', '');
        $additional['nachname'] = _request('nachname', '');
        $additional['birthday_dd'] = _request('birthday_dd', 0);
        $additional['birthday_mm'] = _request('birthday_mm', 0);
        $additional['birthday_yy'] = _request('birthday_yy', 0);
        $additional['gender'] = _request('gender', '');
        $data = json_encode($additional);
        $SQL->query('INSERT INTO tff_additional_data (uid, profile_data) '
            ."VALUES ($id,'{$data}')");
    }

    public function logout()
    {
        session_destroy();
    }

    public function login()
    {
        global $SQL;
        $_SESSION['fp'] = isset($_SESSION['fp']) ? $_SESSION['fp'] : md5($this->salt.$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);

        $username = _request('uname', '');
        $password = _request('upass', '');
        if ($username == '') {
            Controller::exit_app('Kein Benutzername angegeben');
        }
        if ($password == '') {
            Controller::exit_app('Kein Passwort angegeben');
        }
        $pw = md5($this->salt.$password);
        $suche = 'SELECT * FROM '.DB.'users where user_name="'.$username.'" and password="'.$pw.'" LIMIT 1';
        $userdata = $SQL->fetch($suche, false);
        if (!($userdata)) {
            Controller::exit_app('Benutzername und/oder Passwort falsch. Vergessen?'.$this->show_reminderlink());
        } else {
            $this->create_session($userdata[0]);
        }
    }

    public function show_reminderlink()
    {
        $html = '<br/><a href="'.WEB.'profile/resend_pw">Passwort erneut zuschicken</a>';

        return $html;
    }

    public function create_session($userdata)
    {
        session_regenerate_id();    // User ist eingelogged, kriegt ne neue Session.
        $_SESSION['user_logged_in'] = true;
        $_SESSION['hash'] = md5($this->salt.$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        $_SESSION['USERNAME'] = $userdata['user_name'];
        $_SESSION['uid'] = $userdata['user_id'];
    }

    public function get_level()
    {
        global $SQL;
        if (!isset($_SESSION['uid'])) {
            return false;
        }
        $uid = $_SESSION['uid'];
        $memb = $SQL->escape($_SESSION['USERNAME']);
        $tmp = $SQL->fetch('SELECT lvl from tff_users where user_id='.$uid.' and user_name="'.$memb.'" ');
        if (!$tmp) {
            return false;
        }

        return $tmp[0]['lvl'];
    }

    public function get_data()
    {
    }

    public function get_id()
    {
        $hash = md5($this->salt.$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        if ($_SESSION['hash'] == $hash) {
            return $_SESSION['uid'];
        }
    }
}

$USER = new USER();
