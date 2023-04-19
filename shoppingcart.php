<?php

include 'webshop.php';

$head = 'Winkelwagentje';

function showCartHeader() {
    echo '<h2>Winkelwagentje</h2>';
}

function showCartContent() {
   
$cartContent = getCartContent();
$total = 0;
$onChange = "this.parent.submit()";
$cartline['webshop'] = "updateQuantity";

foreach($cartContent['cartlines'] as $key=>$product) { 
   
    echo '<div class="orderedproducts">';
        echo '<a id="details_'.$product["id"].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$product["size_id"].'&material='.$product["material_id"].'&price='.$product['price_id'].'">';
        echo '<img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="cartproducts">';
        echo 'Product: '.$product["name"].'<br> Uitvoering:'.$product['size_id'].'<br> Materiaal: '.$product["material"].'</a>';
        showFormStart();
        showFormField('amount', 'Aantal:', 'number', $product, Null, 1, 99, $onChange);
        showFormField('price_id' , "", 'hidden', $product);
        showFormField('webshop', "", 'hidden', $cartline);
        showFormEnd();        
        echo '<br> Aantal: '.$product['amount'].'<br> Prijs: &#8364;'.$product['subtotal'].'';
        echo '</div>';
    }
    
    echo '<div class="totalprice">';
    echo 'Totaal prijs = &#8364;'.number_format((float)$total, 2, '.'. '').'';

}
      

