<?php
include_once 'product_doc.php';

class CartDoc extends ProductsDoc {
    protected function showHeader() {
        echo '<h2>Winkelwagentje</h2>';
    }
    
    protected function showContent() {  
        $cartContent = $this->model->getCartContent();
        $onChange = "(this).form.submit()";
        $cartline['action'] = "updateQuantity";
        // $cartline = array();
        if ($cartContent != NULL) {
            foreach($cartContent['cartlines'] as $cartline=>$product) { 
                echo '<div class="orderedproducts">';
                echo '<table>';
                    echo '<tr class="productborder"><td  class="cart">';
                    echo '<a id="details_'.$product["id"].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$product["size_id"].'&material='.$product["material_id"].'&price='.$product['price_id'].'">';
                        echo '<img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="cartproducts"></td></a>';
                        echo '<td>Product: '.$product["name"].'<br> Maat:'.$product['size_id'].'<br> Materiaal: '.$product["material"].'';
                        $this->showFormStart('cartcontent');
                        $this->showFormFieldNumber('amount', 'Aantal:', $product['amount'], 0, 99, $onChange);
                        echo '<br><br> Prijs: &#8364;'.number_format((float)$product['subtotal'], 2, '.'.'').'';
                        $this->showHiddenFormButton('price_id', $product['price_id']);
                        $this->showHiddenFormButton('action', 'updateQuantity');
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