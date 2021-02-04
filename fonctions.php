<?php

// fonctions utilitaires

// lorsqu'on nomme : namespace Models;

/*  lors du chargement automatique des classes : 
    dans l'index, la classe prendra automatiquement le nom Models devant
    ici, on va effectuer une manipulation qui permettra d'appeller la classe comme avant : 
*/

spl_autoload_register(function($class) {
    // echo $class;
        //Models\Label

    // on indique qu'on veut remplacer le /
    $class = str_replace("\\", "/", $class);
        //Models/Label

    // on met la première lettre en minuscule
    $class = lcfirst($class);
        // models/Label

    // on concatène le .php
    if(file_exists("$class.php")) {
        require_once "$class.php";
        // models/Label.php
        return true;
    }

    // sinon on lance une nouvelle exception
    throw new Exception ("Une erreur est survenue lors du chargement!");
});


function strip_xss(&$value) {
    // on passe la valeur par référence avec &, pour permettre de modif directement les valeurs au lieu de créer une copie

    if(is_array($value)) {    // soit c'est un tableau et alors on répète l'op
        array_walk($value, "strip_xss" );            // permet d'appliquer le deuxième param à l'ensemble des éléments du tableau
    } else if(is_string($value)) {
        $value = strip_tags($value);            // on supprime les balises avec des exceptions donc on s'en sert lorsqu'on en a besoin
                                                // affiche toute la chaine de caractère
    }

}

function ch_entities(&$value) {
    // on passe la valeur par référence avec &, pour permettre de modif directement les valeurs au lieu de créer une copie

    if(is_array($value)) {    // soit c'est un tableau et alors on répète l'op
        array_walk($value, "ch_entities" );            // permet d'appliquer le deuxième param à l'ensemble des éléments du tableau
    } else if(is_string($value)) {
        $value = htmlentities($value);            // affiche toute la chaine de caractère
                                                
    }

}