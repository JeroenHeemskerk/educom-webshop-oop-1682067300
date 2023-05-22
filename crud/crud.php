<?php

class Crud {
    public $pdo;
    public $connstring = 'mysql:host=127.0.0.1;dbname=rubens_webshop';
    public $username = 'rubens_webshop_user';
    public $password = 'test1234';
    public $dbname = 'rubens_webshop';

    public function __construct() {
        try {
            $this->pdo = new PDO($this->connstring, $this->username, $this->password);
            $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function prepareAndBind($sql, $params, $class=NULL) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        if (!empty($class)) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        } else {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
        }    
            
        $stmt->execute();
        return $stmt;
    }

    public function createRow($sql, $params, $class) {
        $this->prepareAndBind($sql, $params, $class);
        return $this -> pdo -> lastInsertId();
    }

    public function readOneRow($sql, $params, $class) {
        $stmt = $this -> prepareAndBind($sql, $params, $class);
        return $stmt->fetch();
    }

    public function readMultipleRows($sql, $params = array(), $class) {
        $stmt = $this -> prepareAndBind($sql, $params, $class);
        $results = $stmt->fetchAll();
        var_dump($results);
        $array = array();
            foreach ($results as $result) {
                $array[$result->id] = $result;
            }
        return $array;
    }

    public function updateRow($sql, $params) {
        $this->prepareAndBind($sql, $params);
    }

    public function deleteRow($sql, $params, $class) {
        $this -> prepareAndBind($sql, $params, $class);
    }

}
?>