<?php

    class Product {
        public $id;
        public $name;
        public $image;
        public $flavours = array();

        public function __construct()
        {

        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getFilename(){
            return $this->image;
        }

        public function getFlavours(){
            return $this->flavours;
        }
}

?>