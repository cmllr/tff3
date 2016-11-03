<?php

ini_set('default_charset', 'UTF-8');
define('DROOT', dirname(__FILE__)); // Where am I?
define('INCL', DROOT.'/main'); // Include Directory
if (!file_exists('cache')) {
    exit('Caching not available. Please create a folder named "cache"');
}
include INCL.'/bootstrap.php';
$dispatch = Controller::dispatch();
