<?php

    $username = "root";
    $password = "";
    $host = "127.0.0.1";
    $dbname = "Bookingsystem";

        try {
            $db = new PDO("mysql:host={$host};dbname={$dbname};", $username, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        header('Content-Type: text/html; charset=utf-8');

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


		session_start();

?>
