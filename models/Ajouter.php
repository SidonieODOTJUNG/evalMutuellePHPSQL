<?php
namespace MODELS;
use PDO; 

class Ajouter extends DbConnect {
    /*  Primary Foreign Key ()
        formula : varchar(50)  
        nomOption (nom_option) : VARCHAR(50)   */
    private $formula;
    private $nomOption;


    // getter
    // attention : auto_incrémentation et int
    public function getFormula() : ?string {
        return $this->formula;
    }
    public function getNomOption() : ?string {
        return $this->nomOption;
    }

    // setter
    public function setFormula(string $formula) {
        $this->formula = $formula;
    }
    public function setNomOption(string $nomOption) {
        $this->nomOption = $nomOption;
    }


    //fonction du modèle CRUD
    function selectAll() {
        // on enregistre la requette SQL
        $query = "SELECT formula, nom_option FROM ajouter;";

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
        $query = "SELECT formula, nom_option FROM ajouter WHERE formula = :formula AND nom_option = :nomOption;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("formula", $this->formula, PDO::PARAM_INT);
        $result->bindValue("nomOption", $this->nomOption, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch(); 
        return $datas;
    }


    function insert() {
        // on enregistre la requette SQL (avec la sécu)
        $query = "INSERT INTO ajouter (formula, nom_option) VALUES (:formula, :nomOption);";
        $result = $this->pdo->prepare($query);
        $result->bindValue("formula", $this->formula, PDO::PARAM_INT);
        $result->bindValue("nomOption", $this->nom_option, PDO::PARAM_STR);

        $result->execute();
        return $this;
        
    }

    function update()
    {
        
    }

    function delete()
    {
        $query = "DELETE FROM ajouter WHERE nom_option = :nomOption AND ; formula = :formula;";
        $result = $this->pdo->prepare($query);
        $result->bindValue("formula", $this->formula, PDO::PARAM_INT);
        $result->bindValue("nomOption", $this->nomOption, PDO::PARAM_STR);

        $result->execute();
    }

    
}


