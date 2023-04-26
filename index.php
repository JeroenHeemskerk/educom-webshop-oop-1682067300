<?php

    session_start();

    require_once('sessions.php');

    $page = getRequestedPage();
    $data = processRequest($page);
    showResponsePage($data);

    function processRequest($page) {
        include 'validations.php';
        
         
        switch($page) {
            case 'contact':
                $data = validateContact();
                if ($data['valid']) {
                    $page = 'thanks'; 
                }
                break;
            case 'register' :
                $data = validateRegister();
                if ($data['valid']) {
                    storeUser($data['email'], $data['name'], $data['password']);    
                    $page = 'login'; 
                }
                break;
            case 'login' : 
                $data = validateLogin();
                if ($data['valid']) {
                    loginUser($data['name'], $data['id']);
                    $page = 'home';
                }
                break;
            case 'logout' :
                logoutUser();
                $page = 'home';
                break;
            case 'changepass':
                $data = validateChangePass();
                if ($data['valid']) {
                    ChangePass($data['newpassword']);
                    $page = 'home';
                }
                break;
            case 'webshop':
                handleAction();
                $data['products'] = getProducts();
                break;
            case 'detail':
                handleAction();
                break;
            case 'shoppingcart' :
                handleAction();
                break;            
            }
        
        $data['page'] = $page;
        return $data;

    }
    
    function getArrayVar($array, $key, $default = '') {
        return isset($array[$key]) ? $array[$key] : $default;
    }
    
    function getPostVar($key, $default = '') {
        return getArrayVar($_POST, $key, $default);
    }
    
    function getUrlVar($key, $default = '') {
        return getArrayVar($_GET, $key, $default);
    }
  
    function getRequestedPage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            return getPostVar("page", "home"); 
        } else { 
            return getUrlVar("page", "home"); 
        }
    }
    

    function showResponsePage($data) { 
        showDocumentstart(); 
        showHeadSection($data);
        showBodySection($data);
        showDocumentEnd();
    }
    
    function showDocumentStart() { // showing doc start
        echo   "<!DOCTYPE html>
                <html lang='NL'>";
                
    }

                
    function showHeadSection($data) { // including the style sheet and the page titles
        echo "<head><link rel='stylesheet' href='mystyle.css'>";
        echo '<script src="Scripts/website.js"></script>';
        echo '<title>';  
        switch($data['page']) 
            {
                case 'home' :
                    require_once('home.php');
                    echo $head;
                break;
                    
                case 'about' :
                    require_once('about.php');
                    echo $head;
                break;
                    
                case 'contact' :
                    require_once('contact.php');
                    echo $head;
                break;
                case 'register' :
                    require_once('register.php');
                    echo $head;
                break;
                case 'login' :
                    require_once('login.php');
                    echo $head;
                    break;
                case 'webshop' :
                    require_once('webshop.php');
                    echo $head ;
                    break;
                case 'shoppingcart' :
                    require_once('shoppingcart.php');
                    echo $head ;
                    break;
                    
            }
        echo '</title></head>' ;   
    }
        
    function showBodySection($data) { 
                echo '<body>';
                showHeader($data);
                showMenu();
                showGenericErr($data);
                showContent($data);
                showFooter();
                echo '</body>';
    }
    
    function showHeader($data) { //showing the page title
        echo "<h1>";
        switch($data['page']) 
        { 
            case 'home':
            require_once('home.php');
                showHomeHeader();
                break;
            case 'about':
                require_once('about.php');
                showAboutHeader();
                break;
            case 'contact':
                require_once('contact.php');
                showContactHeader();
                break;
            case 'thanks' :
                require_once('contact.php');
                showContactHeader();
                break;  
            case 'register' :
                require_once('register.php');
                showRegisterHeader();
                break;
            case 'login' :
                require_once('login.php');
                showLoginHeader();
                break;
            case 'webshop':
                require_once('webshop.php');
                showWebshopHeader();
                break;
            case 'shoppingcart': 
                require_once('shoppingcart.php');
                showCartHeader();
                break;
            case 'detail' :
                require_once('webshop.php');
                showWebshopHeader();
                break;


        } 
        echo "</h1>";     
    }

          
    
    function showMenu() { 
        $Menu = array("home" => "Home", "about" => "Over Mij", "contact" => "Contact", "webshop" => "Webshop");
        if(!isUserLoggedIn()) {
            $Menu['register'] = "Registreer";
            $Menu['login'] = "Log in";
        } else {
            $Menu['shoppingcart'] = "Winkelmandje";
            $Menu['changepass'] = "Wachtwoord wijzigen"; 
            $Menu['logout'] = getLoggedInUserName() . " Uitloggen";
        }        
        echo    '<ul id="menu">';
        
        foreach($Menu as $key => $MenuOptions) {
            echo '<li class="menuoption"><a href="index.php?page=' . $key . '" class="button">' . $MenuOptions. '</a></li>';
        } 
        echo '</ul>';
    }

    function showGenericErr($data) {
        if (isset($data['genericErr'])) {
            echo '<span class="error">' . $data['genericErr'] . '</span>';
        }
         
    }
    
    function showContent($data) { //showing page content
        echo 	'<div class="content">';
        switch($data['page']) { 
            case 'home':
                require_once('home.php');
                showHomeContent();
                break;
            case 'about':
                require_once('about.php');
                showAboutContent();
                break;
            case 'contact':
                require_once('contact.php');
                include 'forms.php';
                echo 'Vul hier uw gegevens in:<br><br>';
                showContactForm($data);
                break;
            case 'register' :
                require_once('register.php');
                include 'forms.php';
                echo 'Vul hier uw gegevens in:<br><br>';
                showRegisterForm($data);
                break;
            case 'thanks' :
                require_once('contact.php');
                showContactThanks($data);
                break;         
            case 'login' :
                require_once ('login.php');
                include 'forms.php';
                showLoginForm($data);
                break;
            case 'changepass' :
                include 'forms.php';
                showChangePassForm($data);
                break;
            case 'webshop' :
                require_once('webshop.php');
                showWebshopContent($data);
                break;
            case 'detail' :
                include('webshop.php');
                $id = getUrlVar("id");
                $size = getUrlVar("size");
                $material = getUrlVar("material");
                $price = getUrlVar('price');
                showProductDetail($id, $size, $material, $price);
                break;
            case 'shoppingcart' :
                require_once('shoppingcart.php');
                showCartContent();
                break;        
            default:
                echo "ERROR, Page not found"; 
                break;
                    
                }     
        echo "</div>";
    }

    function showFooter() {
        echo '<footer>
            <div>&copy Created by R. van der Zouw 2023</div>
            </footer>';
    }
    
    function showDocumentEnd() {
        echo "</html>";
    }
    function logError($message) {
        debugToConsole($message);
        
    }
    function debugToConsole($data) {
        $output = str_replace("'", "\\'" , $data); // escape all possible ' characters.
        if (is_array($output))
            $output = implode(',', $output);
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
      }
    
    function generateKey($productId, $sizeId, $materialId =0, $priceId=0) {
        if (is_array($sizeId)) {
            return $productId . "_" . $sizeId['size_id'] . "_" . $sizeId['material_id'] . "_" . $sizeId['price_id'];   
        }
        return $productId . "_" . $sizeId . "_" . $materialId . "_" . $priceId;
    }
?>        
                
