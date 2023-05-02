<?php
include_once "../views/login_doc.php";

$data = array('page' => 'login', 'email' => '', 'password' => '');

$view = new LoginDoc($data);
$view->show();

?>