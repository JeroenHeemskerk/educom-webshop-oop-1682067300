<?php
require_once 'forms.php';
$head = 'Webshop';

function showWebshopHeader() {
    echo '<h1>Webshop</h1>';

}

function showWebshopContent($products) {
    foreach($products['products'] as $key => $value) { 
        showProduct($key, $value);
    }
}

function showProduct($key, $value){
    $price_id = key($value['flavours']);
    $flavour = $value['flavours'][$price_id];
    echo '<div class="products">';
    echo '<div class="productroster">';
    echo '<a id="details_'.$value['id'].'" href="index.php?page=detail&id=' . $value["id"] . '&size='.$flavour['size_id'].'&material='.$flavour['material_id'].'&price='.$price_id.'">';
    echo '<img src="Images/'. $value["image"] . '" " alt="' . $value["name"] . '" class="img">';
    echo '<h2>' . $value["name"] . '</h2>';  
    echo '</a>';
    $options = array();
    foreach($value['flavours'] as $key => $flavour) {
        $options[generateKey($value['id'], $flavour)] = 'Maat: ' . $flavour['size'] . ', Materiaal: ' . $flavour['material'] . ', Prijs: &#8364;' . $flavour['price'];
    }
    showFormStart();
    showFormField('flavour', 'Keuze', 'select', $value, $options, null, null, "changeDetailLink(this.value)");
    showFormField('quantity', 'Aantal', 'number', '' , $options , 1, 99);
    showFormEnd("Toevoegen", "webshop");    
    echo '</div>';
    
} 

function showProductDetail($id, $size, $material, $priceId) {
    $product = doesProductExist($id, $size, $material);
    if (!$product){
        echo "Product bestaat niet (meer)";
        return;
    }
    $flavour = null;
    if (array_key_exists($priceId, $product['flavours'])) {
        $flavour = $product['flavours'][$priceId];
        if ($flavour['size_id'] != $size || $flavour['material_id']!=$material) {
            $flavour=null;
        }
    } 
    if (empty($flavour)) {
        foreach ($product['flavours'] as $flav)  {
            if ($flav['size_id'] == $size && $flav['material_id']==$material) {
                $flavour = $flav;
                break;
            }
        }
    }
    if (empty($flavour)) {
        $price_id = key($product['flavours']);
        $flavour = $product['flavours'][$price_id];
    }
    $product['size']=$product['material']=generateKey($id, $flavour);
    echo '<div class="productheader">
            <h1>' . $product["name"] . '</h1>
          </div>';
    echo '<div class=imgdetail>
            <img src="Images/' . $product["image"] . '" alt="' . $product["name"] . '" class="detail">
          </div>';
    echo '<div class="productprice">
            <h2>&#8364;' . $flavour["price"] . '</h2>';
    $sizeOptions = array();
    $materialOptions = array();
    foreach ($product['flavours'] as $flav)  {
        $flav_key = generateKey($id, $flav);
        if ($flav['size_id'] == $size) {
            $materialOptions[$flav_key] = "Materiaal: " . $flav["material"];
        }
        if ($flav['material_id'] == $material) {
            $sizeOptions[$flav_key] = "Maat: " . $flav['size']; 
        }
    }
    $onChange="window.location=makeDetailLink(this.value)";
    showFormField('size', 'Maat:', 'select', $product, $sizeOptions, null, null, $onChange);
    showFormField('material', 'Materiaal', 'select', $product, $materialOptions, null, null, $onChange);
    echo '<div class="descriptionheader">';
    echo '<h3>Productomschrijving</h3>';
    echo '<div class="description">';
    echo  $product["description"];
    echo '</div>';
    echo '<div class="properties">';
    echo '<h4>Producteigenschappen</h4>';
    echo '<ul>';
    foreach ($product['properties'] as $properties) {
        echo '<li>' . $properties["name"] .": " . $properties['value'] . ' ' . $properties['unit'] . '</li>';
    }

}
          


?>