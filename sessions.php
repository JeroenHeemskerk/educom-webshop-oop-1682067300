<?php
function loginUser($name) {
    $_SESSION['login'] = $name;
}
 
function isUserLoggedIn() {
    return isset($_SESSION['login']);
}
 
function getLoggedInUserName() {
    return $_SESSION['login'];
}
 
function logoutUser() {
    unset($_SESSION['login']);
}
?>