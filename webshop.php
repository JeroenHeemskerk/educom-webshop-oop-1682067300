<?php

$head = 'Webshop';

function showWebshopHeader() {
    echo '<h1>Webshop</h1>';

}

function showWebshopContent($data) {
    foreach($data['products'] as $key => $value){ 
        showProduct($key, $value);
      }
}

function showProduct($key, $value){
    echo '<div class="productroster">';
    echo '<a href="index.php?page=detail&id=' . $value["id"] . '">';
    echo '<img src="Images/'. $value["image"] . '" " alt="' . $value["name"] . '" class="img">';
    echo '<h2>' . $value["name"] . '</h2>';  
    echo '</a>';
    echo '<h3>&#8364; '.$value["price"].'</h3>';
    echo '</div>';

}

function showProductDetail($id) {
    $product = doesProductExist($id);
    echo '<div class="productheader">
            <h1>' . $product["name"] . '</h1>
          </div>';
    echo '<div class=imgdetail>
            <img src="Images/' . $product["image"] . '" alt="' . $product["name"] . '" class="detail">
          </div>';
    echo '<div class="productprice">
            <h2>&#8364;' . $product["price"] . '</h2>';
    echo '<div class="descriptionheader">';
    echo '<h3>Productomschrijving</h3>';
    echo '<div class="description">';
    echo  $product["description"];
    echo '</div>';
}
          


?>