<?php 

    require_once 'html_doc.php';

    class BasicDoc extends HtmlDoc {
        protected $model;

        public function __construct($pageModel) {
            $this->model = $pageModel;
        }
        
        private function showTitle() {
            echo '<title>'. ucfirst($this->model->page).'</title>';
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
            foreach($this->model->menu as $menuOption)    {
                $menuOption->showMenuOption();
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
        
        protected function showJs() {
        }

        protected function showHeadContent() {
            $this->showJs();
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