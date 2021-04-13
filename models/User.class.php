<?php
class User{
    private $_id_user;
    private $_username;
    private $_email;
    private $_password;
    private $_admin;
    private $_disable;
    private $_picture;

    public function __construct($id,$email,$username,$mdp,$picture,$admin,$disable){
        $this->_id_user = $id;
        $this->_email= $email;
        $this->_username = $username;
        $this->_password = $mdp;
        $this->_picture = $picture;
        $this->_admin = $admin;
        $this->_disable=$disable;
    }

    public function id(){
        return $this->_id_user;
    }

    public function email(){
        return $this->_email;
    }

    public function username(){
        return $this->_username;
    }

    public function password(){
        return $this->_password;
    }

    public function picture(){
        return $this->_picture;
    }

    public function html_id(){
        return htmlspecialchars($this->_id_user);
    }
    public function html_email(){
        return htmlspecialchars($this->_email);
    }

    public function html_username(){
        return htmlspecialchars($this->_username);
    }

    public function html_password(){
        return htmlspecialchars($this->_password);
    }

    public function html_picture(){
        return htmlspecialchars($this->_picture);
    }
}
?>