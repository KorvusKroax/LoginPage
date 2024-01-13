<?php

    // require('../db_init.php');

    $id = $_POST['id'];
    $key = $_POST['key'];

    $list = getListById($id);
    $list['items'][$key]['state'] = !$list['items'][$key]['state'];

    updateList($id, $list);
