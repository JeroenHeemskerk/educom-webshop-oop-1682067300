<?php

require_once 'forms_doc.php';

abstract class ProductsDoc extends FormsDoc {
    protected function generateKey($productId, $sizeId, $materialId =0, $priceId =0) {
        if (is_array($sizeId)) {
            return $productId . "_" . $sizeId['size_id'] . "_" . $sizeId['material_id'] . "_" . $sizeId['price_id'];   
        }
        return $productId . "_" . $sizeId . "_" . $materialId . "_" . $priceId;
    }

    protected function showJs() {
        echo '<script src="Scripts/website.js"></script>';
    }
}
?>