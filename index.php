<?php
    require('init.php');

    if ($_GET['url']) {
        $url = explode('/', $_GET['url']);
        $page = 'pages/'.$url[0].'.php';
        if (file_exists($page)) {
            require($page);
        } else {
            require('pages/404.php');
        }
    } else {
        require('pages/home.php');
    }
