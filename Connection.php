<?php
namespace App;
use PDO;
use PDOException;

final class Connection {

    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $username = "root";
                $password = "Raven1234!";
                self::$instance = new PDO('mysql:host=localhost;dbname=blog_db', $username, $password);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "</br>";
                die();
            }
        }
        return self::$instance;
    }
}