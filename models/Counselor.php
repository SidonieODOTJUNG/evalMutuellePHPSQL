<?php
namespace MODELS;

use Models\DbConnect;
use PDO;

class Counselor extends DbConnect{
    /*  Primary Key Varchar(6)  */
    private $counselorId;

    /* Attribut  */
    private $counselorName;
    private $counselorFirstname;

    /*  Foreign Key int(11) */
    private $userId;


    // getter
    // attention : auto_incrémentation et int
    
    public function getCounselorId() : ?string {
        return $this->counselorId;
    }
    public function getCounselorName() : ?string {
        return $this->counselorName;
    }
    public function getCounselorFirstname() : ?string {
        return $this->counselorFirstname;
    }
    public function getUserId() : ?int {
        return $this->userId;
    }


    // setter
    public function setCounselorId(string $counselorId) {
        $this->counselorId = $counselorId;
    }
    public function setCounselorName(string $counselorName) {
        $this->counselorName = $counselorName;
    }
    public function setCounselorFirstname(string $counselorFirstname) {
        $this->counselorFirstname = $counselorFirstname;
    }
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }
    
    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT counselor_id, counselor_name, counselor_firstname, user_id FROM counselor;";

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
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "SELECT titre, annee, nom FROM disques WHERE reference = '$this->reference';"; 
        //devient
        $query = "SELECT counselor_id, counselor_name, counselor_firstname, user_id FROM counselor WHERE counselor_id = :counselorId;";
        $result = $this->pdo->prepare($query);
        // on ajoute le binding : 
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);
        $result->bindValue("counselorName", $this->counselorName, PDO::PARAM_STR);
        $result->bindValue("counselorFirstname", $this->counselorFirstname, PDO::PARAM_STR);
        $result->bindValue("userId", $this->userId, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }

    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "INSERT INTO disques (reference, titre, annee, nom) VALUES ('$this->reference','$this->titre','$this->annee','$this->nom');"; 
        //devient
        $query = "INSERT INTO counselor (counselor_id, counselor_name, counselor_firstname, user_id ) VALUES (:counselorId, :counselorName, :counselorFirstname, :userId );";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);
        $result->bindValue("counselorName", $this->counselorName, PDO::PARAM_STR);
        $result->bindValue("counselorFirstname", $this->counselorFirstname, PDO::PARAM_STR);
        $result->bindValue("userId", $this->userId, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        return $this;
    }

    function update()
    {
        $query = "UPDATE counselor SET counselorName = :counselorName, counselorFirstname = :counselorFirstname, userId = :userId  WHERE counselorId = :counselorId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);
        $result->bindValue("counselorName", $this->counselorName, PDO::PARAM_STR);
        $result->bindValue("counselorFirstname", $this->counselorFirstname, PDO::PARAM_STR);
        $result->bindValue("userId", $this->userId, PDO::PARAM_STR);

        if(!$result->execute()) {
            return false;
        }
        return $this;
    }

    function delete()
    {
        $query = "DELETE FROM counselor WHERE counselorId = :counselorId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);       
        
        return $result->execute();
    }
}


