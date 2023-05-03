<?php
require_once 'forms_doc.php';

class ChangePassDoc extends FormsDoc {

    protected function showHeader() {
        echo '<h1>Wachtwoord Wijzigen</h1>';
    }

    protected function showContent()
    {
            $this->showFormStart('changepass');
            $this->showFormField('password', 'Huidig wachtwoord:', 'password', $this->data);
            $this->showFormField('newpassword', 'Nieuw wachtwoord:', 'password', $this->data);
            $this->showFormField('repeatnewpassword', 'Herhaal uw nieuwe wachtwoord:', 'password', $this->data);
            $this->showFormButton('Veranderen', 'action');
            $this->showFormEnd($this->data['page']);
    }
}