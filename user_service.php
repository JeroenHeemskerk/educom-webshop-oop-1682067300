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
        $action = getPostVar("webshop");
        if ($action == "Toevoegen") {
            if (!isUserLoggedIn()) {
            echo '<script>alert("FOUT: Om te bestellen moet u eerst inloggen")</script>';
            } else {
                $priceId = getPostVar("flavour");
                $priceId = explode("_", $priceId);
                $amount = getPostVar("quantity");
                if ($amount > 0) {
                    updateCart($priceId[3], $amount);
                }
            }
        }
    }
?>