<?php

    function createUsersTable()
    {
        dbQuery(
            'CREATE TABLE users (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
            )'
        );
    }

    function getAllUsers()
    {
        return dbQuery("SELECT * FROM users") ?? false;
    }

    function getUserByID($id)
    {
        $result = dbQuery('SELECT * FROM users WHERE id = :id LIMIT 1', ['id' => $id]);
        return $result[0] ?? false;
    }

    function getUserByName($name)
    {
        $result = dbQuery('SELECT * FROM users WHERE name = :name LIMIT 1', ['name' => $name]);
        return $result[0] ?? false;
    }

    function getUserByEmail($email)
    {
        $result = dbQuery('SELECT * FROM users WHERE email = :email LIMIT 1', ['email' => $email]);
        return $result[0] ?? false;
    }

    function addUser($name, $email, $password)
    {
        dbQuery(
            'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]
        );
    }

    function updateUser($id, $name, $email, $password)
    {
        dbQuery(
            'UPDATE users SET name = :name, email = :email WHERE id = :id LIMIT 1', [
                'id' => $id,
                'name' => $name,
                'email' => $email
            ]
        );

        if ($password) {
            dbQuery(
                'UPDATE users SET password = :password WHERE id = :id LIMIT 1', [
                    'id' => $id,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]
            );
        }

        if ($_SESSION['user']['id'] == $id) $_SESSION['user'] = getUserByID($id);
    }

    function deleteUser($id)
    {
        dbQuery('DELETE FROM users WHERE id = :id LIMIT 1', ['id' => $id]);
    }



    function validateName($name)
    {
        if (empty($name)) {
            return 'nincs név megadva';
        }

        if (strlen($name) < MIN_NAME_LENGTH) {
            return 'túl rövid név (min: ' . MIN_NAME_LENGTH . ' karakter)';
        }

        if (!preg_match('/^[\w\s.]+$/ui', $name)) {
            return 'érvénytelen név (csak betűk, számok, szóköz, aláhúzás és pont használható)';
        }

        if (getUserByName($name)) {
            return 'ezen a néven már létezik felhasználó';
        }
    }

    function validateEmail($email)
    {
        if (empty($email)) {
            return 'nincs email megadva';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'érvénytelen email';
        }

        if (getUserByEmail($email)) {
            return 'ez az email már használatban van';
        }
    }

    function validatePassword($password, $confirmPassword)
    {
        if (empty($password)) {
            return 'nincs jelszó megadva';
        }

        if (strlen($password) < MIN_PASSWORD_LENGTH) {
            return 'túl rövid jelszó (min: ' . MIN_PASSWORD_LENGTH . ' karakter)';
        }

        if ($password !== $confirmPassword) {
            return 'a két jelszó nem egyezik';
        }
    }



    function validateLogin($name, $password)
    {
        if (empty($name)) {
            return 'nincs név megadva';
        }

        if (empty($password)) {
            return 'nincs jelszó megadva';
        }

        if (empty($user = getUserByName($name))) {
            return 'nincs ilyen nevű felhasználó';
        }

        if (!password_verify($password, $user['password'])) {
            return 'nem megfelelő jelszó';
        }
    }
