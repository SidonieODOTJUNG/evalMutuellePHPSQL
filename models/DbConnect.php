<?php

namespace Models;
use PDO;
// permet de ne pas renvoyer d'erreur dans le constructeur

abstract class DbConnect implements Crud {

        // propriété $pdo = co serveur/DB
        protected $pdo;

        // le constructeur 
        // avec instanciation objet pdo
        public function __construct() {
            $this->pdo = new PDO(DATABASE, LOGIN, PASSWORD);
        }  
}