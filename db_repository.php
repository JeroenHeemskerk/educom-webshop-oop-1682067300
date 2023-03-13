<?php

function connectToDB() {

$servername = "127.0.0.1";
$username = "rubens_webshop_user";
$password = "test1234";
$database = "rubens_webshop";

$conn = mysqli_connect($servername, $username, $password, $database);    

if (!$conn) {
    throw new Exception("Cannot establish connection with the database." . mysqli_connect_error());
}
return $conn;
}

function closeDB($conn){
    mysqli_close($conn);
}

function saveNewUser($email,$name,$password) {
    $conn = connectToDB();
    try {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);        

        $sql = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')";
    
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("Query failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
        
        }
    catch(Exception $e){
        echo $e->getMessage();
    }
    finally {
        closeDB($conn);
    }
}

function findUserByEmail($email){
    $conn = connectToDB();
    $user = NULL;
    try {
        $email = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT id, email, name, password FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
        $user = mysqli_fetch_assoc($result);
        return $user;
        }
    catch(Exception $e){
        echo $e->getMessage();
    }
        
    finally {
        closeDB($conn);
    } 
}

?>