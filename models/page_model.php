<?php
require_once 'Util.php';
require_once 'MenuItem.php';

class PageModel {
    public $page;
    protected $isPost = false;
    public $menu;
    public $errors = array();
    public $genericErr = '';
    protected $sessionManager;

    // public function __construct($copy) {
    //     if (empty($copy)) {
    //         $this->sessionManager = new SessionManager;        
    //     } else {
    //         $this->page = $copy->page;
    //         $this->isPost = $copy->isPost;
    //         $this->menu = $copy->menu;
    //         $this->genericErr = $copy->genericErr;
    //         $this->sessionManager = $copy->sessionManager;
    //     }
    // }

    public function getRequestedPage() {
        $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');

        if ($this->isPost) {
            $this->setPage(Util::getPostVar('page', 'home'));
        } else {
            $this->setPage(Util::getUrlVar('page', 'home'));
        }
    }
    public function setPage($newPage) {
        $this->page = $newPage;
    }

    public function getRequestedAction() {
        if($this->isPost) {
            return (Util::getPostVar('action'));
        } else {
            return (Util::getUrlVar('action'));
        }
    }

    public function createMenu() {
        $this->menu['home'] = new MenuItem('home', 'Home');
        $this->menu['about'] = new MenuItem('about', 'Over Mij');
    //     $this->menu['contact'] = new MenuItem('contact', 'Contact');
    //     $this->menu['webshop'] = new MenuItem('webshop', 'Webshop');
    //     if($this->sessionManager->isUserLoggedIn()){
    //        $this->menu['shoppingcart'] = new MenuItem('shoppingcart', 'Shoppingcart');
    //        $this->menu['changepassword'] = new MenuItem('changepassword', 'Wachtwoord Wijzigen');
    //       $this->menu['logout'] = new MenuItem('logout', 'Log uit ' . $this->sessionManager->getLoggedInUserName('name'));
    //     } else {
    //       $this->menu['register'] = new MenuItem('register', 'Registreren');
    //       $this->menu['login'] = new MenuItem('login', 'Login');
    //     }
    }
}    
?>