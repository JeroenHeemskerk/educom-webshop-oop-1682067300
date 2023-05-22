<?php

    class Product {
        public $id;
        public $name;
        public $image;
  

        public function __construct()
        {

        }

        public function getId() {
            return $this->id;
        }
  
        public function setId($id){
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }

        public function getFilename(){
            return $this->image;
        }
}

?>