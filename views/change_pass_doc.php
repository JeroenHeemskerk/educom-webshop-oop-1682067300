<?php
require_once 'forms_doc.php';

class ChangePassDoc extends FormsDoc {

    protected function showHeader() {
        echo '<h1>Wachtwoord Wijzigen</h1>';
    }

    protected function showContent()
    {
            $this->showFormStart('changepass');
            $this->showFormField('password', 'Huidig wachtwoord:', 'password', $this->model);
            $this->showFormField('newpassword', 'Nieuw wachtwoord:', 'password', $this->model);
            $this->showFormField('repeatnewpassword', 'Herhaal uw nieuwe wachtwoord:', 'password', $this->model);
            $this->showFormButton('Veranderen', 'action');
            $this->showFormEnd($this->model->page);
    }
}