<?php

class SessionManager {
    public function loginUser($name, $id) {
        $_SESSION['login'] = $name;
        $_SESSION['user_id'] = $id;
        $_SESSION['cart'] = array();
    }
    
    public function isUserLoggedIn() {
        return isset($_SESSION['login']);
    }
    public function getLoggedInUserName() {
        return $_SESSION['login'];
    }

    public function getLoggedInID() {
        return $_SESSION['user_id'];
    }
    
    public function logoutUser() {
        unset($_SESSION['login']);
    }

    public function addToCart($priceId, $amount) {
        if(isset($_SESSION['cart'][$priceId])){
        $_SESSION['cart'][$priceId] += $amount;
        } else { 
        $_SESSION['cart'][$priceId] = $amount;
        }
    }

    public function updateCart($priceId, $amount) {
        $_SESSION['cart'][$priceId] = $amount;
    }
    public function removeFromCart($priceId) {
        unset($_SESSION['cart'][$priceId]);
    }

    public function getCart(){
        return $_SESSION['cart'];
    }

    public function emptyCart() {
        $_SESSION['cart'] = array();
    }
}
?>