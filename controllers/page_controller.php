<?php

require_once ('models/page_model.php');

class PageController {
    private $model;
    
    public function __construct() {
        $this->model = new PageModel(Null);
    }

    public function handleRequest() {
        $this->getRequest();
        // $this->processRequest();
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
        }
        if (!empty($view)) {
            $view->show();
        }
    }
}
    


//     private processRequest() {
//         switch($this->model->page) {
//             case 'Login' :
//                 $this->model-> new UserModel
//                 $model->validateLogin() 
//                     if($model-> valid) {
//                         $this->model->loginUser();
//                         $this->model->setPage('Home');
//                     }
//         }
//     }
// }
