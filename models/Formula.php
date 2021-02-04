<?php
namespace MODELS;
use PDO;

class Formula extends DbConnect {
    /*  Primary Key Varchar(50)  */
    private $formula;

    /* Attribut  */
    private $tarif;


    // getter
    // attention : auto_incrémentation et int
    
    public function getFormula() : ?string {
        return $this->formula;
    }
    public function getTarif() : ?float {
        return $this->tarif;
    }

    // setter
    public function setFormula(string $formula) {
        $this->formula = $formula;
    }
    public function setTarif(float $tarif) {
        $this->tarif = $tarif;
    }

    
    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT formula, tarif FROM formulas;";

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
        $query = "SELECT formula, tarif FROM formulas WHERE formula = :formula;";
        $result = $this->pdo->prepare($query);
        // on ajoute le binding : 
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }


    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "INSERT INTO disques (reference, titre, annee, nom) VALUES ('$this->reference','$this->titre','$this->annee','$this->nom');"; 
        //devient
        $query = "INSERT INTO formulas (formula, tarif ) VALUES (:formula, :tarif );";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);
        $result->bindValue("tarif", $this->tarif, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        return $this;
    }

    function update()
    {
        $query = "UPDATE formulas SET formula = :formula, tarif = :tarif  WHERE formula = :formula;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);
        $result->bindValue("tarif", $this->tarif, PDO::PARAM_STR);

        if(!$result->execute()) {
            return false;
        }
        return $this;
    }

    function delete()
    {
        $query = "DELETE FROM formulas WHERE formula = :formula;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("formula", $this->formula, PDO::PARAM_STR);       
        
        return $result->execute();
    }
}


