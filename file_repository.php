<?php

function findUserByEmail($email) {
    $users_file = fopen("Users/users.txt", "r");
    $user = NULL;

    while (!feof($users_file)) { 
        $row= fgets($users_file);
        $parts = explode("|", $row);
        $foundEmail = trim($parts[0]);
        if ($foundEmail == $email) { 
            $user = array("email" => $foundEmail, "name"=> trim($parts[1]), "password"=> trim($parts[2]));
            break; 
            // TIP: We hebben de user gevonden, als je hier een `break;` zet, hoef je de rest van de file niet door te lezen.
        }
        
        // if ($parts[0] == $email) {
        //     $user = array("email" => $parts[0], "name"=> $parts[1], "password"=> $parts[2]);
        // }
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