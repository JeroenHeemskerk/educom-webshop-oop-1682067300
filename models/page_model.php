<?php
require_once 'Util.php';

class PageModel {
    public $page;
    protected $isPost = false;
    public $menu;
    public $errors = array();
    public $genericErr = '';
    protected $sessionManager;

    public function __construct($copy) {
        if (empty($copy)) {
            $this->page = $copy->page;
            $this->isPost = $copy->isPost;
            $this->menu = $copy->menu;
            $this->genericErr = $copy->genericErr;
            $this->sessionManager = $copy->sessionManager;
        }
    }

    public function getRequestedPage() {
        $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');

        if ($this->isPost) {
            $this->setPage(Util::getPostVar('page', 'home'));
        } else {
            $this->setPage(Util::getUrlVar('page', 'home'));
        }
    }
    public function setPage($newPage) {
        $this->page = $newPage;
    }

    public function getRequestedAction() {
        if($this->isPost) {
            return (Util::)
        }
    }
}
?>