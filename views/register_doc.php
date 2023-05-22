<?php
include_once 'views/forms_doc.php';

class RegisterDoc extends FormsDoc {
    protected function showHeader() {
        echo '<h1>Account aanmaken?</h1>';
    }
    private function showForm() {
        $this->showFormStart('register');
        $this->showFormField('email', 'E-mailadres:', 'email');
        $this->showFormField('name', 'Naam', 'text');
        $this->showFormField('password', 'Wachtwoord:', 'password');
        $this->showFormField('repeatpassword', 'Herhaal uw wachtwoord:', 'password');
        $this->showFormButton('Registreren', 'action');
        $this->showFormEnd('register');
    }

    protected function showContent() {
        $this->showForm();
    }
}