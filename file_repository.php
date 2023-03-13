<?php

function findUserByEmail($email) {
    $users_file = fopen("Users/users.txt", "r");
    $user = NULL;

    while (!feof($users_file)) { 
        $row= fgets($users_file);
        $parts = explode("|", $row);
        if ($parts[0] == $email) {
            $user = array("email" => $parts[0], "name"=> $parts[1], "password"=> $parts[2]);
        }
    }
    fclose($users_file); 
    return $user;       
}

function saveNewUser($email, $name, $password) {
    $users_file = fopen("Users/users.txt", "a");
    $new_user = PHP_EOL ."$email|$name|$password";
    fwrite($users_file, $new_user);
    fclose($users_file);
}
?>