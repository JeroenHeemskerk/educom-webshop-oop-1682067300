<?php

class User {

  public $id = NULL;
  public $name;
  public $email;
  public $password;
  public $admin = false;
  
  public function __construct()
  {
    
  }

  public function getId(){
    return $this->id;
  }
  public function setId($userId){
    $this->id = $userId;
  }
  
  public function getEmail(){
    return $this->email;
  }
  public function setEmail($email){
    $this->email = $email;
  }

  public function getPassword(){
    return $this->password;
  }
  public function setPassword($password){
    $this->password = $password;
  }

  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
  }

  public function getIDtimesTwo() {
    echo 'test';
    return $this->id * 2;
  }

}

?>