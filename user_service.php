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
        $data = selectProducts();
        return $data;
    }

    function doesProductExist($productId, $sizeId, $materialId) {
        $product = findProductByIdSizeAndMaterial($productId, $sizeId, $materialId);
        if (empty($product)) {
            return false;
        } else {
            return $product;
        }
    }
?>