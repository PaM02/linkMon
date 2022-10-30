<?php 
// Connexion à la base de données

include("bdd.php"); 

//  Récupération de l'utilisateur et de son pass hashé//htmlspecialchars eliminer les attaques
$username = htmlspecialchars($_POST['username']);
$passwordUser = htmlspecialchars($_POST['passwordUser']);

$req = $bdd->prepare('SELECT idUser, passwordUser,profilUser, nomUser, prenomUser,site FROM utilisateurs WHERE username = :username');
$req->execute(array(
    'username' => $username));

$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($passwordUser, $resultat['passwordUser']);

//si le pseudo n'est pas bon
if (!$resultat)
{   
    // Redirection du visiteur vers la page index
    header('Location: ../dist/pageLogin.php?erreur=0');
}
else
{
    if ($isPasswordCorrect) {

        session_start();
        
        //les variables sont créees  dans la page login 
        $_SESSION['idUser'] = $resultat['idUser'];
        $_SESSION['profilUser'] = $resultat['profilUser'];
        $_SESSION['username'] = $username;
        $_SESSION['host']= $servername;
        $_SESSION['root']=$root;
        $_SESSION['DB']= $db;
        $_SESSION['pwd']= $pwd;
        
        if (isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['profilUser'])){
            header('Location: ../accueil.html');
        }
        
    }
    else {

        // Redirection du visiteur vers la page index
        header('Location: ../dist/pageLogin.php?erreur=0'); 
        
    }
}

/*

//mettre ceci sur toute les pages pour indiquer au membre qu'il est connecté
<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
*/
