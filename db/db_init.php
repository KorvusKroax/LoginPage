<?php

    define('DB_DRIVER','mysql');
    define('DB_NAME','plain_login');
    define('DB_HOST','localhost');
    define('DB_PORT','');
    define('DB_USER','root');
    define('DB_PASSWORD','');

    require('db_functions.php');
    require('db_functions_users.php');



    if (!isDatabaseExists()) createDatabase();

    if (!isTableExists("users")) createUsersTable();
    if (!getAllUsers()) addUser('admin', 'admin@email.com', 'password');
