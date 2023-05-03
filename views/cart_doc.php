<?php
include_once 'product_doc.php';

class CartDoc extends ProductsDoc {
    protected function showHeader() {
        echo '<h2>Winkelwagentje</h2>';
    }
    
    protected function showContent() {  
        $cartContent = getCartContent();
        $onChange = "(this).closest('form').submit()";
        
        $cartline['action'] = "updateQuantity";
        if ($cartContent != NULL) {
            foreach($cartContent['cartlines'] as $key=>$product) { 
                
                echo '<div class="orderedproducts">';
                echo '<table>';
                    echo '<tr class="productborder"><td  class="cart">';
                    echo '<a id="details_'.$product["id"].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$product["size_id"].'&material='.$product["material_id"].'&price='.$product['price_id'].'">';
                        echo '<img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="cartproducts"></td></a>';
                        echo '<td>Product: '.$product["name"].'<br> Uitvoering:'.$product['size_id'].'<br> Materiaal: '.$product["material"].'';
                        $this->showFormStart('cartcontent');
                        $this->showFormField('amount', 'Aantal:', 'number', $product, Null, 0, 99, $onChange);
                        echo '<br><br> Prijs: &#8364;'.number_format((float)$product['subtotal'], 2, '.'.'').'';
                        $this->showFormField('price_id' , "", 'hidden', $product);
                        $this->showFormField('action', "", 'hidden', $cartline);
                        $this->showFormEnd('shoppingcart');        
                        echo '</td></tr>';
                        echo '</table>';
                        echo '</div>';
                }
            echo 'Totaal prijs = &#8364;'.number_format((float)$cartContent['total'], 2, '.'. '').'';
            $this->showFormStart('orderbutton');
            $this->showFormButton('Bestellen', 'action');
            $this->showFormEnd('webshop');
        }
    }
}
?>