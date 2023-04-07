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
    $product_id = "";
    $product_size = "";
    $product_material = "";
    /*
    $properties_array = array('name' => "", 'value' => "", 'unit' => "");
    $matterial_array = array('price' => "", 'properties' => $properties_array );
    $size_array = array('Hars' => $matterial_array);

    $products2 = array('id' => "", 'name' => "", 'description' => "",
                     'sizes' => array($size_array));
    */


    $products = array('id' => "", 'name' => "", 'description' => "",
                     'sizes' => ['S' =>['Hars' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]],
                                        'Koper' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]]],
                                 'M' =>['Hars' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]],
                                        'Koper' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]]]]);

    $conn = connectToDB();
    $sql = "SELECT p.id as 'product_id', p.name, p.description, p.image, s.id as 'size_id', s.size as 'size', m.id as 'material_id', m.material, pp.price
            FROM product_price as pp
            JOIN product_sizes as ps ON pp.product_size_id = ps.id
            JOIN products as p ON ps.product_id = p.id
            JOIN sizes as s on ps.size_id = s.id
            JOIN materials as m on pp.material_id = m.id
            order by p.id, m.id, s.display_order, m.display_order_mat";

    $result = mysqli_query($conn, $sql); 

    while($row = $result->fetch_assoc()) {
        if ($product_id != $row['product_id']) {
        $products['id'] = $row['product_id']
         
        // array('id' => $row['product_id'], 'name' => $row['name'], 'description' => $row['description'],
        // 'sizes' => [$row['size_id'] =>['Hars' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]],
        //                    'Koper' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]]],
        //             'M' =>['Hars' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]],
        //                    'Koper' => ['price' => "", 'properties' => ['name' => "", 'value' => "", 'unit' => ""]]]]);
        }
    }
    
    mysqli_close($conn);
    return $data['products'];
}

function findProductByID($id) {
    $conn = connectToDB();
    $id = getUrlVar('id');
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