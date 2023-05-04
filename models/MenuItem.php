<?php 
    class MenuItem {
        private $page;
        private $label;
      
        public function __construct($page, $label)
        {
          $this->page = $page;
          $this->label = $label;
        }
      
        public function showMenuOption(){
          echo "<li class='menuoption'>";
          echo "<a class='button' href='../educom-webshop-oop/index.php?page=" . $this->page . "'>" . $this->label . "</a>";
          echo "</li>";
        }
      }
?>