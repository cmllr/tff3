<?php

if (!defined('DROOT')) {
    exit('hu?');
}

class DCMS_DB
{
    public $result = false;
    public $cachefile = '';
    public $cfcontent = array();
    public $q = false;
    public $cid = false;
    public $id = false;
    public $cachedir = false;
    public $rows = 0;
    public $cachetime = 86400;
    public $last_query = '';
    public $is_cached = DB_CACHE;
    public $mysql;

    public function connect($svr, $usr, $pw)
    {
        $this->mysql = new mysqli($svr, $usr, $pw);
        $err = $this->mysql->connect_errno;
        if ($err) {
            return false;
        }
        $this->setcachedir(DROOT.'/cache/');

        return true;
    }

    public function setcachedir($path)
    {
        $this->cachedir = $path;
    }

    public function set_cache($on = true)
    {
        $this->is_cached = $on;
    }

    public function killcache_db()
    {
        $stamp = time() - 86400;
        $this->query('delete from tff_sqlcache where stamp <='.$stamp);
    }

    public function query($query)
    {
        $this->last_query = $query;
        $this->mysql->query("set names 'utf8'");
        $this->result = $this->mysql->query($query) or die($this->mysql->error.' '.$query);
        $this->rows = isset($this->result->num_rows) ? $this->result->num_rows : 0;
        $this->killcache();
    }

    public function killcache()
    {
        if ($this->is_cached == false) {
            return;
        }
        $stamp = time() - 86400;
        $dd = opendir($this->cachedir);
        while (false !== ($file = readdir($dd))) {
            if (!is_dir($this->cachedir.$file) and stristr($file, '.sqc')) {
                if (filemtime($this->cachedir.$file) <= $stamp) {
                    unlink($this->cachedir.$file);
                }
            }
        }
    }

    public function fetch_db($query, $cache = true)
    {
    }

    public function numrows()
    {
        return $this->rows;
    }

    public function changedb($database)
    {
        $this->mysql->select_db($database);
    }

    public function error($str)
    {
        echo $this->last_query;
        die($str);
    }

    public function field_names()
    {
    }

    public function last_id()
    {
        $tmp = $this->fetch('SELECT last_insert_id() as id');

        return $tmp[0]['id'];
    }

    public function fetch($query, $cache = true)
    {
        $cache = true;
        if ($this->is_cached == false) {
            $cache = false;
        }
        $q = $this->cachedir.md5($query).'.sqc';
        $stamp = time() - $this->cachetime;
        if ($cache and file_exists($q)) {
            include $q;
            $this->rows = count($ret);

            return $ret;
        } else {
            $this->query("SET NAMES 'utf8'");
            $this->query($query);
            $ret = $this->dataset();
            if (sizeof($ret) > 0 and $cache) {
                $fp = fopen($q, 'w');
                $wr = '<?php '."\n".'/* '.$query.' */'."\n".'$ret = '.(var_export($ret, true)).' ?>';
                fputs($fp, $wr);
                fclose($fp);
            }
        }

        return $ret;
    }

    public function dataset()
    {
        if ($this->result) {
            $x = 0;
            while ($data = $this->result->fetch_array(MYSQLI_ASSOC)) {
                $out[$x] = $data;
                ++$x;
            }

            return $out;
        }

        return false;
    }

    public function close()
    {
        $this->mysql->close();
    }

    public function freeresult()
    {
        return 1;
    }

    public function escape($string)
    {
        if (function_exists('mysqli_real_escape_string')) {
            return $this->mysql->real_escape_string($string);
        } else {
            if (get_magic_quotes_gpc()) {
                $string = stripslashes($string);
            } else {
                $string = addslashes($string);
            }

            return mysql_escape_string($string);
        }
    }
}
