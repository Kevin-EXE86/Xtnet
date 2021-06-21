<?php
session_start();
$title = 'Accueil Membre';
require("include/connecbdd.php");
require_once("include/header.php");
?>

		
		<div id="presentation">
			<h1> GBAF </h1>
			<ul>
				<p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :<br/><br/>
				<li>BNP Paribas</li> 
				<li>La Banque Postale</li>
				<li>Crédit Mutuel-CIC</li> 
				<li>Crédit agricole</li> 
				<li>Société Générale</li> 
				<li>BPCE</li><br/><br/>
				Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br/>
				Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.<br/> Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.<br/> C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
			</ul>
			
		</div>
		
		
		<div id="bloc_acteurs">
			<div id="bloc_titre">
				<h2> Acteurs et Partenaires </h2>
					<p> Les différents acteurs du système bancaire français :</p>
			</div>
			
			<div id="acteurs">
				<?php
				$req = $bdd->query('SELECT * FROM acteurs');
				
				while($donnees = $req->fetch())
				{
				?>	
				<div class="styleacteur">
					<img class="logo_acteur_mini" src="<?php echo $donnees['logo'];?>" alt="acteur_logo_mini"/> <br/>
					<div class="texteacteur">
						<?php 
							echo '<h2>' . $donnees['acteur'] . '</h2>';
							echo substr($donnees['description'], 0, 100).'...'; 
						?>
						<button class="bouton_suite" onclick= "window.location.href='acteur.php?id=<?php echo $donnees['id_acteur']; ?>';">Afficher la suite
						</button> 
					</div>	
				</div>	
				<?php 
				} 
				?>			
			</div>
		</div>
<?php 
require_once('include/footer.php');
?> 	
