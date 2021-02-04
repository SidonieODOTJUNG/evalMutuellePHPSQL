<?php

function showAccueil() {
    return ["templates" => "templates/accueil.php"];
}

function showFormule() {
    return ["templates" => "templates/formule.php"];
}

function showFormCo() {
    return ["templates" => "templates/formco.php"];
}

// $size : longueur du mot passe voulue
function genere_password($size)
{
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

    for($i=0;$i<$size;$i++)
    {
        $password = ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $password;
}

function crea_compte() {

    $user = new Models\User();
    // penser au regex
    $user->setMail($_POST["mail"]);
    $pwd = genere_password(10);
    //ne fonctionne pas en localhost, pas pu tester la fonction
    mail($_POST["mail"], 'Votre mot de passe', $pwd);
    $user->setPwd(password_hash($pwd, PASSWORD_DEFAULT));
    $user->setRole("client");
    // var_dump($user);
    $user->insert();

    $userId = $user->getUserId();
    // var_dump($userId);

    $client = new Models\Client();
    //penser au regex
    $client->setNumSecu($_POST["secu"]);
    $client->setClientName($_POST["nom_client"]);
    $client->setClientFirstname($_POST["prenom_client"]);
    $client->setAddress($_POST["adresse"]);
    $client->setNbFamilyMember($_POST["nb_membres"]);
    $client->setClientBirth($_POST["naissance_client"]);
    $client->setPhone($_POST["tel"]);
    $client->setCounselorId($_POST["id_conseiller"]);
    $client->setFormula($_POST["formule"]);
    $client->setUserId($userId);
    // var_dump($client);
    $client->insert();
    
    header("Location:index.php?page=showespaceconseiller");
    exit;
}

// preg_match("", trim($_POST[""]))
function ajout_membre(){
    $member = new Models\Member();
    // attention regex secu trouvée sur internet pas eu le temps de la tester
    if(preg_match("#^[A-Za-z-àâäéèêëïîôöùûüçæÀÁÂÃÄÆÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜŒœ'( )]{1,50}$#", trim($_POST["nom_membre"])) && preg_match("#^[A-Za-z-àâäéèêëïîôöùûüçæÀÁÂÃÄÆÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜŒœ'( )]{1,50}$#", trim($_POST["prenom_membre"])) && preg_match("#^(?:0[1-9]|1[0-2]|20|3[0-9]|4[0-2]|[5-9][0-9])$#", trim($_POST["secu"]))) {
        $member->setMemberName($_POST["nom_membre"]);
        $member->setMemberFirstname($_POST["prenom_membre"]);
        $member->setMemberBirth($_POST["naissance_membre"]);
        $member->setNumSecu($_POST["secu"]);  

        $member->insert();
    } else{
        echo "Données entrées incorrects";
    }
    
    header("Location:index.php?page=showespaceconseiller");
    exit;
}
    
function connect_user() {

    require_once "Models/User.php";
    require_once "Models/Counselor.php";
    require_once "Models/User.php";


    if($_POST["role"]=="conseiller") {
        $userCo = new Models\User();
        $conseiller = new Models\Counselor();
        $client = new Models\Client();

        if ($userCo->setPwd($_POST["mdp"] ) == $userCo->getPwd()) {
            session_start();
            $_SESSION["user"] = $_POST["mail"];
            $_SESSION["mdp"] = $_POST["mdp"];

            $userCo = $userCo->getUserId();
            if ($userCo = $conseiller->getUserId()) {
                $_SESSION["nom"] = $conseiller->getCounselorFirstname;
            }
            
            header("Location:index.php?page=showespaceconseiller");
            exit; 
        }else {
            header("Location:index.php?page=showformco");
            exit; 
        }
    } if ($_POST["role"]=="client") {
        $userCo = new Models\User($_POST["mail"], $_POST["mdp"] );
        if (password_verify($userco->getPwd(),$_POST["mdp"])) {
            session_start();
            $_SESSION["user"] = $_POST["mail"];
            $_SESSION["mdp"] = $_POST["mdp"];
            
            $userCo = $userCo->getUserId();
            if ($userCo = $client->getUserId()) {
                $_SESSION["nom"] = $conseiller->getClientFirstname;
            }
            
            header("Location:index.php?page=showespaceclient");
            exit; 
        }else {
            header("Location:index.php?page=showformco");
            exit; 
        }
    }
    
}

function deconnect_user() {
    $_SESSION = [];
    session_destroy();

    header("Location:index.php?page=accueil");
    exit;
}

function showEspaceClient() {
    return ["templates" => "templates/espaceclient.php"];
}

function showEspaceConseiller() {
    return ["templates" => "templates/espaceconseiller.php"];
}

function showRDV() {
    return ["templates" => "templates/RDV.php"];
}

function showInsertClient() {
    return ["templates" => "templates/formnouveauclient.php"];
}

function showInsertMembre() {
    return ["templates" => "templates/formmember.php"];
}

function showMessageClient() {
    return ["templates" => "templates/messageclient.php"];
}

function showReponseConseiller() {
    return ["templates" => "templates/messageconseiller.php"];
}