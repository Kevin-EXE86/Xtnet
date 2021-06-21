<?php
require("include/connecbdd.php");
	
	if (isset($_POST['valider'])) 
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']) ;
		$username = htmlspecialchars($_POST['username']);
		$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$question = ($_POST['choix']);
		$reponse = htmlspecialchars($_POST['reponse']);
		
		if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['choix'] AND !empty($_POST['reponse'])))
		{		
			 
			$requsername = $bdd->prepare("SELECT id_user FROM users WHERE username = ?");
			$requsername->execute(array($username));
			$usernameexist = $requsername->rowcount();
			if ($usernameexist == 0) 
			{
				
				$req = $bdd->prepare('INSERT INTO users(nom, prenom, username, password, question_secrete, reponse_secrete) VALUES(?,?,?,?,?,?)');
				$req->execute(array($nom, $prenom, $username, $pass_hash, $question, $reponse));
				
				header('Location: page_connexion.php'); 
			}        
			else 
			{
				header('location: page_inscription.php?err=pseudo');
			}
		}
		else
		{
			header('location: page_inscription.php?err=champs');
		}
	}
?>
