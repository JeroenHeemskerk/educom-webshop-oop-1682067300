<?php

class Util {
    public static function getArrayVar($array, $key, $default = '') {
        return isset($array[$key]) ? $array[$key] : $default;
    }
    
    public static function getPostVar($key, $default = '') {
        return getArrayVar($_POST, $key, $default);
    }
    
    public static function getUrlVar($key, $default = '') {
        return getArrayVar($_GET, $key, $default);
    }

    public static function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}