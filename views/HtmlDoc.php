<?php

class showHtmlDoc {
    private function showHtmlStart(){
        echo '<!DOC type="html">';
        echo '<html lang="NL">';
    }
    
    private function showHeadStart(){
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">'; 
    }

    private function showHeadContent(){

    }
    
    private function showHeadEnd(){
        echo '</head>';
    }

    private function showBodyStart(){
        echo '<body>';
    }
    
    private function showBodyContent(){

    }

    private function showBodyEnd(){
        echo '</body>';
    }

    private function showHtmlEnd(){
        echo '</html>'; 
    }

    public function show(){
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