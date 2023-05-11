<?php
    require_once 'product_doc.php';

    class DetailDoc extends ProductsDoc {

        protected function showHeader(){
            echo 'Detailpagina';
        }

       


        protected function showContent() {
            $product = $this->model->product;
            if (empty($product)){
                echo "Product bestaat niet (meer)";
                return;
            }
            
            echo '<div class="productheader">
                    <h1>' . $product["name"] . '</h1>
                  </div>';
            echo '<div class=imgdetail>
                    <img src="Images/' . $product["image"] . '" alt="' . $product["name"] . '" class="detail">
                  </div>';
            echo '<div class="productprice">
                    <h2>&#8364;' . $this->model->currentFlavour["price"] . '</h2>';
            $sizeOptions = array();
            $materialOptions = array();
            foreach ($product['flavours'] as $flav)  {
                $flav_key = Util::generateKey($this->model->productId, $flav);
                if ($flav['size_id'] == $this->model->sizeId) {
                    $materialOptions[$flav_key] = "Materiaal: " . $flav["material"];
                }
                if ($flav['material_id'] == $this->model->materialId) {
                    $sizeOptions[$flav_key] = "Maat: " . $flav['size']; 
                }
            }
            $onChange="window.location=makeDetailLink(this.value)";
            $this->showFormStart('product');
            $this->showFormField('flavour', 'Maat:', 'select', $sizeOptions, null, null, $onChange);
            $this->showFormField('material', 'Materiaal', 'select', $materialOptions, null, null, $onChange);
            if (!$this->model->canOrder) {
                $this->showFormEnd("detail");
                echo '<br>';
            } else { 
                $this->showFormField('amount', 'Aantal', 'number', NULL, 1, 99, NULL);
                echo '<br>';
                $this->showFormButton('Toevoegen', 'action');
                $this->showFormEnd('detail');
                echo '<br>';   
            }
            echo '<div class="descriptionheader">';
            echo '<h3>Productomschrijving</h3>';
            echo '<div class="description">';
            echo  $product["description"];
            echo '</div>';
            echo '</div>';
            echo '<div class="properties">';
            echo '<h4>Producteigenschappen</h4>';
            echo '<ul>';
            foreach ($this->model->properties as $property) {
                echo '<li>' . $property["name"] .": " . $property['value'] . ' ' . $property['unit'] . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
?>