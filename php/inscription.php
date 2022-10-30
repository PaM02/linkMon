<?php 

// Connexion à la base de données

include("bdd.php"); 

// Vérification de la validité des informations

// Hachage du mot de passe

$prenom = htmlspecialchars($_POST['prenom']);
$nom = htmlspecialchars($_POST['nom']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$passwordRepeat = htmlspecialchars($_POST['passwordRepeat']);

if ($password != $passwordRepeat) {
	# code...
	// Redirection du visiteur vers la page index
        header('Location: ../dist/register.php?erreur=0'); 
}
else{
	
		$pass_hache = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

		// Insertion
		$req = $bdd->prepare('INSERT INTO utilisateurs (username,  nomUser,  prenomUser, passwordUser) VALUES(:username, :nomUser, :prenomUser, :passwordUser)');
		$req->execute(array(
			'username' => $username,
			'nomUser' => $nom,
			'prenomUser' => $prenom,
			'passwordUser' => $pass_hache
		    ));

		// Redirection du visiteur vers la page du minichat
		header('Location: ../dist/pageLogin.php');

}

?>