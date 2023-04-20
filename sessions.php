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
function removeFromCart($priceId) {
    unset($_SESSION['cart'][$priceId]);
}

function getCart(){
    return $_SESSION['cart'];
  }

function getCartContent() {
    $cart = getCart();
    if (empty($cartContent)) {
        echo 'Uw winkelwagen is nog leeg. &#128532';
    } else {
    $products = fetchProductByPrizeId(array_keys($cart));
    $total = 0;
    $cartlines = array();
        foreach($cart as $priceId=>$amount) {
            $product = $products[$priceId];
            $subtotal = $amount * $product['price'];
            $cartline = array('price_id' => $priceId, 'id' => $product['id'], 'amount' => $amount, 'name' => $product['name'], 'subtotal' => $subtotal,
                            'price' => $product['price'], 'image' => $product['image'], 'size_id' => $product['size_id'], 'material_id' => $product['material_id'], 
                            'material' => $product['material']);
            $cartlines[] = $cartline;
            $total += $subtotal;
        }
        return array('cartlines'=>$cartlines, 'total' => $total);
    }
}
?>