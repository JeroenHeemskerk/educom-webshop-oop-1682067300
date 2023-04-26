<?php

class HtmlDoc {
    private function showHtmlStart(){
        echo '<!DOCTYPE html>';
        echo '<html lang="NL">';
    }
    
    private function showHeadStart(){
        echo '<head>';
        echo '<link rel="stylesheet" href="css/mystyle.css">';
        echo '<meta charset="UTF-8">';
    }

    private function showHeadContent(){

    }
    
    private function showHeadEnd(){
        echo '</head>';
    }

    private function showBodyStart(){
        echo '<body>';
    }
    
    protected function showBodyContent() {
        
    }

    private function showBodyEnd(){
        echo '</body>';
    }

    private function showHtmlEnd(){
        echo '</html>'; 
    }

    public function show() {
        $this->showHtmlStart();
        $this->showHeadStart();
        $this->showHeadContent();
        $this->showHeadEnd();
        $this->showBodyStart();
        $this->showBodyContent();
        $this->showBodyEnd();
        $this->showHtmlEnd();
    }
}
?>