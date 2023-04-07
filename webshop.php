<?php
$head = 'Webshop';

function showWebshopHeader() {
    echo '<h1>Webshop</h1>';

}

function showWebshopContent($products) {
    foreach($products as $key => $value){ 
        showProduct($key, $value);
      }
}

function showProduct($key, $value){
$price_id = "";
    echo '<div class="products">';
    echo '<div class="productroster">';
    echo '<a href="index.php?page=detail&id=' . $value["id"] . '">';
    echo '<img src="Images/'. $value["image"] . '" " alt="' . $value["name"] . '" class="img">';
    echo '<h2>' . $value["name"] . '</h2>';  
    echo '</a>';
    echo '<br><label for="flavour">Keuze</label><br>' . PHP_EOL;
    echo '<select id="flavour" name="flavouroptions" >' . PHP_EOL;
    // echo '<span class="error"> ' . $data['' . $field . 'Err'] . ' </span><br>' . PHP_EOL;
    foreach($value['flavours'] as $key => $flavour) {
        echo '<option value="' .$flavour['material_id'] . $flavour['size_id'] . $flavour['price_id'] . '">
                Maat: ' . $flavour['size'] . ' Materiaal: ' . $flavour['material'] . ' Prijs: &#8364;' . $flavour['price'] . '
              </option>' . PHP_EOL; 
    }   echo '</select>' . PHP_EOL;
    
    echo '</div>';
    
} 
    // if ($price_id == "") {
    //     $price_id = $flavour['price_id'];
    // }
    //  onchange="window.location=this.value"
    // echo '<span class="error"> ' . $data['' . $field . 'Err'] . ' </span><br>' . PHP_EOL;            
    // if (getUrlVar('pid') != "") { 
    //     $price_id = getUrlVar('pid');
    // }  
    // echo '<h3>&#8364; ' . $value["flavours"][$price_id]["price"] . '</h3>';
    // ' . $flavour['size_id'] . $flavour['material_id'] . $flavour['price_id'] .'

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