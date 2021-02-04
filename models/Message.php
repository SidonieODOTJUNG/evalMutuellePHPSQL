<?php
namespace MODELS;
use PDO;
class Message extends DbConnect{
    /*  Primary Key autoincrément  */
    private $idMessage;

    /* Attribut  */
    private $message;
    private $dateMessage;
    private $subject;

    /*  Foreign Key int(15) */
    private $numSecu;
    private $counselorId;


    // getter
    // attention : auto_incrémentation et int
    
    public function getIdMessage() : ?int {
        return $this->idMessage;
    }
    public function getMessage() : ?string {
        return $this->message;
    }
    public function getDateMessage() : ?string {
        return $this->dateMessage;
    }
    public function getSubject() : ?string {
        return $this->subject;
    }
    public function getNumSecu() : ?int {
        return $this->numSecu;
    }
    public function getCounselorId() : ?string {
        return $this->counselorId;
    }


    // setter
    public function setIdMessage(int $idMessage) {
        $this->idMessage = $idMessage;
    }
    public function setMessage(string $message) {
        $this->message = $message;
    }
    public function setDateMessage(string $dateMessage) {
        $this->dateMessage = $dateMessage;
    }
    public function setSubject(string $subject) {
        $this->subject = $subject;
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
        $query = "SELECT id_message, message, date_message, subject, num_secu, counselor_id FROM messages;";
    
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
        $query = "SELECT id_message, message, date_message, subject, num_secu, counselor_id FROM messages WHERE id_message = :idMessage;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("idMessage", $this->idMessage, PDO::PARAM_INT);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }

    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        $query = "INSERT INTO messages (message, date_message, subject, num_secu, counselor_id) VALUES (:message, :dateMessage, :subject, :numSecu, :counselorId);";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("idMessage", $this->idMessage, PDO::PARAM_STR);
        $result->bindValue("message", $this->message, PDO::PARAM_STR);
        $result->bindValue("dateMessage", $this->dateMassage, PDO::PARAM_STR);
        $result->bindValue("subject", $this->subject, PDO::PARAM_STR);
        $result->bindValue("numSecu", $this->numSecu, PDO::PARAM_STR);
        $result->bindValue("counselorId", $this->counselorId, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        $this->idMessage = $this->pdo->lastInsertId();  // pour l'Auto-Inc, on récupère l'id de la dernière ligne insérer dans la table 
                                                        // et retourne l'objet 

        return $this;
    }

    function update()
    {
        $query = "UPDATE messages SET message = :message, dateMessage = :dateMassage, subject = :subject, numSecu = :numSecu, counselorId = :counselorId WHERE idMessage = :idMessage;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("idMessage", $this->idMessage, PDO::PARAM_STR);
        $result->bindValue("message", $this->message, PDO::PARAM_STR);
        $result->bindValue("dateMessage", $this->dateMassage, PDO::PARAM_STR);
        $result->bindValue("subject", $this->subject, PDO::PARAM_STR);
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
        $query = "DELETE FROM messages WHERE id_message = :idMessage;";  //ici, on supprime la ligne, attention à la clé étrangère
        $result = $this->pdo->prepare($query);                           // si elle est référencée dans une autre table et demande à modifier une autre table
        $result->bindValue("idMessage", $this->idMessage, PDO::PARAM_INT);
        
        $result->execute();
    }
}


