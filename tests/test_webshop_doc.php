<?php
include_once "../views/webshop_doc.php";

$product1 = array('id' => '1', 'name' => 'Elf', 'image' => 'elf.png', 'flavours' => [ 22 => ['size_id' => 'S', 'material_id' => '1', 'price_id' => '22', 'size' => 'small', 'price' => '9,99', 'material' => 'Hars'],26 => ['size_id' => 'M', 'material_id' => '1', 'price_id' => '25', 'size' => 'medium', 'material' => 'Koper', 'price' => '19,95']]);
$product2 = array('id' => '2', 'name' => 'Dwerg', 'image' => 'dwerg.png', 'flavours' => [ 26 => ['size_id' => 'M', 'material_id' => '1', 'price_id' => '26', 'size' => 'medium', 'material' => 'Koper', 'price' => '19,95']]);
$products = array(1 => $product1, 2 => $product2);
$data = array('page' => 'webshop', 'products' => $products, 'menu' => []);

$view = new WebshopDoc($data);
$view->show();
?>