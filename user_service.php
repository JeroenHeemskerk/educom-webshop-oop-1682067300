<?php
    include 'db_repository.php';

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

    function ChangePass($password) {
        updateUserPass($password);
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

    function getProducts(){
        $products = selectProducts();
        return $products;
    }

    function doesProductExist($productId, $sizeId, $materialId) {
        $product = findProductByIdSizeAndMaterial($productId, $sizeId, $materialId);
        if (empty($product)) {
            return false;
        } else {
            return $product;
        }
    }

    function handleAction() {
        $action = getPostVar("action");
        switch($action) {
            case "Toevoegen" :
                $flavouredproduct = getPostVar("flavour");
                $priceId = explode("_", $flavouredproduct);
                $amount = getPostVar("amount");
                if ($amount > 0) {
                    addToCart($priceId[3], $amount);
                }
                break;
            case "updateQuantity" :
                $updatedQuantity = getPostVar("amount");
                $priceId = getPostVar("price_id");
                if ($updatedQuantity != 0) {
                    updateCart($priceId, $updatedQuantity);
                } else {
                    removeFromCart($priceId);
                }
                break;
            case "Bestellen" :
                $user_id = getLoggedInID("id");
                $cartContent = getCart();
                if($cartContent)
                saveOrder($user_id, $cartContent);
                break;
                       
            }
    } 
    
    function saveOrder($user_id, $cartContent) {
        try{
            storeOrder($user_id, $cartContent);
            emptyCart();
        } catch (Exception $e) {
        }
    }
?>