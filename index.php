<?php

    session_start();

    require_once('forms.php');
    require_once('validations.php');
    require_once('user_service.php');
    require_once('file_repository.php');
    require_once('sessions');

    $page = getRequestedPage();
    $data = processRequest($page);
    showResponsePage($data);

    function processRequest($page) {
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
                    loginUser($data['name']);
                    $page = 'home';
                }
                break;
            case 'logout' :
                logoutUser();
                $page = 'home';
                break;
            }
        
        $data['page'] = $page;
        return $data;

    }

    function getPostVar($key, $default = '') {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    function getUrlVar($key, $default = '') {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
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
            }
        echo '</title></head>' ;   
    }
        
    function showBodySection($data) { 
                echo '<body>';
                showHeader($data);
                showMenu();
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
            case 'thanks' :
                require_once('contact.php');
                showContactHeader();
                break;  
            case 'register' :
            case 'registerthanks' :
                require_once('register.php');
                showRegisterHeader();
                break;
            case 'login' :
                require_once('login.php');
                showLoginHeader();
                break;
        } 
        echo "</h1>";     
    }

          
    
    function showMenu() { 
        $Menu = array("home" => "Home", "about" => "Over Mij", "contact" => "Contact");
        if(!isUserLoggedIn()) {
            $Menu['register'] = "Registreer";
            $Menu['login'] = "Log in";
        } else {
            $Menu['logout'] = "Log uit " .  getLoggedInUserName();
        }        
        echo    '<ul id="menu">';
        
        foreach($Menu as $key => $MenuOptions) {
            echo '<li><a href="index.php?page=' . $key . '">' . $MenuOptions. '</a></li>';
        } 
        echo '</ul>';
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
                echo 'Vul hier uw gegevens in:<br><br>';
                showContactForm($data);
                break;
            case 'register' :
                require_once('register.php');
                echo 'Vul hier uw gegevens in:<br><br>';
                showRegisterForm($data);
                break;
            case 'thanks' :
                require_once('contact.php');
                showContactThanks($data);
                break;         
            case 'login' :
                require_once ('login.php');
                showLoginForm($data);
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
?>        
                
