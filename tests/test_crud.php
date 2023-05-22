<?php

include_once('../crud/Crud.php');
$crud = new Crud();
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
try {
    $result = $crud->readMultipleRows($sql, $params);
    
}
catch (PDOException $e) {
    echo "test failed: " . $e->getMessage();
}

?>