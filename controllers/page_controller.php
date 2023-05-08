<?php

require_once ('models/page_model.php');


class PageController {
    private $model;
    
    public function __construct() {
        $this->model = new PageModel(NULL);
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponsePage();
    }
    
    private function getRequest() {
        $this->model->getRequestedPage();
    }

    private function showResponsePage() {
        $this->model->createMenu();
        $view = NULL;

        switch ($this->model->page) {
            case 'home' :
                require_once ('views/home_doc.php');
                $view = new HomeDoc($this->model);
                break;
            case 'about' :
                require_once ('views/about_doc.php');
                $view = new AboutDoc($this->model);
                break;
            case 'login' :
                require_once ('views/login_doc.php');
                $view = new LoginDoc($this->model);
                break;
            case 'register' :
                require_once ('views/register_doc.php');
                $view = new RegisterDoc($this->model);
                break;
            case 'changepass' :
                require_once ('views/change_pass_doc.php');
                $view = new ChangePassDoc($this->model);
                break;
            case 'contact' :
                require_once ('views/contact_doc.php');
                $view = new ContactDoc($this->model);
                break;
            case 'thanks' :
                require_once('views/thanks_doc.php');
                $view = new ThanksDoc($this->model);
                break;
            case 'webshop' :
                require_once ('views/webshop_doc.php');
                $view = new WebshopDoc($this->model);
                break;
        }
        if (!empty($view)) {
            $view->show();
        }
    }

    


    private function processRequest() {
        switch($this->model->page) {
            case 'login' :
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->validateLogin();
                if($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage('home');
                }
                break;
            case 'logout' :
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->doLogoutuser();
                $this->model->setPage('home');
                break;
            case 'contact':
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->validateContact();
                if ($this->model->valid) {
                    $this->model->setPage('thanks'); 
                }
                break;
            case 'register' :
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->validateRegister();
                if ($this->model->valid) {
                    $this->model->storeUser();    
                    $this->model->setPage('login'); 
                }
                break;
            case 'changepass':
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->validateChangePass();
                if ($this->model->valid) {
                    ChangePass($data['newpassword']);
                    $page = 'home';
                }
                break;
        }
    }
}

?>