<?php

/**
 * Steuert letztendlich die Darstellungsschicht. Keine Template-Engine in dem Sinne mehr
 * notwendig. Ist egal, ob man eine META-Sprache lernen muss oder ob man hier
 * direkt PHP schreibt.
 *
 * @author Marcel Schindler <info@trancefish.de>
 */
class view
{
    public $view;
    public $path;

    public function __construct()
    {
        $this->path = TPL_DIR;
    }

    public function setTemplateDir($new)
    {
        $this->path = $new;
    }

    public function fetch($file)
    {
        $this->display($file);
    }

    public function display($file)
    {
        include $this->path.$file;

        return true;
    }

    public function assign($var, $value)
    {
        if (!empty($var) and !empty($value)) {
            $this->view[$var] = $value;

            return true;
        } else {
            $this->view[$var] = false;

            return false;
        }
    }
}
