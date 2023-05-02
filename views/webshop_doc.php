<?php
require_once 'product_doc.php';


class WebshopDoc extends ProductsDoc {
    protected function showHeader() {
        echo 'Webshop';
    }

    protected function showProduct($product) {
        $price_id = key($product['flavours']);
        $flavour = $product['flavours'][$price_id];
        echo '<a id="details_'.$product['id'].'" href="index.php?page=detail&id=' . $product["id"] . '&size='.$flavour['size_id'].'&material='.$flavour['material_id'].'&price='.$flavour['price_id'].'">';
        echo '<h2 id="producttitle">' . $product["name"] . '</h2>';  
        echo '<img src="Images/'. $product["image"] . '" " alt="' . $product["name"] . '" class="img">';
        echo '</a>';
    }

    protected function showContent() {
        $onChange = "changeDetailLink(this.value)";
  
        foreach($this->data["products"] as $product) {
            $this->showProduct($product);
            $options = array();
            foreach($product['flavours'] as $key => $flavour) {
                $options[$this->generateKey($product['id'], $flavour)] = 'Maat: ' . $flavour['size'] . ', Materiaal: ' . $flavour['material'] . ', Prijs: &#8364;' . $flavour['price'];
            }
            $this->showFormStart('product');
            $this->showFormField('flavour', 'Keuze', 'select', $product, $options, null, null, $onChange);
            $data['amount'] = 1;
            $this->showFormField('amount', 'Aantal', 'number', $data , $options, 1, 99, null);
            echo '<br>';
            $this->showFormButton('Toevoegen', 'action');
            echo '<br>';  
            $this->showFormEnd('webshop');
        }
    }
}