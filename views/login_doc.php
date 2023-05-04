<?php
include_once 'forms_doc.php';

Class LoginDoc extends FormsDoc {

    protected function showHeader() {
        echo '<h1>Log in</h1>';
    }

    private function showForm() {
        $this->showFormstart('login');
        $this->showFormField('email', 'E-mail:', 'email', $this->model);
        $this->showFormField('password', 'Wachtwoord', 'password', $this->model);
        $this->showFormButton('Login', 'action');
        $this->showFormEnd('login');
    }

    protected function showContent() {
        $this->showForm();
    }

}

?>