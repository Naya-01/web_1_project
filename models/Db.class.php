<?php
class Db {

    private static $instance = null;
    private $_db;

    private function __construct() {
        try {
            $this->_db = new PDO('mysql:host=localhost:3307;dbname=youreviewdb;charset=utf8', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    /*
        ██╗███╗░░██╗░██████╗███████╗██████╗░████████╗
        ██║████╗░██║██╔════╝██╔════╝██╔══██╗╚══██╔══╝
        ██║██╔██╗██║╚█████╗░█████╗░░██████╔╝░░░██║░░░
        ██║██║╚████║░╚═══██╗██╔══╝░░██╔══██╗░░░██║░░░
        ██║██║░╚███║██████╔╝███████╗██║░░██║░░░██║░░░
        ╚═╝╚═╝░░╚══╝╚═════╝░╚══════╝╚═╝░░╚═╝░░░╚═╝░░░

        ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
     */

    # Used in member registration (LoginController).
    public function insertUser($username, $email, $password) {
        $query = 'INSERT INTO users (username, email, password, picture) values (:username, :email, :password, :picture)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->bindValue(':email', $email);
        $ps->bindValue(':password', $password);
        $ps->bindValue(':picture', DEFAULT_PROFILE_PIC);
        $ps->execute();
    }

    # Used in the idea display system (IdeaController).
    public function insertIdea($id_user, $subject, $text) {
        $query = 'INSERT INTO ideas (id_user, subject, text, status, submitted_date) 
                    values (:id_user, :subject, :text, "T", :submitted_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':subject', $subject);
        $ps->bindValue(':text', $text);
        $ps->bindValue(':submitted_date', NOW);
        $ps->execute();
    }

    # Used in the idea display system (IdeaController and NewIdeaController) to like ideas.
    public function insertVote($id_user, $id_idea){
        $query = 'INSERT INTO votes (id_user, id_idea) values (:id_user, :id_idea)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    # Used in the idea display system (IdeaController).
    public function insertComment($id_idea, $id_user, $text) {
        $query = 'INSERT INTO comments (id_user, id_idea, text, creation_date) values (:id_user, :id_idea, :text, :creation_date)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->bindValue(':text', $text);
        $ps->bindValue(':creation_date', NOW);
        $ps->execute();
    }

    /*
        ███╗░░░███╗░█████╗░██████╗░██╗███████╗██╗░█████╗░░█████╗░████████╗██╗░█████╗░███╗░░██╗
        ████╗░████║██╔══██╗██╔══██╗██║██╔════╝██║██╔══██╗██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║
        ██╔████╔██║██║░░██║██║░░██║██║█████╗░░██║██║░░╚═╝███████║░░░██║░░░██║██║░░██║██╔██╗██║
        ██║╚██╔╝██║██║░░██║██║░░██║██║██╔══╝░░██║██║░░██╗██╔══██║░░░██║░░░██║██║░░██║██║╚████║
        ██║░╚═╝░██║╚█████╔╝██████╔╝██║██║░░░░░██║╚█████╔╝██║░░██║░░░██║░░░██║╚█████╔╝██║░╚███║
        ╚═╝░░░░░╚═╝░╚════╝░╚═════╝░╚═╝╚═╝░░░░░╚═╝░╚════╝░╚═╝░░╚═╝░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝

        ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
    */

    # Change the disable status. Used in user management (UserHandlingController).
    public function modifyDisableState($id_user) {
        if ($this->isDisabled($id_user) == 1) $disable = 0;
        else $disable = 1;
        $query = 'UPDATE users SET disable = :disable WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':disable', $disable);
        $ps->execute();
    }

    # Change the privilege status. Used in user management (UserHandlingController).
    public function modifyPrivilegeState($id_user) {
        if ($this->isAdmin($id_user)) $admin = 0;
        else $admin = 1;
        $query = 'UPDATE users SET admin = :admin WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':admin', $admin);
        $ps->execute();
    }

    # Change the idea status. Used in idea management (PostHandlingController).
    public function setStatus($id_idea, $status) {
        $query = 'UPDATE ideas SET status = :status WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', $status);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    # Change the idea refused date. Used in idea management (PostHandlingController).
    public function setRefusedDate($id_idea) {
        $query = 'UPDATE ideas SET refused_date = :refused_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':refused_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    # Change the idea accepted date. Used in idea management (PostHandlingController).
    public function setAcceptedDate($id_idea) {
        $query = 'UPDATE ideas SET accepted_date = :accepted_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':accepted_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    # Change the idea closed date. Used in idea management (PostHandlingController).
    public function setClosedDate($id_idea) {
        $query = 'UPDATE ideas SET closed_date = :closed_date WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':closed_date', NOW);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
    }

    # Disable a comment. Used in idea system (IdeaController and ProfileController).
    public function disableComment($id_comment){
        $query = 'UPDATE comments SET disable=:disable WHERE id_comment=:id_comment';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_comment', $id_comment);
        $ps->bindValue(':disable', 1);
        $ps->execute();
    }

    # Modify image. Used in profile system (ProfileController).
    public function modifyImage($id_user, $link) {
        $query = 'UPDATE users SET picture = :picture WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':picture', $link);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
    }

    /*
        ░██████╗░███████╗████████╗████████╗███████╗██████╗░
        ██╔════╝░██╔════╝╚══██╔══╝╚══██╔══╝██╔════╝██╔══██╗
        ██║░░██╗░█████╗░░░░░██║░░░░░░██║░░░█████╗░░██████╔╝
        ██║░░╚██╗██╔══╝░░░░░██║░░░░░░██║░░░██╔══╝░░██╔══██╗
        ╚██████╔╝███████╗░░░██║░░░░░░██║░░░███████╗██║░░██║
        ░╚═════╝░╚══════╝░░░╚═╝░░░░░░╚═╝░░░╚══════╝╚═╝░░╚═╝

        ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
    */

    # Used in profile (ProfileController) to configure $_SESSION.
    public function getImage($id) {
        $query = 'SELECT picture from users WHERE id_user = :id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        $ps->execute();
        return htmlspecialchars($ps->fetch()->picture);
    }

    # Used in member registration (LoginController) to configure $_SESSION.
    public function getUsername($id) {
        $query = 'SELECT username from users WHERE id_user = :id';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id', $id);
        $ps->execute();
        return htmlspecialchars($ps->fetch()->username);
    }

    # Used in member registration (LoginController) to configure $_SESSION.
    public function getIdUser($email) {
        $query = 'SELECT id_user from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        return $ps->fetch()->id_user;
    }

    # Used in modifyPrivilegeState function and to configure $_SESSION (LoginController and index.php).
    public function isAdmin($id_user) {
        $query = 'SELECT admin from users WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        return $ps->fetch()->admin == 1;
    }

    # Used in modifyDisableState function and to configure $_SESSION (LoginController and index.php).
    public function isDisabled($id_user) {
        $query = 'SELECT disable from users WHERE id_user=:id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        return $ps->fetch()->disable == 1;
    }

    # Used in idea system (IdeaController).
    public function isCommentDisabled($id_comment){
        $query = 'SELECT disable from comments WHERE id_comment = :id_comment';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_comment', $id_comment);
        $ps->execute();
        return $ps->fetch()->disable == 1;
    }

    /*
        ██╗░░░░░██╗░██████╗████████╗        ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██║░░░░░██║██╔════╝╚══██╔══╝        ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        ██║░░░░░██║╚█████╗░░░░██║░░░        █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██║░░░░░██║░╚═══██╗░░░██║░░░        ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ███████╗██║██████╔╝░░░██║░░░        ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ╚══════╝╚═╝╚═════╝░░░░╚═╝░░░        ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
    */

    # List of all ideas order by date. Used in idea management (PostHandlingController).
    public function selectIdeasByDate() {
        $query = 'SELECT * from ideas ORDER BY submitted_date DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $listIdeas= array();
        while($row = $ps->fetch()) {
            $listIdeas[]= new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    # List of all users. Used in user management (UserHandlingController).
    public function selectUsers() {
        $query = 'SELECT * from users';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        $listUsers= array();
        while($row = $ps->fetch()) {
            $listUsers[]= new User($row->id_user, $row->email, $row->username,
                $row->password, $row->picture, $row->admin, $row->disable);
        }
        return $listUsers;
    }

    # List of all comments linked to an idea. Used in idea system (IdeaController).
    public function selectCommentsWhereIdeaIs($id_idea) {
        $query = 'SELECT * from comments WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $listComments = array();
        while($row = $ps->fetch()) {
            $listComments[] = new Comment($row->id_comment, $row->text, $row->id_idea,
                $row->id_user, $row->disable, $row->creation_date);
        }
        return $listComments;
    }

    # Function used to display the ideas of the local user. Used in profile (ProfileController).
    public function selectIdeasWhereUserIs($id_user) {
        $query = 'SELECT * from ideas WHERE id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        $listIdeas = array();
        while($row = $ps->fetch()) {
            $listIdeas[]= new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    # Function used to display the comments of the local user (without disabled one). Used in profile (ProfileController).
    public function selectCommentsWhereUserIs($id_user) {
        $query = 'SELECT * from comments WHERE id_user = :id_user AND disable = 0';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        $listComments = array();
        while($row = $ps->fetch()) {
            $listComments[] = new Comment($row->id_comment, $row->text, $row->id_idea,
                $row->id_user, $row->disable, $row->creation_date);
        }
        return $listComments;
    }

    # Function used to display the ideas liked by the local user. Used in profile (ProfileController).
    public function selectIdeasLikedBy($id_user) {
        $query = 'SELECT id.* from ideas id, votes vo WHERE id.id_idea = vo.id_idea AND vo.id_user = :id_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->execute();
        $listIdeas= array();
        while($row = $ps->fetch()){
            $listIdeas[]= new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    # Select the idea by it's status
    public function selectIdeasWhereStatusIs($status) {
        $query ='SELECT ideas.* FROM ideas LEFT JOIN votes ON ideas.id_idea = votes.id_idea 
                    WHERE status=:status GROUP BY ideas.id_idea ORDER BY count(votes.id_idea) DESC';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', $status);
        $ps->execute();
        $listIdeas = array();
        while($row = $ps->fetch()){
            $listIdeas[] = new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    # Select idea limit selectIdeasWithNumberLimit
    public function selectIdeasWithNumberLimit($limit) {
        $query ='SELECT ideas.* FROM ideas LEFT JOIN votes ON ideas.id_idea = votes.id_idea 
                    WHERE status!=:status GROUP BY ideas.id_idea ORDER BY count(votes.id_idea) DESC LIMIT :limit';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', "T");
        $ps->bindValue(':limit', $limit,PDO::PARAM_INT);
        $ps->execute();
        $listIdeas = array();
        while($row = $ps->fetch()){
            $listIdeas[] = new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    # List of ideas ascending / descending with a status other than 'T'. Used in the home display system (HomeController). selectIdeasSortedByLike
    public function selectIdeasSortedByLike($is_crescent){
        if ($is_crescent) {
            $query ='SELECT ideas.* FROM ideas LEFT JOIN votes ON ideas.id_idea = votes.id_idea WHERE status!=:status 
                        GROUP BY ideas.id_idea ORDER BY count(votes.id_idea) ASC';
        } else {
            $query ='SELECT ideas.* FROM ideas LEFT JOIN votes ON ideas.id_idea = votes.id_idea WHERE status!=:status 
                        GROUP BY ideas.id_idea ORDER BY count(votes.id_idea) DESC';
        }
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':status', "T");
        $ps->execute();
        $listIdeas = array();
        while($row = $ps->fetch()){
            $listIdeas[] = new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
        }
        return $listIdeas;
    }

    /*
        ███████╗██╗░░██╗██╗░██████╗████████╗        ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██╔════╝╚██╗██╔╝██║██╔════╝╚══██╔══╝        ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        █████╗░░░╚███╔╝░██║╚█████╗░░░░██║░░░        █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██╔══╝░░░██╔██╗░██║░╚═══██╗░░░██║░░░        ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ███████╗██╔╝╚██╗██║██████╔╝░░░██║░░░        ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ╚══════╝╚═╝░░╚═╝╚═╝╚═════╝░░░░╚═╝░░░        ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
     */

    # Returns if the username exists. Is used in member registration and login (LoginController).
    public function usernameExists($username) {
        $query = 'SELECT COUNT(id_user) as "exist" from users WHERE username = :username';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->execute();
        $response = $ps->fetch()->exist == '1';
        return $response;
    }

    # Returns if the email exists. Is used in member registration and login (LoginController).
    public function emailExists($email) {
        $query = 'SELECT COUNT(id_user) as "exist" from users WHERE email = :email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        $response = $ps->fetch()->exist == '1';
        return $response;
    }

    # Returns if the vote exists. Is used in the like system (IdeaController) and Used in the home display system (HomeController).
    public function voteExists($id_user, $id_idea) {
        $query = 'SELECT COUNT(*) as "exist" from votes WHERE id_user = :id_user AND id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $response = $ps->fetch()->exist == '1';
        return $response;
    }

    # Returns if the idea exists. Is used in the idea display system (IdeaController).
    public function ideaExists($id_idea){
        $query = 'SELECT COUNT(id_idea) as "exist" from ideas WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $response = $ps->fetch()->exist == '1';
        return $response;
    }

    /*
        ░█████╗░████████╗██╗░░██╗███████╗██████╗░       ███████╗██╗░░░██╗███╗░░██╗░█████╗░████████╗██╗░█████╗░███╗░░██╗░██████╗
        ██╔══██╗╚══██╔══╝██║░░██║██╔════╝██╔══██╗       ██╔════╝██║░░░██║████╗░██║██╔══██╗╚══██╔══╝██║██╔══██╗████╗░██║██╔════╝
        ██║░░██║░░░██║░░░███████║█████╗░░██████╔╝       █████╗░░██║░░░██║██╔██╗██║██║░░╚═╝░░░██║░░░██║██║░░██║██╔██╗██║╚█████╗░
        ██║░░██║░░░██║░░░██╔══██║██╔══╝░░██╔══██╗       ██╔══╝░░██║░░░██║██║╚████║██║░░██╗░░░██║░░░██║██║░░██║██║╚████║░╚═══██╗
        ╚█████╔╝░░░██║░░░██║░░██║███████╗██║░░██║       ██║░░░░░╚██████╔╝██║░╚███║╚█████╔╝░░░██║░░░██║╚█████╔╝██║░╚███║██████╔╝
        ░╚════╝░░░░╚═╝░░░╚═╝░░╚═╝╚══════╝╚═╝░░╚═╝       ╚═╝░░░░░░╚═════╝░╚═╝░░╚══╝░╚════╝░░░░╚═╝░░░╚═╝░╚════╝░╚═╝░░╚══╝╚═════╝░
    */

    # Allows you to check the password-email correspondence. Used in the login system (LoginController)
    public function validerEmail($email, $password) {
        $query = 'SELECT password from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        if ($ps->rowcount() == 0) return false;
        $hash = $ps->fetch()->password;
        return password_verify($password, $hash);
    }

    # Allows you to check the password-email correspondence. Used in the login system (LoginController)
    public function countLikes($id_idea) {
        $query = 'SELECT count(id_idea) as "like" FROM votes WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea',$id_idea);
        $ps->execute();
        return $ps->fetch()->like;
    }

    # Allows the selection of an idea from its id. Used in the idea system (IdeaController).
    public function selectIdea($id_idea) {
        $query = 'SELECT * from ideas WHERE id_idea = :id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        $row = $ps->fetch();
        $idea = new Idea($row->id_idea, $row->subject, $row->text, $row->id_user, $row->status, $row->submitted_date,
            $row->accepted_date, $row->refused_date, $row->closed_date);
        return $idea;
    }
}




/*
    # Returns if the username exists. Is used in member registration and login (LoginController).
    public function username_exists($username) {
        $query = 'SELECT * from users WHERE username = :username';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':username', $username);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Returns if the email exists. Is used in member registration and login (LoginController).
    public function email_exists($email) {
        $query = 'SELECT * from users WHERE email=:email';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':email', $email);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Returns if the vote exists. Is used in the like system (IdeaController) and Used in the home display system (HomeController).
    public function vote_exist($id_user,$id_idea) {
        $query = 'SELECT * from votes WHERE id_user=:id_user AND id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_user', $id_user);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # Returns if the idea exists. Is used in the idea display system (IdeaController).
    public function idea_exist($id_idea){
        $query = 'SELECT * from ideas WHERE id_idea=:id_idea';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':id_idea', $id_idea);
        $ps->execute();
        return ($ps->rowcount() != 0);
    }

    # List of ideas with a status other than 'T'. Used in the home display system (HomeController).

        public function select_ideas() {
            $query = 'SELECT * from ideas WHERE status != :status';
            $ps = $this->_db->prepare($query);
            $ps->bindValue(':status', "T");
            $ps->execute();
            $list_ideas= array();
            while($row = $ps->fetch()){
                $list_ideas[]= new Idea($row->id_idea, $row->subject, $row->text, $row->id_user,
                    $row->status, $row->submitted_date, $row->accepted_date, $row->refused_date, $row->closed_date);
            }
            return $list_ideas;
        }
*/