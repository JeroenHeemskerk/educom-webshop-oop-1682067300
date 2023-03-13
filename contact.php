<?php
    $head = "Contact";
    
    function showContactHeader()
        {
            echo 'Contact';
        }  
    function showContactThanks($data) {//Showing a Thank you for filling in the form correctly.
          
        echo "<p>Bedankt voor uw bericht, " . $data['name'] . ".<br>
                Wij zullen spoedig contact opnemen" . $data['favcontact'] . ".<br>
                <br>
                Uw gegevens zijn als volgt:<br>
                </p>";
        echo $data['title']." ";
        echo $data['name']."<br>";
        echo $data['email']."<br>";
        echo $data['telefoon'];              
    }     
?>    