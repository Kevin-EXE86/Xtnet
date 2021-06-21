<?php
session_start();
$title = 'Paramètres du compte';
require("include/connecbdd.php");
require_once("include/header.php");

if(isset($_SESSION['id_user'])) 
{
   $requser = $bdd->prepare("SELECT * FROM users WHERE id_user = ?");
   $requser->execute(array($_SESSION['id_user']));
   $user = $requser->fetch();
   
      if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) 
      {
         $newnom = htmlspecialchars($_POST['newnom']);
         $insertnom = $bdd->prepare("UPDATE users SET nom = ? WHERE id_user = ?");
         $insertnom->execute(array($newnom, $_SESSION['id_user']));
         $oknom = '<p style="color: rgb(50,205,50);">Votre nom a bien été modifié ! </p>';
      }

      if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) 
      {
         $newprenom = htmlspecialchars($_POST['newprenom']);
         $insertprenom = $bdd->prepare("UPDATE users SET prenom = ? WHERE id_user = ?");
         $insertprenom->execute(array($newprenom, $_SESSION['id_user']));
         $okprenom = '<p style="color: rgb(50,205,50);">Votre prénom a bien été modifié ! </p>';
      }

      if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['username']) 
      {

         $newpseudo = htmlspecialchars($_POST['newpseudo']);
         $reqpseudo = $bdd->prepare('SELECT * FROM users WHERE username = ?');
         $reqpseudo->execute(array($newpseudo));
         $pseudoexist = $reqpseudo->rowCount();

         if($pseudoexist == 0)
         {
         $insertpseudo = $bdd->prepare("UPDATE users SET username = ? WHERE id_user = ?");
         $insertpseudo->execute(array($newpseudo, $_SESSION['id_user']));
         $okpseudo = '<p style="color: rgb(50,205,50);">Votre pseudo a bien été modifié ! </p>';
         }
         else
         {
            $erreurpseudo = '<p style="color: rgb(252, 116, 106);"><strong> Pseudo déjà utilisé ! </strong></p>';
         }
      }

      if(isset($_POST['newquestion']) AND !empty($_POST['newquestion']) AND $_POST['newquestion'] != $user['question_secrete']) 
      {
         $newquestion = htmlspecialchars($_POST['newquestion']);
         $insertquestion = $bdd->prepare("UPDATE users SET question_secrete = ? WHERE id_user = ?");
         $insertquestion->execute(array($newquestion, $_SESSION['id_user']));
         $okquestion = '<p style="color: rgb(50,205,50);">Le nouveau choix de votre question secrète a bien été pris en compte !</p>';
      }

      if(isset($_POST['newreponse']) AND !empty($_POST['newreponse']) AND $_POST['newreponse'] != $user['reponse_secrete']) 
      {
         $newreponse = htmlspecialchars($_POST['newreponse']);
         $insertreponse = $bdd->prepare("UPDATE users SET reponse_secrete = ? WHERE id_user = ?");
         $insertreponse->execute(array($newreponse, $_SESSION['id_user']));
         $okreponse = '<p style="color: rgb(50,205,50);">Votre réponse a bien été modifiée ! </p>';
      }

      if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword'] != $user['password']) 
      {
         $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
         $insertpassword = $bdd->prepare("UPDATE users SET password = ? WHERE id_user = ?");
         $insertpassword->execute(array($newpassword, $_SESSION['id_user']));
         $okpassword = '<p style="color: rgb(50,205,50);">Votre mot de passe a bien été modifié ! </p>';
      }
?>

      <div id="inscription">
         <h3>Paramètres du compte</h3>
            <form class="form" method="post" action="parametres.php">
               <label for="nom">Nom :</label>
               <input class="input" type="text" name="newnom" placeholder="Nom" value="<?php echo $user['nom']; ?>" id="nom" />
               <?php if(isset($oknom)) { echo $oknom; } ?>
               <br /><br />
               <label for="prenom">Prénom :</label>
               <input class="input" type="text" name="newprenom" placeholder="Prénom" value="<?php echo $user['prenom']; ?>" id="prenom" />
               <?php if(isset($okprenom)) { echo $okprenom; } ?>
               <br /><br />
               <label for="pseudo">Pseudo :</label>
               <input class="input" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['username']; ?>" id="pseudo" />
               <?php if(isset($okpseudo)) { echo $okpseudo;}
                     if(isset($erreurpseudo)) { echo $erreurpseudo;} ?> 
               <br /><br />
               <label for="question">Question secrète :</label>
               <select class="input" name="newquestion" id="question">
                  <option value="choix1">Le nom de votre premier animal de compagnie</option>
                  <option value="choix2">La marque de votre voiture préféré</option>
                  <option value="choix3">Le métiers de votre père</option>
                  <option value="choix4">Le nom de votre premier employeur</option>
               </select>
               <?php if(isset($okquestion)) { echo $okquestion; } ?>
               <br/><br/>
               <label for="reponse">Réponse à la question secrète :</label>
               <input class="input" type="text" name="newreponse" placeholder="Réponse à votre question" id="reponse" />
               <?php if(isset($okreponse)) { echo $okreponse; } ?>
               <br /><br />
               <label for="password">Mot de passe :</label>
               <input class="input" type="password" name="newpassword" placeholder="Mot de passe" id="password"/>
               <?php if(isset($okpassword)) { echo $okpassword; } ?>
               <br /><br />
               <input class="bouton_connexion" type="submit" value="Mettre à jour mes données" />
            </form><br/><br/>
      </div>
<?php   
}
else 
{
   header("Location: page_connexion.php");
}
?>
