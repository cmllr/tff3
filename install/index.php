<?php

ini_set('default_charset', 'UTF-8');
session_start();
error_reporting(E_ERROR);
ini_set('display_errors', 'on');
define('DROOT', dirname(__FILE__));
define('TPL_DIR', DROOT.'/../templates/setup/');
include DROOT.'/../main/view.php';
$template = new view();

class Installer
{
    public function __construct()
    {
        global $template;
        $path = '../';
        $steps = array('Willkommen', 'Serverprüfung', 'Datenbankeinrichtung', 'Daten einspielen', 'Zugangsdaten festlegen', 'Fertig');
        $template->assign('PAGEROOT', $path);
        $step = isset($_REQUEST['step']) ? (int) $_REQUEST['step'] : 0;
        $template->assign('step', $step);
        $template->assign('stepper', $steps);
        switch ($step) {
            case 1: {
                    $this->check_server();
                    break;
                } case 2: {
                    $this->database();
                    break;
                } case 3: {
                    $this->info_load_sql();
                    break;
                } case 4: {
                    $this->load_sql();
                    break;
                } case 5: {
                    $this->setup_user();
                    break;
                } case 6: {
                    $this->info_write_ini();
                    break;
                } case 7: {
                    $this->test_ini();
                    break;
                } default: {
                    session_destroy();
                    $this->welcome();
                    break;
                }
        }
    }

    public function info_write_ini()
    {
        global $template;
        $filename = '../ini/config.ini.dist';
        $ini_default = parse_ini_file($filename, true);
        $ini_default['database']['server'] = $_SESSION['db']['servername'];
        $ini_default['database']['user'] = $_SESSION['db']['user'];
        $ini_default['database']['pw'] = $_SESSION['db']['password'];
        $ini_default['database']['database'] = $_SESSION['db']['database'];
        $uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $ini_default['http']['webroot'] = str_replace('install/index.php?step=6', '', $uri);
        $ini_default['security']['salt'] = $_SESSION['saltsave'];
        $ini_contents = arr2ini($ini_default);
        $ini_contents = ';<?php exit() ?> Configuration for TFF3'."\r\n".$ini_contents;
        $template->assign('INI', $ini_contents);
        $template->display('inifile.php');
    }

    public function info_load_sql()
    {
        global $template;
        $template->display('loadsql.php');
    }

    public function setup_user()
    {
        global $template;
        $salt = gen_pass();
        $template->assign('SALT', $salt);
        $template->display('setup_user.php');
        if (isset($_REQUEST['user']) and strlen($_REQUEST['user']) > 0) {
            $this->create_user();
        }
    }

    public function create_user()
    {
        $user = strip_tags(trim($_REQUEST['user']));
        $pass = strip_tags(trim($_REQUEST['userpw']));
        $pass_c = strip_tags(trim($_REQUEST['userpwc']));
        if ($user != '' and $pass != '' and $pass_c != '') {
            $pw = md5($_REQUEST['salt'].$pass);
            $_SESSION['saltsave'] = $_REQUEST['salt'];
            $argu = $_SESSION['db'];
            $sql = $this->check_connect($argu);
            mysqli_query($sql, "INSERT INTO tff_users (user_name,lvl,password,user_mail) VALUES ('$user',1,'$pw','$mail')");
            header('location:index.php?step=6');
            exit();
        }
    }

    public function load_sql()
    {
        $argu = $_SESSION['db'];
        $sql = $this->check_connect($argu);
        $query = file_get_contents('install.sql');
        mysqli_multi_query($sql, $query);
        header('location:index.php?step=5');
        exit();
    }

    public function database()
    {
        global $template;
        if (isset($_REQUEST['servername'])) {
            foreach ($_REQUEST as $key => $data) {
                $argu[$key] = trim(strip_tags($data));
            }
            $success = $this->check_connect($argu);
            if ($success) {
                header('location:index.php?step=3');
                exit();
            }
        }
        $template->assign('database', $argu);
        $template->display('database.php');
    }

    public function check_connect($argu)
    {
        $res = mysqli_connect($argu['servername'], $argu['user'], $argu['password'], $argu['database'], $argu['port']);
        if ($res) {
            $_SESSION['db'] = $argu;

            return $res;
        }

        return false;
    }

    public function check_server()
    {
        global $template;
        $hint = array();
        $spec['Cache-Verzeichnis vorhanden'] = file_exists(DROOT.'/../cache') && is_dir(DROOT.'/../cache');
        $hint[] = 'Bitte erstelle ein Verzeichnis namens cache in deinem Web-Ordner.';
        $spec['mysqli-Erweiterung vorhanden'] = function_exists('mysqli_connect');
        $hint[] = 'Prinzipiell unterstützen wir auch andere Datenbanksysteme. Getestet wurde bisher aber nur auf MySQL/MariaDB';
        $spec['Mod_Rewrite vorhanden'] = $this->check_rewrite();
        $hint[] = 'Für die Clean-URLs, also die URLs, die ohne viele Parameter arbeiten, brauchen wir die mod_rewrite-Erweiterung deines Webservers.';
        $spec['PHP Version neuer als 5.1.0'] = true;
        if (version_compare(phpversion(), '5.1.0', '<')) {
            $spec['PHP Version neuer als 5.1.0'] = false;
        }
        $hint[] = 'Wir setzen mindestens PHP5.1.0 voraus. Am schnittigsten läuft TFF3 jedoch unter PHP7';
        if (in_array(false, $spec)) {
            $template->assign('recheck', true);
        }
        $template->assign('spec', $spec);
        $template->assign('hint', $hint);
        $template->display('servercheck.php');
    }

    public function check_rewrite()
    {
        $is = in_array('mod_rewrite', apache_get_modules());
        if (!$is) {
            $is = strpos(shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite') !== false;
        }

        return $is;
    }

    public function welcome()
    {
        global $template;
        $gpl = file_get_contents('gpl-3.0.txt');
        $gpl = htmlentities($gpl);
        $template->assign('gpl', $gpl);
        $template->display('welcome.php');
    }
}

$install = new Installer();

function gen_pass()
{
    $seed[0] = 'aeiouAEIUO';
    $seed[1] = 'bcdfghjklmnpqrstvwxyz';
    $seed[2] = '0123456789';
    $seed[3] = '.!@$';
    $l = 10;
    $pw = false;
    for ($x = 0; $x <= $l; ++$x) {
        $use = $x % 2 == 0 ? 2 : 3;
        if ($x <= 6) {
            $use = $x % 2 == 0 ? 0 : 1;
        }
        $len = strlen($seed[$use]) - 1;
        $char = rand(0, $len);
        $pw .= $seed[$use]{$char};
    }

    return $pw;
}

function arr2ini(array $a, array $parent = array())
{
    $out = '';
    foreach ($a as $k => $v) {
        if (is_array($v)) {
            $sec = array_merge((array) $parent, (array) $k);
            $out .= PHP_EOL.'['.implode('.', $sec).']'.PHP_EOL;
            $out .= arr2ini($v, $sec);
        } else {
            $out .= "$k = \"$v\"".PHP_EOL;
        }
    }

    return $out;
}
