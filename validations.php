<?php

 function validateRegister() /* validating register form */
 {
     
$nameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
$name = $email = $password = $repeatpassword = "";
$valid = false; // declaring variables

     if ($_SERVER['REQUEST_METHOD'] == "POST") {
         if (empty(getPostVar('email'))) {
         $emailErr ="* Vul een mailadres in";
     } else {
         $email=test_input(getPostVar('email')); 
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $emailErr="* Vul een geldig emailadres in";
     }
     }
     
     if (empty(getPostVar('name'))) { 
         $nameErr="* Vul uw naam in";
     } else { 
         $name=test_input(getPostVar("name"));
     }
     if (empty(getPostVar('password'))) {
         $passwordErr="* Vul uw wachtwoord in";
         } else {
         $password=test_input(getPostVar("password"));     
         } 
     if (empty(getPostVar('repeatpassword'))) {
         $repeatpasswordErr="* Herhaal uw wachtwoord";
     } else { $repeatpassword=test_input(getPostVar("repeatpassword"));
         if (getPostVar('repeatpassword') !== (getPostVar('password'))) {
             $repeatpasswordErr ="* Uw wachtwoorden zijn niet gelijk";
         }
     }
     
     if ( $emailErr === "" && $nameErr === "" && $passwordErr === "" && $repeatpasswordErr === "" ) {
        if (empty(doesEmailExist($email))) {
            $valid = true;
        } else { 
            $emailErr = "* Emailadres is al in gebruik";
            }
     }
 }
 return array("email" => $email, "name" => $name, "password" => $password, "repeatpassword" => $repeatpassword,
              "emailErr" => $emailErr, "nameErr" => $nameErr, "passwordErr" => $passwordErr, "repeatpasswordErr" => $repeatpasswordErr,
               "valid" => $valid);

} 

define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail'));

function validateContact()
{
  

$titleErr = $nameErr = $emailErr = $telefoonErr = $favcontactErr = $commentErr = "";
$title = $name = $email = $telefoon = $favcontact = $comment = "";
$valid = false; // declaring variables



if ($_SERVER["REQUEST_METHOD"] == "POST") {  //set conditions
if  ((getPostVar('title')) == "") {
$titleErr="* Selecteer aanhef"; 
} else {
$title=test_input(getPostVar("title"));
if (!array_key_exists($title, TITLE_OPTIONS)) {
    $titleErr = "Onbekende aanhef.";
}
}
if  (empty(getPostVar('name'))) {
$nameErr="* Vul uw naam in";
} else { 
$name=test_input(getPostVar("name"));
}


if (empty(getPostVar('email'))) {
$emailErr ="* Vul een mailadres in";
} else { 
$email=test_input(getPostVar("email"));
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr="* Vul een geldig emailadres in";
}
}
if (empty(getPostVar('telefoon'))) {
$telefoonErr="* Vul uw telefoonnummer in";
}
else  { 
$telefoon=test_input(getPostVar("telefoon")); 
} 

if (empty(getPostVar('favcontact'))) {
$favcontactErr="* Selecteer een contact optie";
}   
else { 
$favcontact=test_input(getPostVar("favcontact"));
if (!array_key_exists($favcontact, CONTACT_OPTIONS)) {
    $favcontactErr = "Onbekende contactoptie";
} 
}

if (empty(getPostVar('comment'))) {
$commentErr="* Vul uw reden voor contact in";
}
else { 
$comment=test_input(getPostVar("comment")); 
}

if ( $titleErr === "" && $nameErr === "" && $emailErr === "" && $telefoonErr === "" && $favcontactErr === "" &&  $commentErr === "" ) {
$valid = true; }

}
return array("title" => $title, "name" => $name, "email" => $email, "telefoon" => $telefoon,
"favcontact" => $favcontact, "comment" => $comment, "titleErr" => $titleErr,
"nameErr" => $nameErr, "emailErr" => $emailErr, "telefoonErr" => $telefoonErr,
"favcontactErr" => $favcontactErr,"commentErr" => $commentErr, "valid" => $valid);
}

function validateLogin() {
    $emailErr = $passwordErr = "";
    $email = $password = "";
    $valid = false;
    $name = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  //set login conditions
        if  (empty(getPostVar("email"))) {
            $emailErr="* Vul uw Emailadres in"; 
        } else {
            $email=test_input(getPostVar("email"));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr="* Vul een geldig emailadres in";
            }
        }
        if  (empty(getPostVar("password"))) {
            $passwordErr="* Vul uw wachtwoord in";
        } else { 
            $password=test_input(getPostVar("password"));
        }
        if ($emailErr === "" && $passwordErr === "") {
			$authenticate = authenticateUser($email, $password);
			switch($authenticate['result']) {
				case VALID_LOGIN:
					$valid = true;
					$name = $authenticate['user']['name'];
					break;
				case WRONG_PASSWORD:
					$passwordErr = "Verkeerd wachtwoord.";
					break;
				case WRONG_EMAIL:
					$emailErr = "Email is onbekend.";
					break;
            }
        }
    }
    return array(
        "valid" => $valid, "password" => $password, "passwordErr" => $passwordErr,
        "email" => $email, "emailErr" => $emailErr, "name" => $name);
}
?>