<?php

final class Connection {

    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $username = "cringe";
                $password = "42Qwerty42";
                self::$instance = new PDO('mysql:host=localhost;dbname=syan42', $username, $password);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "</br>";
                die();
            }
        }
        return self::$instance;
    }
}