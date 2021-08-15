<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {

    define('db_user', 'root');
    define('db_pass', 'B4ngs4d0');
    define('db_host', 'localhost');
    define('db_name', 'covid');
} else {
    define('db_user', 'magerin_covid');
    define('db_pass', '.ITRf_zcK}==');
    define('db_host', 'localhost');
    define('db_name', 'magerin_covid');
}


$connection = mysqli_connect(db_host, db_user, db_pass, db_name);


if (!$connection) {
    echo mysqli_connect_error();
    die;
}

$malicious = "/alert\(|alert \(|<|>|\"|\||\'|information_schema|\/var|\/etc|\/home|file_get_contents|shell_exec|table_schema|user\(\)|user \(\)/";

if (!empty($_GET)) {
    foreach ($_GET as $res) {
        if (preg_match($malicious, $res)) {
            include_once "403.php";
            exit;
        }
    }
}

if (!empty($_POST)) {
    foreach ($_POST as $res) {
        if (preg_match($malicious, $res)) {
            include_once "403.php";
            exit;
        }
    }
}
