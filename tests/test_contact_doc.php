<?php
include_once '../views/contact_doc.php';

$data = array('page' => 'Contact', 'name' => '', 'email' => '', 'comment' => '');

$view = new ContactDoc($data);
$view->show();

?>