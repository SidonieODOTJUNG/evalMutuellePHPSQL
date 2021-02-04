<?php

namespace MODELS;
use PDO;

class Appointment extends DbConnect {
    /*  Primary Key 
        appointmentId : autoincrément  */
    private $appointmentId;

    /* Attribut 
    date : date 
    object (index) : VARCHAR(50)   */
    private $date;
    private $object;

    /*  Foreign Key 
    numSecu: int
    counselorId : VARCHAR(6)   */
    private $numSecu;
    private $counselorId;


    // getter
    // attention : auto_incrémentation et int
    public function getAppointmentId() : ?int {
        return $this->appointmentId;
    }
    public function getDate() : ?string {
        return $this->date;
    }
    public function getObject() : ?string {
        return $this->object;
    }
    public function getNumSecu() : ?int {
        return $this->numSecu;
    }
    public function getCounselorId() : ?string {
        return $this->counselorId;
    }

    // setter
    public function setAppointmentId(int $appointmentId) {
        $this->appointmentId = $appointmentId;
    }
    public function setDate(string $date) {
        $this->date = $date;
    }
    public function setObject(string $object) {
        $this->object = $object;
    }
    public function setNumSecu(int $numSecu) {
        $this->numSecu = $numSecu;
    }
    public function setCounselorId(string $counselorId) {
        $this->counselorId = $counselorId;
    }
    

//fonction du modèle CRUD
    function selectAll() {
    // on enregistre la requette SQL
    $query = "SELECT appointment_id, date, object, num_secu, counselor_id FROM appointment;";

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
        $query = "SELECT appointment_id, date, object, num_secu, counselor_id FROM appointment WHERE appointment_id = :appointmentId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("appointmentId", $this->appointmentId, PDO::PARAM_INT);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }

    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        $query = "INSERT INTO appointment (date, object, num_secu, counselor_id) VALUES (:date, :object, :numSecu, :counselorId);";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("appointmentId", $this->appointmentId, PDO::PARAM_STR);
        $result->bindValue("date", $this->date, PDO::PARAM_STR);
        $result->bindValue("object", $this->object, PDO::PARAM_STR);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        $this->appointmentId = $this->pdo->lastInsertId();  // pour l'Auto-Inc, on récupère l'id de la dernière ligne insérer dans la table 
                                                        // et retourne l'objet 

        return $this;
    }

    function update()
    {
        $query = "UPDATE appointment SET date = :date, object = :object, numSecu = :numSecu, counselorId = :counselorId WHERE appointmentId = :appointmentId;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("appointmentId", $this->appointmentId, PDO::PARAM_STR);
        $result->bindValue("date", $this->date, PDO::PARAM_STR);
        $result->bindValue("object", $this->object, PDO::PARAM_STR);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorInfo());
            return false;
        }
        return $this;
    }

    function delete()
    {                           // on ne peut pas supprimer une ligne contenant une FK de cette manière
        $query = "DELETE FROM appointment WHERE appointment_id = :appointmentId;";  //ici, on supprime la ligne, attention à la clé étrangère
        $result = $this->pdo->prepare($query);                           // si elle est référencée dans une autre table et demande à modifier une autre table
        $result->bindValue("appointmentId", $this->appointmentId, PDO::PARAM_INT);
        
        $result->execute();
    }
}


