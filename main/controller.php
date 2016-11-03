<?php

if (!defined('DROOT')) {
    exit('hu?');
}

/**
 * TFF Framework. Simple as possible Framework with not many features but
 * easy to maintain.
 *
 * @author Marcel Schindler <info@trancefish.de>
 */
class controller
{
    /**
     * Disable Constructor.
     *
     * @return false
     */
    public function __construct()
    {
        return false;
    }

    /**
     * Handle Redirects.
     *
     * @param type string $string relative url
     */
    public static function redirect($string = false)
    {
        header('location:'.WEB.$string.'?'.SID);
    }

    /**
     * Returns PHP_SELF in a clean-URL-Manor.
     *
     * @return type string URL
     */
    public static function returnPath()
    {
        $path = self::splitstring();
        if ($path['page'] == 'page' and $path['action'] == 'default') {
            return WEB;
        }
        if ($path['page'] == 'home') {
            return WEB;
        }

        if ($path['action'] == 'default') {
            $path['action'] = '';

            return WEB.$path['page'].'/';
        }

        return WEB.$path['page'].'/'.$path['action'].'/'.implode('/', $path['params']);
    }

    /**
     * Split URL and prepare variables.
     *
     * @return type array module, function, function params
     */
    public static function splitstring()
    {
        $path = strtok($_SERVER['REQUEST_URI'], '?'); // Get to GET-Params
        $requestURI = explode('/', $path);
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        for ($i = 0; $i < sizeof($scriptName); ++$i) {
            if ($requestURI[$i] == $scriptName[$i]) {
                unset($requestURI[$i]);
            }
        }
        $command = array_values($requestURI);

        // QueryString auseinanderdröseln
        $qs = @parse_url($_SERVER['REQUEST_URI']) or self::pagenotfound_handler('WTF?');

        if (isset($qs['query'])) {
            $get = explode('&', $qs['query']);
            foreach ($get as $r => $v) {
                list($key, $val) = isset($v[0]) ? (explode('=', $v)) : false;
                {
                    $_REQUEST[$key] = $val;
                }
            }
        }
        /* Set Actions */
        $page = isset($command[0]) ? strlen(trim($command[0])) > 0 ? $command[0] : 'home' : 'home';
        $action = isset($command[1]) ? strlen(trim($command[1])) > 0 ? $command[1] : 'default' : 'default';
        unset($command[0]);
        unset($command[1]);
        $params = array_values($command); // Additional-Params
        return array('page' => $page, 'action' => $action, 'params' => $params);
    }

    /**
     * 404-Seite ausgeben. Mit Fehlermeldug.
     *
     * @param type $string Fehlermeldung
     */
    public static function pagenotfound_handler($string = false)
    {
        self::exit_app($string);
    }

    /**
     * 404 Seite tatsächlich darstellen.
     *
     * @global type $template
     *
     * @param type $msg
     */
    public static function exit_app($msg)
    {
        global $template;
        header('HTTP/1.0 404 Not Found');
        $template->assign('errormessage', $msg);
        $template->display('404.php');

        exit(false);
    }

    /**
     * Dispatch the webpage. Display everything.
     *
     * @global type $template
     */
    public static function dispatch()
    {
        global $template;
        $data = self::splitstring();
        $class = isset($data['page']) ? $data['page'] : '';
        $method = $data['action'];
        $params = $data['params'];
        // Lade Standardmodule
        self::defaultModules();

        $fname = (strtolower($class).'/'.strtolower($class).'Actions.php');
        if (strpos($class, '.') or strpos($class, '/') or strpos($class, '\\')) {
            self::exit_app(ERR_FILE_NOT_FOUND);
        }
        // Try to open the Class
        if (!file_exists(CLASSDIR.($fname))) {
            self::exit_app('Leider konnte die von Ihnen gesuchte Datei nicht gefunden werden. Dies kann mehrere Ursachen haben:<ul><li>Die verlinkende Website hat veraltete Daten</li><li>Die Datei wurde hier auf dem Server gelöscht</li><li>Die Datei wurde in einen anderen Bereich verschoben</li></ul>');
        } else {
            include CLASSDIR.$fname;
        }

        // Instantiate Class
        $launch = new $class();

        // Direkzugriff auf CMS-Seiten
        if ($class == 'cms') {
            $params = $data;
            $method = 'Default';
        }

        // Choose Method
        $actionMethod = 'do'.ucfirst($method);

        if (!method_exists($launch, $actionMethod)) {
            self::exit_app(ERR_METHOD_NOT_FOUND);
        }

        $launch->$actionMethod($params);
        if (file_exists(TPL_DIR.$class.'.php')) {
            $template->display($class.'.php');
        }
    }

    /**
     * Dummy-Function do load other scripts.
     *
     * @return false
     */
    public static function defaultModules()
    {
        return false;
    }
}
