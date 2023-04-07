<?php

function connectToDB() {

$servername = "127.0.0.1";
$username = "rubens_webshop_user";
$password = "test1234";
$database = "rubens_webshop";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($servername, $username, $password, $database);    

if (!$conn) {
    throw new Exception("Can not connect to database. Error: " . mysqli_connect_error());
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
            throw new Exception("Query failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        $user = mysqli_fetch_assoc($result);
        return $user;
    }    
    finally {
        closeDB($conn);
    } 
}

function findUserByID($id) {
    $conn = connectToDB();
    $id = getLoggedInID();
    try {
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        $user = mysqli_fetch_assoc($result);
        return $user; 
    }
    finally {
        closeDB($conn);
    }
}

function updateUserPass($password) {
    $conn = connectToDB();
    
    try {
        $sql = "UPDATE `users` SET `password`= '$password' WHERE id=" . getLoggedInID() . ";";
    mysqli_query($conn, $sql);
    }
    finally {
        closeDB($conn);
    } 
}

function selectProducts() {
    $conn = connectToDB();
    $products=[];

    $sql = "SELECT id, name, image FROM products";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $products[$row['id']] = $row;
    }

    $sql2 = "SELECT pp.id price_id, ps.product_id, s.id size_id, s.size, m.id material_id, m.material, price
            FROM product_price as pp
            JOIN product_sizes as ps
            ON ps.id=pp.product_size_id
            JOIN materials as m
            ON m.id=pp.material_id
            JOIN sizes as s
            ON s.id=ps.size_id
            order by ps.product_id, m.display_order_mat, s.display_order";

    $result = mysqli_query($conn, $sql2);

    while($row = mysqli_fetch_assoc($result)) {
        $products[$row['product_id']]['flavours'][$row['price_id']] = $row;
         
        }
    
    mysqli_close($conn);
    return $products;
}

function findProductByID($id) {
    $conn = connectToDB();
    try {
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        $product = mysqli_fetch_assoc($result);
        return $product; 
    }
    finally {
        closeDB($conn);
    }
}



?>