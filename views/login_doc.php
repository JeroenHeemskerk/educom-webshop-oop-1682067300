<?php
include_once 'forms_doc.php';

Class LoginDoc extends FormsDoc {

    private function showForm() {
        $this->showFormstart('login');
        $this->showFormField('email', 'E-mail:', 'email', $this->data);
        $this->showFormField('password', 'Wachtwoord', 'password', $this->data);
        $this->showFormButton('Login', 'action');
        $this->showFormEnd('login');
    }

    protected function showContent() {
        echo '<h1>Log in</h1>';
        $this->showForm();
    }

}

?>