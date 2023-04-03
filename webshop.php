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
    echo "<a href='index.php?page=detail&id=" . $value['id'] . "'>";
    echo "<h2>" . $value['name'] . "</h2>";  
    echo "<img src='Images/". $value['image']. " ' alt='".$value['name']."' class='img-fluid'>";
    echo "</a>";
    echo "<h3>&#8364; ".$value['price']."</h3>";

}

?>