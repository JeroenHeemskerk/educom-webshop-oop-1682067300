<?php

require 'product.php';

class ShopCrud {
    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function readAllProducts() {
        $sql = "SELECT * FROM products";
        $params = array();
        return $this->crud->readMultipleRows($sql, $params, 'product');
    }

}

?>