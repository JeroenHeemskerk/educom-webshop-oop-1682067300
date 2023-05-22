<?php
require_once "models/user_model.php";
require_once "models/shop_model.php";
require_once "crud/user_crud.php";
require_once "crud/shop_crud.php";

class ModelFactory{
  private $crud;
  public $pageModel;

  public function __construct($crud){
    $this->crud = $crud;
  }

  public function createModel($name){
      switch ($name){
        case "user":
          $this->crud = $this->createCrud($name);
          $this->pageModel = new UserModel($this->pageModel, $this->crud);
        break;
      case "webshop":
          $this->crud = $this->createCrud($name);
          $this->pageModel = new ShopModel($this->pageModel, $this->crud);
        break;
      default:
        $this->pageModel = new PageModel($this->crud);
    }
    return $this->pageModel;
  }

  public function createCrud($name){
    switch ($name){
      case "user":
        $this->crud = new UserCrud($this->crud);
        break;
      case "webshop":
        $this->crud = new ShopCrud($this->crud);
        break;
    }
    return $this->crud;
  }


} 


?>