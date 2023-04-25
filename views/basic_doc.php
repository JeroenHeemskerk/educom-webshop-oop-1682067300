<?php 

    require_once 'html_doc.php';

    class BasicDoc extends HtmlDoc {
        // protected $model;

        // public function __construct($pageModel) {
        //     $this->model = $pageModel;
        // }
        
        private function showTitle() {
            echo '<title>Basic</title>';
        }

        private function showHeader() {
            echo '<header></header>';
        }

        private function showContentStart() {
            echo '<div class="content" style="max-width: 800px;">';
        }

        protected function showContent() {
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
            $this->showHeader();
            $this->showContentStart();
            $this->showContent();
            $this->showContentEnd();
            $this->showFooter();
        
        }
    }
?>