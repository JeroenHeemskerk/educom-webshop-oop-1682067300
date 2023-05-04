<?php

class PageController {
    private $model;
    
    public function __construct() {
        $this->model = new PageModel(Null);
    }

    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponse();
    }
    
    private getRequest() {
        $this->model->getRequestedPage();
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
