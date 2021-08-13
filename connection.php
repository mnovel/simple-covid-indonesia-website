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
