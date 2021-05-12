<?php
class Comment {

    private $_id_comment;
    private $_text;
    private $_id_idea;
    private $_id_user;
    private $_disable;
    private $_creation_date;

    public function __construct($id_comment, $text, $id_idea, $id_user, $disable, $creation_date) {
        $this->_id_comment = $id_comment;
        $this->_text = $text;
        $this->_id_idea = $id_idea;
        $this->_id_user = $id_user;
        $this->_disable = $disable;
        $this->_creation_date = $creation_date;
    }

    public function id_comment() {
        return $this->_id_comment;
    }

    public function text() {
        return $this->_text;
    }

    public function id_idea() {
        return $this->_id_idea;
    }

    public function id_user() {
        return $this->_id_user;
    }

    public function disable() {
        return $this->_disable;
    }

    public function creation_date() {
        return $this->_creation_date;
    }

    public function html_id_comment() {
        return htmlspecialchars($this->_id_comment);
    }

    public function html_text() {
        return htmlspecialchars($this->_text);
    }

    public function html_id_idea() {
        return htmlspecialchars($this->_id_idea);
    }

    public function html_id_user() {
        return htmlspecialchars($this->_id_user);
    }

    public function html_disable() {
        return htmlspecialchars($this->_disable);
    }

    public function html_creation_date() {
        $timestamp = strtotime($this->_creation_date);
        $newDate=date('d-m-y H:i:s',$timestamp);
        return htmlspecialchars($newDate);
    }

    public function set_text($text){
        $this->_text=$text;
    }

}
