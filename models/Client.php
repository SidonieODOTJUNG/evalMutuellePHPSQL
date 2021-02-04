<?php

namespace MODELS;
use PDO;

class Client extends DbConnect {
    /*  Primary Key Int(15)  */
    private $numSecu;

    /* Attribut  */
    private $clientName;
    private $clientFirstname;
    private $address;
    private $nbFamilyMember;
    private $clientBirth;
    private $phone;

    /*  Foreign Key  */
    private $counselorId;
    private $formula;
    private $userId;


    // getter
    // attention : auto_incrémentation et int
    public function getNumSecu() : ?string {
        return $this->numSecu;
    }
    public function getClientName() : ?string {
        return $this->clientName;
    }
    public function getClientFirstname() : ?string {
        return $this->clientFirstname;
    }
    public function getAddress() : ?string {
        return $this->address;
    }
    public function getNbFamilyMember() : ?int {
        return $this->nbFamilyMember;
    }
    public function getClientBirth() : ?string {
        return $this->clientBirth;
    }
    public function getPhone() : ?int {
        return $this->phone;
    }
    public function getCounselorId() : ?string {
        return $this->counselorId;
    }
    public function getFormula() : ?string {
        return $this->formula;
    }
    public function getUserId() : ?int {
        return $this->userId;
    }


    // setter
    public function setNumSecu(string $numSecu) {
        $this->numSecu = $numSecu;
    }
    public function setClientName(string $clientName) {
        $this->clientName = $clientName;
    }
    public function setClientFirstname(string $clientFirstname) {
        $this->clientFirstname = $clientFirstname;
    }
    public function setAddress(string $address) {
        $this->address = $address;
    }
    public function setNbFamilyMember(int $nbFamilyMember) {
        $this->nbFamilyMember = $nbFamilyMember;
    }
    public function setClientBirth(string $clientBirth) {
        $this->clientBirth = $clientBirth;
    }
    public function setPhone(int $phone) {
        $this->phone = $phone;
    }
    public function setCounselorId(string $counselorId) {
        $this->counselorId = $counselorId;
    }
    public function setFormula(string $formula) {
        $this->formula = $formula;
    }
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }
    
    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT * FROM clients;";

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
        $query = "SELECT num_secu, client_name, client_firstname, address, nb_family_member, client_birth, phone, counselor_id, formula, user_id FROM clients WHERE num_secu = :numSecu;";
        $result = $this->pdo->prepare($query);
        // on ajoute le binding : 
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_INT);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }


    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "INSERT INTO disques (reference, titre, annee, nom) VALUES ('$this->reference','$this->titre','$this->annee','$this->nom');"; 
        //devient
        $query = "INSERT INTO clients (num_secu, client_name, client_firstname, address, nb_family_member, client_birth, phone, counselor_id, formula, user_id ) VALUES (:numSecu, :clientName, :clientFirstname, :address, :nbFamilyMember, :clientBirth, :phone, :counselorId, :formula, :userId );";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);
        $result->bindValue("clientName", $this->clientName, PDO::PARAM_STR);
        $result->bindValue("clientFirstname", $this->clientFirstname, PDO::PARAM_STR);
        $result->bindValue("address", $this->address, PDO::PARAM_STR);
        $result->bindValue("nbFamilyMember", $this->nbFamilyMember, PDO::PARAM_INT);
        $result->bindValue("clientBirth", $this->clientBirth, PDO::PARAM_STR);
        $result->bindValue("phone", $this->phone, PDO::PARAM_INT);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);
        $result->bindValue("userId", $this->userId, PDO::PARAM_INT);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        return $this;
    }

    function update()
    {
        $query = "UPDATE clients SET clientName = :clientName, clientFirstname = :clientFirstname, address = :address, nbFamilyMember = :nbFamilyMember, clientBirth = :clientBirth, phone = :phone, counselorId = :counselorId, formula = :formula, userId = :userId  WHERE numSecu = :numSecu;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);
        $result->bindValue("clientName", $this->clientName, PDO::PARAM_STR);
        $result->bindValue("clientFirstname", $this->clientFirstname, PDO::PARAM_STR);
        $result->bindValue("address", $this->address, PDO::PARAM_STR);
        $result->bindValue("nbFamilyMember", $this->nbFamilyMember, PDO::PARAM_INT);
        $result->bindValue("clientBirth", $this->clientBirth, PDO::PARAM_STR);
        $result->bindValue("phone", $this->phone, PDO::PARAM_INT);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);
        $result->bindValue("userId", $this->userId, PDO::PARAM_INT);

        if(!$result->execute()) {
            return false;
        }
        return $this;
    }

    function delete()
    {
        $query = "DELETE FROM clients WHERE numSecu = :numSecu;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);       
        
        return $result->execute();
    }
}


