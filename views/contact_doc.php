<?php
require_once 'views/forms_doc.php';

class ContactDoc extends FormsDoc {
    private function showForm() {
        $this->showFormStart('contact');
        $this->showFormField('title', 'Aanhef:', 'select', $this->data, array('dhr' => 'Dhr', 'mvr' => 'Mvr', 'other' => 'Anders'));
        $this->showFormField('name', 'Naam:', 'text', $this->data);
        $this->showFormField('email', 'E-mail:', 'e-mail', $this->data); 
        $this->showFormField('favcontact', 'Hoe wilt u gecontacteerd worden?', 'radio', $this->data, array('phone' => 'Telefonisch', 'mail' => 'E-mail'));
        $this->showFormField('comment', 'Opmerking:', 'textarea', $this->data);
        $this->showFormButton('Versturen', 'contact');
        $this->showFormEnd('contact');
    }

    protected function showContent() {
        echo '<h1>Contact opnemen?</h1>';
        $this->showForm();
    }
}