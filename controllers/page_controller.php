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
        }
        if (!empty($view)) {
            $view->show();
        }
    }

    


    private function processRequest() {
        switch($this->model->page) {
            case 'Login' :
                require_once 'models/user_model.php';
                $this->model = new UserModel($this->model);
                $this->model->validateLogin();
                if($this->model->valid) {
                    $this->model->doLoginUser();
                    $this->model->setPage('Home');
                }
                break;
            
        }
    }
}

?>