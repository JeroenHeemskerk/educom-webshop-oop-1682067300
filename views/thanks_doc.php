<?php
require_once 'contact_doc.php';

class ThanksDoc extends ContactDoc {
    protected function showHeader() { 
        echo '<h1>Contact</h1>';
    }

    protected function showContent() {//Showing a Thank you for filling in the form correctly.
          
        echo "<p>Bedankt voor uw bericht, " . $this->model->name . ".<br>
                Wij zullen spoedig contact opnemen per " . $this->model->favcontact . ".<br>
                <br>
                Uw gegevens zijn als volgt:<br>
                </p>";
        echo $this->model->title." ";
        echo $this->model->name ."<br>";
        echo $this->model->email ."<br>";
        echo $this->model->telefoon;              
    } 
}