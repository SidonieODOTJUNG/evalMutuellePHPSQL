<?php

namespace MODELS;

use Models\DbConnect;
use PDO;

class Member extends DbConnect{
    /*  Primary Key auto inc  */
    private $memberId;

    /* Attribut  */
    private $memberName;
    private $memberFirstname;
    private $memberBirth;

    /*  Foreign Key int(15) */
    private $numSecu;


    // getter
    // attention : auto_incrémentation et int
    
    public function getMemberId() : ?int {
        return $this->memberId;
    }
    public function getMemberName() : ?string {
        return $this->memberName;
    }
    public function getMemberFirstname() : ?string {
        return $this->memberFirstname;
    }
    public function getMemberBirth() : ?string {
        return $this->memberBirth;
    }
    public function getNumSecu() : ?int {
        return $this->numSecu;
    }


    // setter
    public function setMemberId(int $memberId) {
        $this->memberId = $memberId;
    }
    public function setMemberName(string $memberName) {
        $this->memberName = $memberName;
    }
    public function setMemberFirstname(string $memberFirstname) {
        $this->memberFirstname = $memberFirstname;
    }
    public function setMemberBirth(string $memberBirth) {
        $this->memberBirth = $memberBirth;
    }
    public function setNumSecu(int $numSecu) {
        $this->numSecu = $numSecu;
    }
 
    
    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT member_id, member_name, member_firstname, member_birth, num_secu FROM members;";

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
        $query = "SELECT member_id, member_name, member_firstname, member_birth, num_secu FROM members WHERE member_id = :memberId;";
        $result = $this->pdo->prepare($query);
        // on ajoute le binding : 
        $result->bindValue("memberId", $this->memberId, PDO::PARAM_INT);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }


    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "INSERT INTO disques (reference, titre, annee, nom) VALUES ('$this->reference','$this->titre','$this->annee','$this->nom');"; 
        //devient
        $query = "INSERT INTO members (member_name, member_firstname, member_birth, num_secu ) VALUES (:memberName, :memberFirstname, :memberBirth, :numSecu );";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("memberName", $this->memberName, PDO::PARAM_STR);
        $result->bindValue("memberFirstname", $this->memberFirstname, PDO::PARAM_STR);
        $result->bindValue("memberBirth", $this->memberBirth, PDO::PARAM_STR);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        return $this;
    }

    function update()
    {
        $query = "UPDATE members SET memberName = :memberName, memberFirstname = :memberFirstname, memberBirth = :memberBirth, numSecu = :numSecu  WHERE memberId = :memberId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("memberId", $this->memberId, PDO::PARAM_INT);
        $result->bindValue("memberName", $this->memberName, PDO::PARAM_STR);
        $result->bindValue("memberFirstname", $this->memberFirstname, PDO::PARAM_STR);
        $result->bindValue("memberBirth", $this->memberBirth, PDO::PARAM_STR);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);

        if(!$result->execute()) {
            return false;
        }
        return $this;
    }

    function delete()
    {
        $query = "DELETE FROM members WHERE memberId = :memberId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("memberId", $this->memberId, PDO::PARAM_STR);       
        
        return $result->execute();
    }
}


