<?php
function loginUser($name, $id) {
    $_SESSION['login'] = $name;
    $_SESSION['user_id'] = $id;
}
 
function isUserLoggedIn() {
    return isset($_SESSION['login']);
}
 
function getLoggedInUserName() {
    return $_SESSION['login'];
}

function getLoggedInID() {
    return $_SESSION['user_id'];
}
 
function logoutUser() {
    unset($_SESSION['login']);
}
?>