<?php
include_once 'views/forms_doc.php';

class RegisterDoc extends FormsDoc {
    private function showForm() {
        $this->showFormStart('register');
        $this->showFormField('email', 'E-mailadres:', 'email', $this->data);
        $this->showFormField('name', 'Naam', 'text', $this->data);
        $this->showFormField('password', 'Wachtwoord:', 'password', $this->data);
        $this->showFormField('repeatpassword', 'Herhaal uw wachtwoord:', 'password', $this->data);
        $this->showFormButton('Registreren', 'action');
        $this->showFormEnd('register');
    }

    protected function showContent() {
        echo '<h1>Account aanmaken</h1>';
        $this->showForm();
    }
}