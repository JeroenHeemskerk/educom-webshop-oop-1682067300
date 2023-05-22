<?php
require_once 'User.php';

class UserCrud {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }
    
    public function createUser($user) {
        $sql = "INSERT INTO users(email, name, password) VALUES(:email, :name, :password)";
        $params = array(':email' => $user->getEmail(), ':name' => $user->getName(), ':password' => $user->getPassword());
        $userId = $this->crud->createRow($sql, $params);
        return $userId;
    }

    public function readUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email=:email";
        $params = array(":email"=>$email);
        $user = $this->crud->readOneRow($sql, $params, 'User');
        return $user;
    }

    public function readUserById($userId) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $params = array(":id"=>$userId);
        $user = $this->crud->readOneRow($sql, $params, 'User');
        return $user;
    }

    public function updateUser($user) {
        $sql = "UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id";
        $params = array(":name"=>$user->getName(), ":email"=>$user->getEmail(), ":password"=>$user->getPassword(), ":id"=>$user->getId());
    
        $this->crud->updateRow($sql, $params);
    }
}
?>