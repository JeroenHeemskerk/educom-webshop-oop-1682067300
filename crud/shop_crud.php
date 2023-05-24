<?php

require 'product.php';

class ShopCrud {
    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function readAllProducts() {
        $sql = "SELECT id, name, image FROM products";
        $params = array();
        $products = $this->crud->readMultipleRows($sql, $params, 'id', 'product');

        $sql = "SELECT pp.id as price_id, ps.product_id, s.id size_id, s.size, m.id material_id, m.material, price
                FROM product_price as pp
                JOIN product_sizes as ps
                ON ps.id=pp.product_size_id
                JOIN materials as m
                ON m.id=pp.material_id
                JOIN sizes as s
                ON s.id=ps.size_id
                order by ps.product_id, m.display_order_mat, s.display_order";
    
        $flavours =  $this->crud->readMultipleRows($sql, $params, 'price_id');
        foreach($flavours as $flavour) {
            $products[$flavour->product_id]->flavours[$flavour->price_id] = $flavour;
        }

        return $products;
    }

    public function findProductbyId($productId) {
        // 1. get the product details
        $sql = "SELECT * FROM products WHERE id=$productId";
        $params = array();
        $product = $this->crud->readOneRow($sql, $params, 'product');

        // 2. get all flavours for this product
        $sql = "SELECT pp.id as 'price_id', s.id as 'size_id', s.size, m.id as 'material_id', m.material, price
                FROM product_price as pp
                JOIN product_sizes as ps ON ps.id=pp.product_size_id
                JOIN materials as m ON m.id=pp.material_id
                JOIN sizes as s on s.id=ps.size_id 
                WHERE ps.product_id = $productId";
        
        $flavours = $this->crud->readMultipleRows($sql, $params, 'price_id');
        foreach($flavours as $flavour) {
            $product->flavours[$flavour->price_id] = $flavour;
        }
        return $product;
    }
    
    public function findPropertiesByPriceId($priceId) {
    $properties = array();
    $params = array();

        // 3. get all properties of the give size (and material)
    $sql = "SELECT pp.id as 'pp_id', p.name, pp.value, p.unit
    FROM product_properties as pp
    JOIN properties as p ON p.id=pp.property_id
    JOIN product_sizes as ps ON ps.id=pp.product_size_id
    JOIN product_price ON ps.id=product_price.product_size_id
    WHERE product_price.id=$priceId AND (pp.product_price_id is null OR pp.product_price_id = product_price.id);";
    
    $properties = $this->crud->readMultipleRows($sql, $params);
       
    return $properties; 
    }

    public function readProductsByPriceId($priceIds) {
        $products= array();
        $params = array();
        $returnproducts = array();
        $counter = 0;
        $commaSeperatedList = implode(',', $priceIds);

        $sql = "SELECT p.id as 'id', p.name, p.image,s.id as 'size_id', s.size, m.id as 'material_id', m.material, pp.price
            FROM product_price as pp
            JOIN product_sizes as ps ON ps.id=pp.product_size_id
            JOIN materials as m ON m.id=pp.material_id
            JOIN products as p ON p.id=ps.product_id
            JOIN sizes as s ON s.id=ps.size_id
            WHERE pp.id IN ($commaSeperatedList)";

        $products = $this->crud->readMultipleRows($sql, $params, null, 'product');
        foreach($products as $product) {
            $returnproducts[$priceIds[$counter]] = $product;
            $counter++;
        }
        return $returnproducts;
    }

    public function createOrder($user_id, $cartContent){
        try {
            $this->crud->pdo->beginTransaction();
    
            $sql = "INSERT INTO invoice (date, user_id) VALUE(CURRENT_DATE(), :id)";
            $params = array(':id'=>$user_id);
    
            $last_id = $this->crud->createRow($sql, $params);
    
            foreach($cartContent as $priceId=>$amount){
                $sql = "INSERT INTO invoice_row (invoice_id, product_price_id, amount) VALUES(:last_id, :product_price_id, :amount)";
                $params = array(':last_id'=>$last_id , ':product_price_id'=>$priceId, ':amount'=>$amount);
                $this->crud->createRow($sql, $params);
            }
            $this->crud->pdo->commit();
    
        } catch(PDOException $e) {
            $this->crud->pdo->rollBack();
            throw $e;
        }
    

    }
}

?>