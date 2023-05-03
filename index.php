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
        $Menu = array("home" => "Home", "about" => "Over Mij", "contact" => "Contact", "webshop" => "Webshop");
        if(!isUserLoggedIn()) {
            $Menu['register'] = "Registreer";
            $Menu['login'] = "Log in";
        } else {
            $Menu['shoppingcart'] = "Winkelmandje";
            $Menu['changepass'] = "Wachtwoord wijzigen"; 
            $Menu['logout'] = getLoggedInUserName() . " Uitloggen";
        }
        $data['menu'] = $Menu;
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
        $view=null;
        switch($data['page']) { 
            case 'home':
                require_once('views/home_doc.php');
                $view = new HomeDoc($data);
                break;
            case 'about':
                require_once('views/about_doc.php');
                $view = new AboutDoc($data);
                break;
            case 'contact':
                require_once('views/contact_doc.php');
                $view = new ContactDoc($data);
                break;
            case 'register' :
                require_once('views/register_doc.php');
                $view = new RegisterDoc($data);
                break;
            case 'thanks' :
                require_once('views/thanks_doc.php');
                $view = new ThanksDoc($data);
                break;         
            case 'login' :
                require_once ('views/login_doc.php');
                $view = new LoginDoc($data);
                break;
            case 'webshop' :
                require_once ('views/webshop_doc.php');
                $view = new WebshopDoc($data);
                break;
            case 'detail' :
                require_once ('views/detail_doc.php');
                $view = new DetailDoc($data);
                break;
            case 'shoppingcart' :
                require_once ('views/cart_doc.php');
                $view = new CartDoc($data);
                break;
            case 'changepass' :
                require_once ('views/change_pass_doc.php');
                $view = new ChangePassDoc($data);
                break;
            default:
                echo 'ERROR 404: Page not found.';
            }
        if (!empty($view)) {
            $view->show();
        }
    }  
    
    function showGenericErr($data) {
        if (isset($data['genericErr'])) {
            echo '<span class="error">' . $data['genericErr'] . '</span>';
        }
         
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
?>        
                
