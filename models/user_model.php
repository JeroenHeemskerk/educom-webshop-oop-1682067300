<?php
require_once 'page_model.php';

define("RESULT_OK", 0);
define("RESULT_WRONG_PASSWORD", -1);
define("RESULT_WRONG_EMAIL", -2);

class UserModel extends PageModel {
    public $email = '';
    public $name = '';
    public $password ='';
    public $emailErr = '';
    public $nameErr = '';
    public $passwordErr = '';
    private $userId = 0;
    public $valid = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

    public function validateLogin() {
    
        if ($this->isPost) {  //set login conditions
            if  (empty(Util::getPostVar("email"))) {
                $this->emailErr="* Vul uw Emailadres in"; 
            } else {
                $this->email=Util::test_input(Util::getPostVar("email"));
                if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailErr="* Vul een geldig emailadres in";
                }
            }
            if  (empty(Util::getPostVar("password"))) {
                $this->passwordErr="* Vul uw wachtwoord in";
            } else { 
                $this->password=test_input(getPostVar("password"));
            }
            if ($this->emailErr === "" && $this->passwordErr === "") {
                try {
                    $authenticate = authenticateUser($this->email, $this->password);
                    switch($authenticate['result']) {
                        case VALID_LOGIN:
                            $this->valid = true;
                            $this->name = $authenticate['user']['name'];
                            $this->userId = $authenticate['user']['id'];
                            break;
                        case WRONG_PASSWORD:
                            $this->passwordErr = "Verkeerd wachtwoord.";
                            break;
                        case WRONG_EMAIL:
                            $this->emailErr = "Email is onbekend.";
                            break;
                    }
                }
                catch(Exception $e) {
                    $this->genericErr = "Er is een technische storing, probeer het later nogmaals";
                    LogError("authentication failed " . $e -> getMessage());
                }
            }
        }    
    }

    public function doLoginUser() {
        $this->sessionManager->doLoginUser($this->name, $this->userId);
    }
}
?>

