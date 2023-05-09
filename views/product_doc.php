<?php

require_once 'forms_doc.php';

abstract class ProductsDoc extends FormsDoc {

    protected function showJs() {
        echo '<script src="Scripts/website.js"></script>';
    }
}
?>