<?php

namespace MODELS;
use PDO;

class Option extends DbConnect {
    /*  Primary Key Varchar(50)  */
    private $nomOption;

    /* Attribut  */
    private $tarifOption;


    // getter
    // attention : auto_incrémentation et int
    
    public function getNomOption() : ?string {
        return $this->nomOption;
    }
    public function getTarifOption() : ?float {
        return $this->tarifOption;
    }

    // setter
    public function setNomOption(string $nomOption) {
        $this->nomOption = $nomOption;
    }
    public function setTarifOption(float $tarifOption) {
        $this->tarifOption = $tarifOption;
    }


    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT option, tarif_option FROM options;";

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
        $query = "SELECT option, tarif_option FROM options WHERE option = :option;";
        $result = $this->pdo->prepare($query);
        // on ajoute le binding : 
        $result->bindValue("option", $this->option, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }


    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        //(ne se présentente pas commme ça car problème de sécu avec la variable injectée directement)
        // $query = "INSERT INTO disques (reference, titre, annee, nom) VALUES ('$this->reference','$this->titre','$this->annee','$this->nom');"; 
        //devient
        $query = "INSERT INTO options (option, tarif_option ) VALUES (:option, :tarifOption );";
        $result = $this->pdo->prepare($query);

        // on ajoute le binding
        $result->bindValue("option", $this->option, PDO::PARAM_STR);
        $result->bindValue("tarifOption", $this->tarifOption, PDO::PARAM_STR);

        if(!$result->execute()) {
            var_dump($result->errorinfo());
            return false;
        }
        return $this;
    }

    function update()
    {
        $query = "UPDATE options SET option = :option, tarifOption = :tarifOption  WHERE option = :option;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("option", $this->option, PDO::PARAM_STR);
        $result->bindValue("tarifOption", $this->tarifOption, PDO::PARAM_STR);

        if(!$result->execute()) {
            return false;
        }
        return $this;
    }

    function delete()
    {
        $query = "DELETE FROM options WHERE option = :option;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("option", $this->option, PDO::PARAM_STR);       
        
        return $result->execute();
    }
    
}


