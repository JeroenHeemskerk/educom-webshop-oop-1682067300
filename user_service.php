<?php
    function doesEmailExist($email) {
        $user = findUserByEmail($email);
        if (empty($user)) {
        return false;
        } else {
        return true;
        }
    } 
    
    function StoreUser($email, $name, $password) {
        saveNewUser($email, $name, $password);
    }
    
    define("VALID_LOGIN", 0);
    define("WRONG_PASSWORD", -1);
    define("WRONG_EMAIL", -2);
    
    function authenticateUser($email, $password) {
        $user = findUserByEmail($email);
        if (empty($user)) {
            return array("result" => WRONG_EMAIL, "user" => $user);
        }
        if ($user['password'] != $password) {
            return array("result" => WRONG_PASSWORD, "user" => $user);
        }
        return array("result" => VALID_LOGIN, "user" => $user);
    }
?>