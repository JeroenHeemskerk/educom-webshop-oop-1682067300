<?php

function showRegisterForm($data) { /* register form */

    echo '<form method="post" action="index.php">
    <label for="email">E-mail:</label><br>
    <input type="text" name="email" value="' . $data["email"] . '"><br>
    <span class="error">' . $data["emailErr"] . '</span><br>
    <label for="name">Naam:</label><br>
    <input type="text" name="name" value="' . $data["name"] . '"><br>
    <span class="error">' . $data["nameErr"] . '</span><br>
    <label for="password">Wachtwoord:</label><br>
    <input type="password" name="password" value="' . $data["password"] . '"><br>
    <span class="error">' . $data["passwordErr"] . '</span><br>
    <label for="repeatpassword">Herhaal Wachtwoord:</label><br>
    <input type="password" name="repeatpassword" value="' . $data["repeatpassword"] . '"><br>
    <span class="error">' . $data["repeatpasswordErr"] . '</span><br>';
    echo '<input name="page" value="register" type="hidden">';
    echo '<input type="submit" name="versturen" value="Registreren">';
    echo '</form>'; // end of form
}

function showContactForm($data) { /* contact form */
                  
    echo  "<form  method='post' action='index.php'>
            <label for='title'>Aanhef:</label>
                <select name='title'>
                <option value=''>Selecteer een optie</option>";
    foreach(TITLE_OPTIONS as $key => $label)
    {
        echo "<option value='$key'" . ($data['title'] == $key ? 'selected' : '') . ">$label</option>";
    }
        echo "</select>
                <span class='error'>" . $data['titleErr'] . "</span><br>
        <label class='NAW' for='name'>Naam:</label>
            <input type='text' name='name' id='name' value='" . $data['name'] . "'>
                <span class='error'>" . $data['nameErr'] . "</span><br>
        <label class='NAW' for='email'>E-mail:</label>
            <input type='text' name='email' id='mailadres' value='" . $data['email'] . "'>
                <span class='error'>" . $data['emailErr'] . "</span><br>
        <label class='NAW' for='telephone'>Telefoonnummer:</label>
            <input type='text' name='telefoon' id='telefoonnummer' value='" .$data['telefoon'] . "'>
                <span class='error'>" . $data['telefoonErr'] . "</span><br><br><br>
        <label for='contact'>Hoe wilt u gecontacteerd worden:</label>
            <span class='error'>" . $data['favcontactErr'] . "</span><br><br>";
        
    foreach(CONTACT_OPTIONS as $key => $contactoptions)
    {
         echo "<input type='radio' name='favcontact' value='$key' " . ($data['favcontact'] == $key ? 'checked' : '') . ">
                    <label for='$key'>$contactoptions</label><br>"; 
    } 
        echo "<br><label for='comment'>Beschrijf in het kort waar u contact over wilt opnemen:</label><br><br>
                <textarea name='comment' rows='10' cols='50' maxlength='250' >" . $data['comment'] . "</textarea><br>
                    <span class='error'>" . $data['commentErr'] . "</span><br>";
        echo "<input name='page' value='contact' type='hidden'>";
        echo "<input type='submit' name='versturen' value='Versturen'></form>";
}

function showLoginForm($data) {
    echo    '<form method="post" action="index.php">
            <label for="email">E-mail</label><br>
                <input type="text" name="email" value="' . $data["email"] . '"><br>
                <span class="error">' . $data["emailErr"] . '<br></span>
            <label for="loginpass">Wachtwoord</label><br>
                <input type="password" name="password"><br>
                <span class="error">' . $data["passwordErr"] . '<br></span>
                <input name="page" type="hidden" value="login">
                <input type="submit" name="login" value="Inloggen">';
}

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
    } 


     

?>