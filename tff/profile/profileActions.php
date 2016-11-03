<?php

class profile
{
    public function doDefault()
    {
        global $template;
        if (isset($_SESSION['check_email'])) {
            unset($_SESSION['check_email']);
            $template->assign('check_mail',
                'style="border:1px solid red;color:red;background:white"');
        }
        if (isset($_SESSION['check_pw'])) {
            unset($_SESSION['check_pw']);
            $template->assign('check_pw',
                'style="border:1px solid red;color:red;background:white"');
        }

        return true;
    }

    public function doLogin($params = false)
    {
        global $USER;
        $USER->login();
        $redirect = 'admin';
        if (isset($params[0]) and !empty($params[0])) {
            $redirect = $params[0];
        }
        if ($USER->get_level() == 1) {
            Controller::redirect($redirect);
        } else {
            Controller::redirect(false);
        }
    }

    public function doFailure()
    {
        global $template;
        $template->assign('Fail', true);
    }

    public function doRegister()
    {
        global $USER, $template, $SQL;
        if ($USER->logged()) {
            Controller::redirect();
        }
        // Validate Data
        $mail = _request('email', '');
        $pw = _request('pw', '');
        $pwc = _request('pwc', '');
        $pw_okay = true;
        if ($pwc != $pw or strlen($pw) == 0) {
            $_SESSION['check_pw'] = true;
            $pw_okay = false;
        }
        if (!$this->email($mail)) {
            $_SESSION['check_email'] = true;
            $pw_okay = false;
        }
        if (!$pw_okay) {
            $this->doDefault();

            return false;
        } else {
            // Augenscheinlich erstmal alles okay
            $pw = md5(SALT.$pw);
            $tmp = $SQL->fetch("SELECT user_id from tff_users where user_mail='$mail'");
            if ($tmp) {
                controller::exit_app('User existiert schon');
            } else {
                $SQL->query("INSERT INTO tff_users (lvl,user_mail,password,user_name) VALUES (3,'$mail','$pw','Leerbenutzer')");
                $this->notify_user();
                Controller::redirect('profile/success');
            }
        }
    }

    public function notify_user()
    {
        // Dummyfunktion, um Benutzer zu benachrichtigen
    }

    public function email($string)
    {
        return _mailchecker($string);
    }

    public function doSuccess()
    {
        global $template;
        $template->assign('success', 1);
    }

    private function exists($name)
    {
        global $SQL;
        $tmp = $SQL->fetch("SELECT user_name from tff_users where user_name='{$name}'");

        return $tmp;
    }

    public function doLogout($params = false)
    {
        global $USER;
        $redirect = 'admin';
        if (isset($params[0]) and !empty($params[0])) {
            $redirect = $params[0];
        }
        $USER->logout();
        controller::redirect($redirect);
    }
}
