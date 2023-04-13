<?php
function loginUser($name, $id) {
    $_SESSION['login'] = $name;
    $_SESSION['user_id'] = $id;
    $_SESSION['cart'] = array();
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

function addToCart($priceId, $amount) {
    if(isset($_SESSION['cart'][$priceId])){
    $_SESSION['cart'][$priceId] += $amount;
    } else { 
    $_SESSION['cart'][$priceId] = $amount;
    }
}

function updateCart($priceId, $amount) {
    $_SESSION['cart'][$priceId] = $amount;
}

function getCartContent(){
    return $_SESSION['cart'];
  }

?>