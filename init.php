<?php

    define('ROOT','/PlainLogin');

    const MIN_NAME_LENGTH = 3;
    const MIN_PASSWORD_LENGTH = 3;

    session_start();

    require('db/db_init.php');





    function show($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
