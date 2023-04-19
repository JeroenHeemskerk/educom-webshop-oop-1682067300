<?php

include 'webshop.php';

$head = 'Winkelwagentje';

function showCartHeader() {
    echo '<h2>Winkelwagentje</h2>';
}

function showCartContent() {
   
$cartContent = getCartContent();
var_dump($cartContent);
$total = 0;
$onChange = "this.parent.submit()";
$cartline['action'] = "updateQuantity";

foreach($cartContent as $priceId=>$amount) {
    $product = fetchProductByPrizeId();
    $totalproductprice = $amount * $product["price"]; 
    $total += $totalproductprice;
    echo '<div class="orderedproducts">
                <table>';
        echo '<a id="details_'.$product["id"].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$product["size_id"].'&material='.$product["material_id"].'&price='.$priceId[3].'">';
        echo '<tr><td><img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="cartproducts"></td>';
        echo '<td>Product: '.$product["name"].'<br> Uitvoering:'.$product['size_id'].'<br> Materiaal: '.$product["material"].'';
        showFormStart();
        showFormField('amount', 'Aantal:', 'number', $cartline, NULL, NULL, NULL, $onChange);
        showFormField('price_id' , "", 'hidden', $cartline);
        showFormField('webshop', "", 'hidden', $cartline);
        showFormButton(null, 'shoppingcart');        
        echo '<br> Aantal: '.$amount.'<br> Prijs: &#8364;'.$totalproductprice.'</td></tr>';
        echo '</table></a>';
        echo '</div>';
    }
    
    echo '<div class="totalprice">';
    echo 'Totaal prijs = &#8364;'.number_format((float)$total, 2, '.'. '').'';

}
      

