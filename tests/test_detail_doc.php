<?php
include_once "../views/detail_doc.php";
$id = '1';
$size = 'S';
$material = '1';
$priceId = '22';

$product = array('id' => '1', 'name' => 'Elf', 'image' => 'elf.png', 'flavours' => [ 22 => ['size_id' => 'S', 'material_id' => '1', 'price_id' => '22', 'size' => 'small', 'price' => '9,99', 'material' => 'Hars'],26 => ['size_id' => 'M', 'material_id' => '1', 'price_id' => '25', 'size' => 'medium', 'material' => 'Koper', 'price' => '19,95']]);
$data = array('page' => 'webshop', 'product' => $product, 'menu' => []);

$view = new DetailDoc($data);
$view->show();