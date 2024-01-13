<?php

    // require('../db_init.php');

    $id = $_POST['id'];
    $key = $_POST['key'];
    $name = $_POST['name'];

    $list = getListById($id);
    $list['items'][$key]['name'] = trim($name);

    updateList($id, $list);
