<?php

final class ErrorHandler {
    public static array $userErrors = [];
    public static array $errors = [
        "empty_fields" => "Please fill in the empty fields",
        "short_username" => "Username should contain at least 3 characters",
        "user_exists" => "User already exists",
        "restricted_chars" => "Username should only contain latin characters and numbers",
        "password_not_match" => "Passwords do not match",
        "short_password" => "Password is too short",
        "short_topic" => "Topic name should contain at least 3 characters",
        "topic_exists" => "Topic already exists",
        "short_title" => "Title should contain at least 6 characters",
        "long_title" => "Title should contain less than 100 characters",
        "user_not_found" => "User not found",
        "wrong_password" => "Wrong password",
    ];

    public static function show($name) {
       echo self::get($name);
    }
    public static function get($name) {
        foreach(self::$userErrors as $e) {
            if($e == $name) {
                return self::$errors[$name];
            }
        }
        return '';
    }

    public static function reset() {
        self::$userErrors = [];
    }

    public static function add($name) {
        array_push(self::$userErrors, $name);
    }
}
