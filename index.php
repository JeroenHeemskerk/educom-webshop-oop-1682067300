<?php

    session_start();

    require_once('sessions.php');
    require_once('controllers/page_controller.php');
    require_once('model_factory.php');
    require_once('crud/crud.php');

    $crud = new Crud();
    $modelFactory = new ModelFactory($crud);
    $controller = new PageController($modelFactory);
    $controller->handleRequest();

  
    
    function getArrayVar($array, $key, $default = '') {
        return isset($array[$key]) ? $array[$key] : $default;
    }
    
    function getPostVar($key, $default = '') {
        return getArrayVar($_POST, $key, $default);
    }
    
    function getUrlVar($key, $default = '') {
        return getArrayVar($_GET, $key, $default);
    }
    
    function showGenericErr($data) {
        if (isset($data['genericErr'])) {
            echo '<span class="error">' . $data['genericErr'] . '</span>';
        }
         
    }

    function logError($message) {
        debugToConsole($message);
        
    }
    function debugToConsole($data) {
        $output = str_replace("'", "\\'" , $data); // escape all possible ' characters.
        if (is_array($output))
            $output = implode(',', $output);
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
      }
?>        
                
