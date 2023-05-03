<?php
require_once 'contact_doc.php';

class ThanksDoc extends ContactDoc {
    protected function showHeader() { 
        echo '<h1>Contact</h1>';
    }

    protected function showContent() {//Showing a Thank you for filling in the form correctly.
          
        echo "<p>Bedankt voor uw bericht, " . $this->data['name'] . ".<br>
                Wij zullen spoedig contact opnemen per " . $this->data['favcontact'] . ".<br>
                <br>
                Uw gegevens zijn als volgt:<br>
                </p>";
        echo $this->data['title']." ";
        echo $this->data['name']."<br>";
        echo $this->data['email']."<br>";
        echo $this->data['telefoon'];              
    } 
}