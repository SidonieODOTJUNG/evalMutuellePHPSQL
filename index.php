<?php

require_once "controlers.php";
require_once "fonctions.php";
require_once "conf/global.php";


// le pont d'entrée utilisateur
// $_REQUEST récupère toutes les données : $_GET, $_POST et $_COOKIE
$page = (isset($_GET["page"]))? $_GET["page"] : "accueil";


// le routage 

switch($page) {
    case "accueil" : $templates = showAccueil();
    break;
    case "showformule" : $templates = showFormule();
    break;
    case "showformco" : $templates = showFormCo();
    break;
    case "connection" : connect_user();
    break;
    case "deconnection" : deconnect_user();
    break;
    case "showespaceclient" : $templates = showEspaceClient();
    break;
    case "showespaceconseiller" : $templates = showEspaceConseiller();
    break;
    case "showRDV" : $templates = showRDV();
    break;
    case "showinsertclient" : $templates = showInsertClient();
    break;
    case "creationcompte" : crea_compte();
    break;
    case "showinsertmember" : $templates = showInsertMembre();
    break;
    case "creationmembre" : ajout_membre();
    break;
    case "showmessageclient" : $templates = showMessageClient();
    break;
    case "showrponseconseiller" : $templates = showReponseConseiller();
    break;
    default: $template = showAccueil();
    break;

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="maquette/style.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    
    <title>Ma Mutuelle qui déchire</title>
</head>
<body>

    <header>

            <h1 class="titre_header">La mutuelle qui déchire...</h1>

            <?php require_once $templates["templates"]; ?> 




</body>
</html>