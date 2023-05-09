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
    require_once 'sessions.php';
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

function getLoggedInID() {
    return $_SESSION['user_id'];
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

function findProductByIdSizeAndMaterial($productId, $sizeId, $materialId) {
    $conn = connectToDB();
    try {
        $productId = mysqli_real_escape_string($conn, $productId);
        $sizeId = mysqli_real_escape_string($conn, $sizeId);
        $materialId = mysqli_real_escape_string($conn, $materialId);

        // 1. get the product details
        $sql = "SELECT * FROM products WHERE id=$productId";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query 1 failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        $product = mysqli_fetch_assoc($result);

        // 2. get all flavours for this product
        $sql = "SELECT pp.id as 'price_id', s.id as 'size_id', s.size, m.id as 'material_id', m.material, price
                FROM product_price as pp
                JOIN product_sizes as ps ON ps.id=pp.product_size_id
                JOIN materials as m ON m.id=pp.material_id
                JOIN sizes as s on s.id=ps.size_id 
                WHERE ps.product_id = $productId";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query 2 failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $product['flavours'][$row['price_id']] = $row;
        }
        // 3. get all properties of the give size (and material)
        $sql = "SELECT pp.id as 'pp_id', p.name, pp.value, p.unit
                FROM product_properties as pp
                JOIN properties as p ON p.id=pp.property_id
                JOIN product_sizes as ps ON ps.id=pp.product_size_id
                LEFT JOIN product_price ON pp.product_price_id=product_price.id
                WHERE ps.product_id=$productId AND ps.size_id='$sizeId' AND 
                      (pp.product_price_id is NULL or product_price.material_id = $materialId)";
                
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query 3 failed, SQL: " . $sql . " Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $product['properties'][$row['pp_id']] = $row;
        }
        return $product; 
    }
    finally {
        closeDB($conn);
    }
}

function fetchProductByPrizeId($priceIds) {
    $conn = connectToDB();
    $products= array();
    $commaSeperatedList = implode(',', $priceIds);

    $sql = "SELECT p.id as 'id', p.name, p.image,s.id as 'size_id', s.size, m.id as 'material_id', m.material, pp.price
            FROM product_price as pp
            JOIN product_sizes as ps ON ps.id=pp.product_size_id
            JOIN materials as m ON m.id=pp.material_id
            JOIN products as p ON p.id=ps.product_id
            JOIN sizes as s ON s.id=ps.size_id
            WHERE pp.id IN ($commaSeperatedList)";

    $result = mysqli_query($conn, $sql);
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $products[$priceIds[$counter]] = $row;
        $counter++;
    }
    return $products;
    closeDB($conn);
}

function storeOrder($user_id, $cartContent) {
    $conn = connectToDB();
    
    try {
        $sql = "INSERT INTO invoice (date, user_id) VALUE(CURRENT_DATE(),'$user_id')";
        $result = mysqli_query($conn, $sql);
        if(!$result){
        throw new Exception("storeOrder failed, sql: " . $sql . ", error: " . mysqli_error($conn));
        }

        $last_id = mysqli_insert_id($conn);
        foreach($cartContent as $key=>$value){
        $sql = "INSERT INTO invoice_row (invoice_id, product_price_id, amount) VALUES($last_id, $key, $value)";
        mysqli_query($conn, $sql);
        }

    } finally {
  closeDB($conn);  
  }
}

function retrieveOrderHistoryByUserId($user_id) {

    $sql = "SELECT invoice.id, invoice.date, sum(product_price.price* 100 * amount) / 100 as 'total', COUNT(invoice_row.id) as 'nrOfProducts', SUM(invoice_row.amount) AS 'nrOfFigurines'
            FROM `invoice_row` 
            JOIN `invoice` ON invoice.id=invoice_row.invoice_id
            JOIN `product_price` ON product_price.id = invoice_row.product_price_id

            WHERE invoice.user_id = $user_id
            GROUP BY invoice.id";
}


function readInvoiceDataByInvoiceId($invoiceId) {
    $sql = "SELECT invoice_row.id, amount, invoice.user_id, invoice.date, product_price.price, materials.material, sizes.size, products.name
            FROM `invoice_row` 
            JOIN `invoice` ON invoice.id=invoice_row.invoice_id
            JOIN `product_price` ON product_price.id = invoice_row.product_price_id
            JOIN `materials` ON materials.id = product_price.material_id
            JOIN `product_sizes` ON product_sizes.id = product_price.product_size_id
            JOIN `sizes` ON sizes.id = product_sizes.size_id
            JOIN `products` ON products.id = product_sizes.product_id
            WHERE invoice.id=$invoiceId";
}
?>