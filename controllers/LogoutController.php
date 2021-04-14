<?php
class LogoutController {

    public function __construct() {
    }

    public function run() {

        # Session reset and redirect
        $_SESSION = array();
        header("Location: index.php?action=login");
        die();
    }

}