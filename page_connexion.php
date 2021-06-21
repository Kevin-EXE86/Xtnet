<?php 
$title = 'Connexion';
require("include/connecbdd.php");
require_once("include/header_0.php");
?>

		<div id="bloc_page">
			<div id="login">
				<h3>Connexion</h3>
				
				<div class="form">
					<form method="post" action="verif_connexion.php">
						<label for="UserName"> UserName </label> <br>
						<input class="input" type="text" name="username" id="UserName"> <br>
						<label for="votremdp"> Password </label> <br>
						<input class="input" type="password" name="password" id="Password"> <br>
						<a href="mdp_oublie.php"> Mot de passe oublié ? </a><br>
						<input class="bouton_connexion" type="submit" value="Connexion"> <br>
					</form>
				</div>
				
				<?php 
				
				if(!empty($_GET['err']) && $_GET['err']== "password")
				{
					echo '<p style="color: rgb(252, 116, 106);"><strong> Mot de passe ou pseudo incorrect ! </strong></p>'; 
				}

								if(!empty($_GET['ok']) && $_GET['ok']== "password")
				{
					echo '<p style="color: lightgreen;"><strong> Votre mot de passe a bien été modifié ! </strong> </p>'; 
				}

				
				if(!empty($_GET['err']) && $_GET['err']== "champs")
				{
					echo '<p style="color: red;"><strong>Veuillez remplir tous les champs.</strong></p>';  
				}	
				?>

				<div class ="nouveaumembre">
					<p> Nouveau membre ?<br>
						<button class="bouton_connexion" onclick= "window.location.href ='page_inscription.php';">Inscription</button> 
					</p>
				</div>
			</div>
		</div>
<?php 
require_once('include/footer.php');
?> 
