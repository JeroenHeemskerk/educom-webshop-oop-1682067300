<?php

function showFormStart() {
    echo '<form method="post" action="index.php"';
}
function showFormField($field, $label, $type, $data, $options = array(), $rows = NULL, $cols = NULL, $onChange=NULL) {

  echo '<br><label for="' . $field . '">' . $label . ' </label><br>' . PHP_EOL;
        if ($type == "select"){
            echo '<' . $type . ' id="' . $field . '" name="' . $field . '" ' . (empty($onChange) ? '' : 'onchange="' . $onChange . '"'). '>' . PHP_EOL;
            showError($field, $data);
            foreach($options as $key => $title) {
                echo '<option value="' . $key .'"'; if (isset($data[$field]) && $data[$field] == "$key") echo "selected"; echo'>' . $title . '</option>' . PHP_EOL;
            }   echo '</select>' . PHP_EOL;            
        }   
        
        else if ($type == "radio") {
            showError($field, $data);
            foreach ($options as $key => $contactoptions) {
            echo  '<input type="radio" id="' . $field . $key . '" name="' . $field . '"'; if (isset($data[$field]) && $data[$field] == "$key") echo "checked"; echo' value="' . $key . '" > 
                    <label for="' . $field . $key . '">' . $contactoptions . '</label><br>';
            }
        } 
        
        else if ($type == "textarea") {
            showError($field, $data);
            echo '<textarea name ="' . $field . '" rows="' . $rows . '" cols="' . $cols . '">' . $data[$field] . '</textarea><br><br>';
            
        } else {
            echo '<input type="' . $type . '"id="' . $field . '" name="' . $field . '" value="' . $data[$field] . '"><br>' . PHP_EOL;
            showError($field, $data);
        }
}

function showError($field, $data) {
    if (array_key_exists($field."Err", $data)) {
        echo '<span class="error"> ' . $data['' . $field . 'Err'] . ' </span><br>' . PHP_EOL;
    }
}

function showFormEnd($submitButton, $page) {
    echo '<br>
          <input name="page" value="' . $page . '" type="hidden">';
    echo '<input type="submit" name="' . $page . '" value="' . $submitButton . '">';
    echo '</form>';
}

function showRegisterForm($data) { /* register form */

    showFormStart();
    showFormField('email', 'E-mail:', 'email', $data);
    showFormField('name', 'Naam:' , 'text', $data);
    showFormField('password', 'Wachtwoord:', 'password', $data);
    showFormField('repeatpassword', 'Herhaal Wachtwoord', 'password', $data);
    showFormEnd('Registreren', 'register');
}

define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail')); 

function showContactForm($data) { /* contact form */

    showFormStart();
    showFormField('title', 'Aanhef', 'select', $data, TITLE_OPTIONS);
    showFormField('name', 'Naam:', 'text', $data);
    showFormField('email', 'E-mail:', 'email', $data);
    showFormField('telefoon', 'Telefoonnummer', 'text', $data);
    showFormField('favcontact', 'Hoe wilt u gecontacteerd worden?', 'radio', $data, CONTACT_OPTIONS);
    showFormField('comment', 'Beschrijf in het kort de reden van contact:', 'textarea', $data);
    showFormEnd('Versturen' , 'contact');
}

function showLoginForm($data) {
    showFormStart();
    showFormField('email', 'E-mail', 'text', $data);
    showFormField('password', 'Wachtwoord', 'password', $data);
    showFormEnd('Login', 'login');
}

function showChangePassForm($data) {
    showFormStart();
    showFormField('password', 'Huidig wachtwoord:', 'password', $data);
    showFormField('newpassword', 'Nieuw wachtwoord:', 'password', $data);
    showFormField('repeatnewpassword', 'Herhaal uw nieuwe wachtwoord:', 'password', $data);
    showFormEnd('Veranderen', 'changepass');
} 

?>