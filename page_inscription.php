<?php
$title = 'Inscription';
require("include/connecbdd.php");
require_once("include/header_0.php");
?>

		<div id="bloc_page">
			<div id="inscription">
				<h3>Création d'un compte utilisateur</h3> 
				<?php 
				if(!empty($_GET['err']) && $_GET['err']== "pseudo")
				{
					echo '<p style="color: rgb(252, 116, 106);"><strong> Pseudo déjà utilisé ! </strong></p>'; 
				}
				
				if(!empty($_GET['err']) && $_GET['err']== "champs")
				{
					echo '<p style="color: rgb(252, 116, 106);"><strong> Veuillez remplir tous les champs. </strong></p>';  
				}
				?>
				<form class="form" method="post" action="inscription_bdd.php">
					Votre nom :
					<input class="input" type="text" name="nom">
					Votre prénom :
					<input class="input" type="text" name="prenom" >
					Votre UserName ou pseudo :
					<input class="input" type="text" name="username" minlength="3" maxlength="12">
					Votre password :
					<input class="input" type="password" name="password" minlength="6">
					Votre question secrète : <br>
					<select class="input" name="choix">
						<option value="selectionner une reponse">--Selectionner une réponse--</option>
						<option value="choix1">Le nom de votre premier animal de compagnie</option>
						<option value="choix2">La marque de votre voiture préféré</option>
						<option value="choix3">Le métiers de votre père</option>
						<option value="choix4">Le nom de votre premier employeur</option>
					</select> <br>
					Réponse :
					<input class="input" type="text" name="reponse">
					<input class="bouton_connexion" type="submit" name="valider" value="Valider">
				</form>
			</div>
		</div>
<?php 
require_once('include/footer.php');
?> 
