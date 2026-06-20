<?php

// Compatibility shim: re-implements the legacy mysql_* API on top of mysqli
// so the unchanged application code runs on modern PHP (7/8). On old PHP 5.x
// where mysql_* still exists, the shim defines nothing and the originals are used.
include_once __DIR__ . '/mysql_compat.php';

$host = "localhost";
$username = "root";
$password = "";
$db = "talentwiz";


$con = mysql_connect($host, $username, $password);
if (!$con) {
    echo '<font color=red>' . mysql_error() . '</font>';
}
$db = mysql_select_db($db);
if (!$db) {
    echo '<font color=red>' . mysql_error() . '</font>';
}

session_start();
ob_start();
$_SESSION["project"] = "TalentWiz";
//@date_default_timezone_set(@date_default_timezone_get());

// Derive URL/PATH from the runtime environment so the app is portable
// (works under Apache at the original location or under `php -S` from the repo).
// Falls back to the original hard-coded values when run from CLI/unknown host.
$scriptDir = str_replace('\\', '/', dirname(dirname(__DIR__))); // .../TalentWiz
if (!empty($_SERVER['HTTP_HOST']) && !empty($_SERVER['SCRIPT_NAME'])) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    // Web path to the TalentWiz root: strip everything after "/TalentWiz/" in the request URI.
    $reqDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $pos = stripos($reqDir, '/TalentWiz');
    $base = ($pos !== false) ? substr($reqDir, 0, $pos + strlen('/TalentWiz')) : $reqDir;
    define("URL", $scheme . '://' . $_SERVER['HTTP_HOST'] . rtrim($base, '/') . '/');
    define("PATH", rtrim($scriptDir, '/') . '/');
} else {
    define("URL", "http://localhost/mridul/_TalentWiz/TalentWiz/");
    define("PATH", "D:/wamp/www/mridul/_TalentWiz/TalentWiz/");
}
?>