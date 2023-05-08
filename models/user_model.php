<?php
require_once 'page_model.php';
require_once 'sessions.php';
require_once 'db_repository.php';
// require_once 'Util.php';

define("RESULT_OK", 0);
define("RESULT_WRONG_PASSWORD", -1);
define("RESULT_WRONG_EMAIL", -2);
define("VALID_LOGIN", 0);
define("WRONG_PASSWORD", -1);
define("WRONG_EMAIL", -2);


class UserModel extends PageModel {
    public $user = '';
    public $email = '';
    public $name = '';
    public $password ='';
    public $emailErr = '';
    public $nameErr = '';
    public $passwordErr = '';
    private $userId = 0;
    public $telefoon = '';
    public $favcontact = '';
    public $favcontactErr = '';
    public $title = '';
    public $titleErr = '';
    public $telefoonErr = '';
    public $comment = '';
    public $commentErr = '';
    public $newpassword = '';
    public $newpasswordErr = '';
    public $repeatpassword = '';
    public $repeatpasswordErr = '';
    public $repeatnewpassword = '';
    public $repeatnewpasswordErr ='';
    public $genericErr = '';
    public $valid = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);

        if($this->sessionManager->isUserLoggedIn()){
            // Create a logged in user object 
            $this->user = findUserById($this->sessionManager->getLoggedInID('id'));
          }
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
                $this->password=Util::test_input(getPostVar("password"));
            }
            if ($this->emailErr === "" && $this->passwordErr === "") {
                try {
                    $authenticate = $this->authenticateUser($this->email, $this->password);
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

    private function authenticateUser($email, $password) {
        $user = findUserByEmail($email);
        if (empty($user)) {
            return array("result" => WRONG_EMAIL, "user" => $user);
        }
        if ($user['password'] != $password) {
            return array("result" => WRONG_PASSWORD, "user" => $user);
        }
        return array("result" => VALID_LOGIN, "user" => $user);
    }

    public function doLoginUser() {
        $this->sessionManager->loginUser($this->name, $this->userId);
    }

    public function doLogoutuser() {
        $this->sessionManager->logoutUser();
    }

    public function validateContact() {
        
            define('TITLE_OPTIONS', array("dhr" => 'Dhr', "mvr" =>  'Mvr', "OTHER" => 'Anders')); 
            define('CONTACT_OPTIONS', array("telefoon" => 'per Telefoon', "mail" => 'per E-mail')); 

        if ($this->isPost) {  //set conditions
        if  ((Util::getPostVar('title')) == "") {
        $this->titleErr="* Selecteer aanhef"; 
        } else {
        $this->title=Util::test_input(Util::getPostVar("title"));
        if (!array_key_exists($this->title, TITLE_OPTIONS)) {
            $this->titleErr = "Onbekende aanhef.";
        }
        }
        if  (empty(Util::getPostVar('name'))) {
        $this->nameErr="* Vul uw naam in";
        } else { 
        $this->name=Util::test_input(Util::getPostVar("name"));
        }


        if (empty(Util::getPostVar('email'))) {
        $this->emailErr ="* Vul een mailadres in";
        } else { 
        $this->email=Util::test_input(Util::getPostVar("email"));
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->emailErr="* Vul een geldig emailadres in";
        }
        }
        if (empty(Util::getPostVar('telefoon'))) {
        $this->telefoonErr="* Vul uw telefoonnummer in";
        }
        else  { 
        $this->telefoon=Util::test_input(Util::getPostVar("telefoon")); 
        } 

        if (empty(Util::getPostVar('favcontact'))) {
        $this->favcontactErr="* Selecteer een contact optie";
        }   
        else { 
        $this->favcontact=Util::test_input(Util::getPostVar("favcontact"));
        if (!array_key_exists($this->favcontact, CONTACT_OPTIONS)) {
            $this->favcontactErr = "Onbekende contactoptie";
        } 
        }

        if (empty(Util::getPostVar('comment'))) {
        $commentErr="* Vul uw reden voor contact in";
        }
        else { 
        $comment=Util::test_input(Util::getPostVar("comment")); 
        }

        if ( $this->titleErr === "" && $this->nameErr === "" && $this->emailErr === "" && $this->telefoonErr === "" && $this->favcontactErr === "" &&  $this->commentErr === "" ) {
        $this->valid = true; }

        }
    }
    function validateRegister() { /* validating register form */

        if ($this->isPost) {
                if (empty(Util::getPostVar('email'))) {
                $this->emailErr ="* Vul een mailadres in";
            } else {
                $this->email=Util::test_input(Util::getPostVar('email')); 
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr="* Vul een geldig emailadres in";
            }
            }
            
            if (empty(Util::getPostVar('name'))) { 
                $this->nameErr="* Vul uw naam in";
            } else { 
                $this->name=Util::test_input(Util::getPostVar("name"));
            }
            if (empty(Util::getPostVar('password'))) {
                $this->passwordErr="* Vul uw wachtwoord in";
                } else {
                $this->password=Util::test_input(getPostVar("password"));     
                } 
            if (empty(Util::getPostVar('repeatpassword'))) {
                $this->repeatpasswordErr="* Herhaal uw wachtwoord";
            } else { $this->repeatpassword=Util::test_input(Util::getPostVar("repeatpassword"));
                if (Util::getPostVar('repeatpassword') !== (Util::getPostVar('password'))) {
                    $this->repeatpasswordErr ="* Uw wachtwoorden zijn niet gelijk";
                }
            }
            
            if ( $this->emailErr === "" && $this->nameErr === "" && $this->passwordErr === "" && $this->repeatpasswordErr === "" ) {
                try {
                    if (empty($this->doesEmailExist($this->email))) {
                        $this->valid = true;
                    } else { 
                        $this->emailErr = "* Emailadres is al in gebruik";
                    }
                }
                catch (Exception $e) {
                    $this->genericErr = "Er is een technische storing, probeer het later nogmaals";
                        LogError("authentication failed " . $e -> getMessage());
                }
            }
        }

    }

    function validateChangePass() {
        $this->user = findUserByID($this->getLoggedInID());        
    
        if ($this->isPost) {
            if (empty(Util::getPostVar('password'))) {
                $this->passwordErr="* Vul uw wachtwoord in";
                } else { 
                $this->password=Util::test_input(Util::getPostVar("password"));     
                }
            if (empty(Util::getPostVar('newpassword'))) {
                $this->newpasswordErr="* Vul uw nieuwe wachtwoord in";
            } else {
                $this->newpassword=Util::test_input(Util::getPostVar("newpassword"));
            }
            if (empty(Util::getPostVar('repeatnewpassword'))) {
                $this->repeatnewpasswordErr="* Herhaal uw nieuwe wachtwoord";
            } else { $this->repeatnewpassword=Util::test_input(Util::getPostVar("repeatpassword"));
                if (Util::getPostVar('repeatnewpassword') !== (Util::getPostVar('newpassword'))) {
                    $this->repeatnewpasswordErr ="* Uw wachtwoorden zijn niet gelijk";
                }
            }
            if ($this->password !== $this->user->getPassword()) {
                $this->passwordErr="* Vul het juiste wachtwoord in";
            }
    
            if ( $this->passwordErr === "" && $this->newpasswordErr === "" && $this->repeatnewpasswordErr === "") {
                $this->valid = true; }
        }
    }

    public function getPassword() {
        return $this->password;
    }

    private function getLoggedInID() {
        $userId = $_SESSION['user_id'];
        return $userId;
    }

    public function doesEmailExist() {
        $user = findUserByEmail($this->email);
        if (empty($user)) {
        return false;
        } else {
        return true;
        }
    }

    public function StoreUser() {
        saveNewUser($this->email, $this->name, $this->password);
    }
}

?>

