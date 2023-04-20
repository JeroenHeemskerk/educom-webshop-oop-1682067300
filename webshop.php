<?php
require_once 'forms.php';
$head = 'Webshop';

function showWebshopHeader() {
    echo '<h1>Webshop</h1>';

}

function showWebshopContent($data) {
    $onChange = "changeDetailLink(this.value)";
    foreach($data['products'] as $key => $value) { 
        showProduct($key, $value);
        $options = array();
        foreach($value['flavours'] as $key => $flavour) {
            $options[generateKey($value['id'], $flavour)] = 'Maat: ' . $flavour['size'] . ', Materiaal: ' . $flavour['material'] . ', Prijs: &#8364;' . $flavour['price'];
        }
        showFormStart();
        showFormField('flavour', 'Keuze', 'select', $value, $options, null, null, $onChange);
        echo '<br>';
        if (!isUserLoggedIn($_SESSION)) {
            echo '</form><br>';
        } else { 
            $data['amount'] = 1;
            showFormField('amount', 'Aantal', 'number', $data , $options, 1, 99, null);
            echo '<br>';
            showFormButton("Toevoegen", "webshop");
            echo '<br>';  
            showFormEnd("webshop");
        }
    }
}

function showProduct($key, $value){
    $price_id = key($value['flavours']);
    $flavour = $value['flavours'][$price_id];
    echo '<div class="products">';
    echo '<div class="productroster">';
    echo '<a id="details_'.$value['id'].'" href="index.php?page=detail&id=' . $value["id"] . '&size='.$flavour['size_id'].'&material='.$flavour['material_id'].'&price='.$price_id.'">';
    echo '<table><tr>';
    echo '<td><img src="Images/'. $value["image"] . '" " alt="' . $value["name"] . '" class="img"></td></tr>';
    echo '<h2>' . $value["name"] . '</h2>';  
    echo '</table></a>';    
    echo '</div>';
    
} 

function showProductDetail($id, $size, $material, $priceId) {
    $options = array();
    $flavour["price"] = 0;
    $product = doesProductExist($id, $size, $material);
    $product['amount'] = 1;
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
    showFormStart();
    showFormField('flavour', 'Maat:', 'select', $product, $sizeOptions, null, null, $onChange);
    showFormField('material', 'Materiaal', 'select', $product, $materialOptions, null, null, $onChange);
    if (!isUserLoggedIn($_SESSION)) {
        showFormEnd("detail");
        echo '<br>';
    } else { 
        echo '<br>';
        showFormField('amount', 'Aantal', 'number', $product , $options , 1, 99, NULL);
        echo '<br>';
        showFormButton("Toevoegen", "detail");
        showFormEnd("detail");
        echo '<br>';  
    }
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