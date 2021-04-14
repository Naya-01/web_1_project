<?php
class Vote {

    private $_id_user;
    private $_id_idea;

    public function __construct($id_user, $id_idea) {
        $this->_id_user = $id_user;
        $this->_id_idea = $id_idea;
    }

    public function id_user() {
        return $this->_id_user;
    }

    public function id_idea() {
        return $this->_id_idea;
    }

    public function html_id_user() {
        return htmlspecialchars($this->_id_user);
    }

    public function html_id_idea() {
        return htmlspecialchars($this->_id_idea);
    }

}