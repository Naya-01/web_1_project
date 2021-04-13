<?php
class Idea{
    private $_id_idea;
    private $_subject;
    private $_text;
    private $_id_user;
    private $_status;
    private $_submitted_date;
    private $_accepted_date;
    private $_refused_date;
    private $_closed_date;

    public function __construct($id_idea, $subject, $text, $id_user, $status, $submitted_date, $accepted_date, $refused_date, $closed_date)
    {
        $this->_id_idea = $id_idea;
        $this->_subject = $subject;
        $this->_text = $text;
        $this->_id_user = $id_user;
        $this->_status = $status;
        $this->_submitted_date = $submitted_date;
        $this->_accepted_date = $accepted_date;
        $this->_refused_date = $refused_date;
        $this->_closed_date = $closed_date;
    }


    public function id_idea()
    {
        return $this->_id_idea;
    }

    public function subject()
    {
        return $this->_subject;
    }

    public function text()
    {
        return $this->_text;
    }

    public function id_user()
    {
        return $this->_id_user;
    }

    public function status()
    {
        return $this->_status;
    }

    public function submitted_date()
    {
        return $this->_submitted_date;
    }

    public function accepted_date()
    {
        return $this->_accepted_date;
    }

    public function refused_date()
    {
        return $this->_refused_date;
    }

    public function closed_date()
    {
        return $this->_closed_date;
    }

    public function html_id_idea(){
        return htmlspecialchars($this->_id_idea);
    }

    public function html_subject(){
        return htmlspecialchars($this->_subject);
    }

    public function html_text(){
        return htmlspecialchars($this->_text);
    }

    public function html_id_user(){
        return htmlspecialchars($this->_id_user);
    }

    public function html_status(){
        return htmlspecialchars($this->_status);
    }

    public function html_submitted_date(){
        return htmlspecialchars($this->_submitted_date);
    }

    public function html_accepted_date(){
        return htmlspecialchars($this->_accepted_date);
    }

    public function html_refused_date(){
        return htmlspecialchars($this->_refused_date);
    }

    public function html_closed_date(){
        return htmlspecialchars($this->_closed_date);
    }



}