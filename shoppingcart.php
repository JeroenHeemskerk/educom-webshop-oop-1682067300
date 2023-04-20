<?php

include 'webshop.php';

$head = 'Winkelwagentje';

function showCartHeader() {
    echo '<h2>Winkelwagentje</h2>';
}

function showCartContent() {
   
$cartContent = getCartContent();
$total = 0;
$onChange = "(this).closest('form').submit()";

$cartline['webshop'] = "updateQuantity";
if ($cartContent != NULL) {
foreach($cartContent['cartlines'] as $key=>$product) { 
    
    echo '<div class="orderedproducts">';
    echo '<table>';
        echo '<tr class="productborder"><td  class="cart">';
        echo '<a id="details_'.$product["id"].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$product["size_id"].'&material='.$product["material_id"].'&price='.$product['price_id'].'">';
            echo '<img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="cartproducts"></td></a>';
            echo '<td>Product: '.$product["name"].'<br> Uitvoering:'.$product['size_id'].'<br> Materiaal: '.$product["material"].'';
            showFormStart();
            showFormField('amount', 'Aantal:', 'number', $product, Null, 0, 99, $onChange);
            echo '<br><br> Prijs: &#8364;'.number_format((float)$product['subtotal'], 2, '.'.'').'';
            showFormField('price_id' , "", 'hidden', $product);
            showFormField('webshop', "", 'hidden', $cartline);
            // showFormButton(null, "shoppingcart");
            showFormEnd('shoppingcart');        
            echo '</td></tr>';
            echo '</table>';
            echo '</div>';
    }
    
    echo 'Totaal prijs = &#8364;'.number_format((float)$cartContent['total'], 2, '.'. '').'';
}
}

      

