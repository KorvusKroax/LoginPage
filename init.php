<?php

    define('ROOT','/PlainLogin');

    session_start();

    require('db/db_init.php');





    function show($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
