<?php
namespace MODELS;
use PDO;

class User extends DbConnect {


    /*  Primary Key Int(15)  */
    private $userId;

    /* Attribut  */
    private $mail;
    private $pwd;
    private $role;

    // getter
    // attention : auto_incrémentation et int
    public function getUserId() : ?int {
        return $this->userId;
    }
    public function getMail() : ?string {
        return $this->mail;
    }
    public function getPwd() : ?string {
        return $this->pwd;
    }
    public function getRole() : ?string {
        return $this->role;
    }




    // setter
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }
    public function setMail(string $mail) {
        $this->mail = $mail;
    }
    public function setPwd(string $pwd) {
        $this->pwd = $pwd;
    }
    public function setRole(string $role) {
        $this->role = $role;
    }
    // méthodes

//fonction du modèle CRUD
function selectAll() {
    // on enregistre la requette SQL
    $query = "SELECT user_id, mail, pwd, role FROM users;";

    // on appelle une requette préparée qui nous retourne un objet de type PDOStatement
    // (dans laquelle on va retrouver la méthode execute() et fetchAll())
    // interêt : gestion des failles de sécu et de la rapidité de traitement
    $result = $this->pdo->prepare($query);

    //on appelle la méthode execute() de PDOStatement pour exécuter la requette préparée
    // $result va alors récupérer le jeu de résultat de la requette
    $result->execute();

    // on appelle la méthode fetchAll() qui va transformer notre jeu de résultat en tableau PHP
    $datas = $result->fetchAll(); 

    return $datas;
}

    function select() {
        // on enregistre la requette SQL (avec la sécu)
        $query = "SELECT user_id, mail, pwd, role FROM users WHERE user_id = :userId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("userId", $this->userId, PDO::PARAM_INT);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }

    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        $query = "INSERT INTO users (mail, pwd, role) VALUES (:mail, :pwd, :role);";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("mail", $this->mail, PDO::PARAM_STR);
        $result->bindValue("pwd", $this->pwd, PDO::PARAM_STR);
        $result->bindValue("role", $this->role, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        $this->userId = $this->pdo->lastInsertId();  // pour l'Auto-Inc, on récupère l'id de la dernière ligne insérer dans la table 
                                                        // et retourne l'objet 

        return $this;
    }

    function update()
    {
        $query = "UPDATE users SET mail = :mail, pwd = :pwd, role = :role WHERE userId = :userId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("userId", $this->userId, PDO::PARAM_STR);
        $result->bindValue("mail", $this->mail, PDO::PARAM_STR);
        $result->bindValue("pwd", $this->pwd, PDO::PARAM_STR);
        $result->bindValue("role", $this->role, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorInfo());
            return false;
        }
        return $this;
    }

    function delete()
    {                           // on ne peut pas supprimer une ligne contenant une FK de cette manière
        $query = "DELETE FROM users WHERE user_id = :userId;";  //ici, on supprime la ligne, attention à la clé étrangère
        $result = $this->pdo->prepare($query);                           // si elle est référencée dans une autre table et demande à modifier une autre table
        $result->bindValue("userId", $this->userId, PDO::PARAM_INT);
        
        $result->execute();
    }

}