<?php 

    require_once 'html_doc.php';

    class BasicDoc extends HtmlDoc {
        protected $data;

        public function __construct($data) {
            $this->data = $data;
        }
        
        private function showTitle() {
            echo '<title>Basic</title>';
        }

        protected function showHeaderStart() {
            echo '<header><h1>';
        }

        protected function showHeader() {
            echo 'Basic';
        }
        private function showHeaderEnd() {
            echo '</h1></header>';
        }

        private function showMenu() { 
                
            echo    '<ul id="menu">';
            
            foreach($this->data['menu'] as $key => $MenuOptions) {
                echo '<li class="menuoption"><a href="index.php?page=' . $key . '" class="button">' . $MenuOptions. '</a></li>';
            } 
            echo '</ul>';
        }

        private function showContentStart() {
            echo '<div class="content" style="max-width: 800px;">';
        }

        protected function showContent() {
            echo 'hello world!';
        }

        private function showContentEnd() {
            echo '</div>';
        }
        
        private function showFooter() {
            echo '<footer class="footerstyle">';
            echo '<p class="footertext" style="text-align:right;">&#169; 2023 Ruben van der Zouw</p>';
            echo '</footer>';
        }

        protected function showHeadContent() {
            $this->showTitle();
        }

        protected function showBodyContent() {
            $this->showHeaderStart();
            $this->showHeader();
            $this->showHeaderEnd();
            $this->showMenu();
            $this->showContentStart();
            $this->showContent();
            $this->showContentEnd();
            $this->showFooter();
        
        }
    }
?>