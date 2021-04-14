<?php

class Db{

    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost:3307;dbname=youreviewdb;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }
    public function username_exists($username)
    {
        $query = 'SELECT * from users WHERE username=:username';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function insert_user($username, $email, $password)
    {
        $query = 'INSERT INTO users (username,email,password) values (:username,:email,:password)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->bindValue(':email', $email);
        $ps->bindValue(':password', $password);
        $ps->execute();
    }

    public function modify_disable($id_user)
    {
        if ($this->is_disabled($id_user) == 1) $disable = 0;
        else $disable = 1;
        $query = 'UPDATE users SET disable = :disable WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':disable', $disable);
        $ps->execute();
    }

    public function modify_admin($id_user) {
        if ($this->is_admin($id_user)) $admin = 0;
        else $admin = 1;
        $query = 'UPDATE users SET admin = :admin WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':admin', $admin);
        $ps->execute();
    }


    public function is_admin($id_user)
    {
        $query = 'SELECT * from users WHERE id_user=:id_user AND admin = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function is_disabled($id_user)
    {
        $query = 'SELECT * from users WHERE id_user=:id_user AND disable = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function valider_user($username, $password)
    {
        $query = 'SELECT password from users WHERE username=:username';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->execute();
        if ($ps->rowcount() == 0)
            return false;
        $hash = $ps->fetch()->password;
        return password_verify($password, $hash);
    }

    public function valider_email($email, $password)
    {
        $query = 'SELECT password from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        if ($ps->rowcount() == 0)
            return false;
        $hash = $ps->fetch()->password;
        return password_verify($password, $hash);
    }

    public function email_exists($email){
        $query = 'SELECT * from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function getUsername($id){
        $query = 'SELECT username from users WHERE id_user=:id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        $ps->execute();
        return $ps->fetch()->username;
    }

    public function getIdUser($email){
        $query = 'SELECT id_user from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        return $ps->fetch()->id_user;
    }

    public function insert_idea($id_user, $subject, $text)
    {
        $query = 'INSERT INTO ideas (id_user,subject,text,status,submitted_date) values (:id_user,:subject,:text,"T",:submitted_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':text', $text);
        $ps->bindValue(':submitted_date', NOW);
        $ps->execute();
    }

    public function select_ideas(){
        $query = 'SELECT * from ideas WHERE status != :status';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', "T");
        $ps->execute();
        $list_ideas= array();
        while($row = $ps->fetch()){
            $list_ideas[]= new Idea($row->id_idea,$row->subject,$row->text,$row->id_user
                ,$row->status,$row->submitted_date,$row->accepted_date,$row->refused_date,$row->closed_date);
        }
        return $list_ideas;
    }

    public function select_T_ideas(){
        $query = 'SELECT * from ideas';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $list_ideas= array();
        while($row = $ps->fetch()){
            $list_ideas[]= new Idea($row->id_idea,$row->subject,$row->text,$row->id_user
                ,$row->status,$row->submitted_date,$row->accepted_date,$row->refused_date,$row->closed_date);
        }
        return $list_ideas;
    }

    public function select_users(){
        $query = 'SELECT * from users';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $list_users= array();
        while($row = $ps->fetch()){
            $list_users[]= new User($row->id_user, $row->email, $row->username, $row->password, $row->picture, $row->admin, $row->disable);
        }
        return $list_users;
    }

    public function countLikes($id_idea){
        $query = 'SELECT id_idea from votes WHERE id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        return $ps->rowcount();
    }

    public function insert_vote($id_user,$id_idea){
        $query = 'INSERT INTO votes (id_user,id_idea) values (:id_user,:id_idea)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function vote_exist($id_user,$id_idea){
        $query = 'SELECT * from votes WHERE id_user=:id_user AND id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function select_idea($id_idea){
        $query = 'SELECT * from ideas WHERE id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $row = $ps->fetch();
        $idea = new Idea($row->id_idea,$row->subject,$row->text,$row->id_user,$row->status,$row->submitted_date,$row->accepted_date,
            $row->refused_date,$row->closed_date);
        return $idea;
    }

    public function setStatus($id_idea, $status) {
        $query = 'UPDATE ideas SET status = :status WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', $status);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function setRefusedDate($id_idea) {
        $query = 'UPDATE ideas SET refused_date = :refused_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':refused_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function setAcceptedDate($id_idea) {
        $query = 'UPDATE ideas SET accepted_date = :accepted_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':accepted_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function setClosedDate($id_idea) {
        $query = 'UPDATE ideas SET closed_date = :closed_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':closed_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    public function idea_exist($id_idea){
        $query = 'SELECT * from ideas WHERE id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    public function insert_comment($id_idea,$id_user,$text){
        $query = 'INSERT INTO comments (id_user,id_idea,text,creation_date) values (:id_user,:id_idea,:text,:creation_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->bindValue(':text', $text);
        $ps->bindValue(':creation_date', NOW);
        $ps->execute();
    }

    public function select_comments_idea($id_idea){
        $query = 'SELECT * from comments WHERE id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $comments= array();
        while($row = $ps->fetch()){
            $comments [] = new Comment($row->id_comment,$row->text,$row->id_idea,$row->id_user,$row->disable,$row->creation_date);
        }
        return $comments;
    }


}
