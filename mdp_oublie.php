<?php
ob_start();
$title = 'Mot de passe oublié';
require("include/connecbdd.php");
require_once("include/header_0.php");
session_start();


if (isset($_POST['submit']))
{    
    $username = htmlspecialchars($_POST['username']);
    $reponse = htmlspecialchars($_POST['reponse_secrete']);

    
    if (!empty($_POST['username']) AND !empty($_POST['reponse_secrete']))
    {
        $req = $bdd->prepare('SELECT * FROM users WHERE username = :username');
        $req->execute(array(
        'username' => $username));
        $resultat = $req->fetch();

        
        $isAnswerCorrect = (($_POST['username'] == $resultat['username']) AND ($_POST['reponse_secrete'] == $resultat['reponse_secrete']));
        if (!$isAnswerCorrect) 
        { 
            $erreur = '<p style="color: red;"> Données incorrectes !</p>';
        }
        else 
        { 
            
            $_SESSION['id_user'] = $resultat['id_user'];
            $_SESSION['pseudo'] = $resultat['username'];
            $_SESSION['nom']= $resultat['nom'];
            $_SESSION['prenom']= $resultat['prenom'];
            header('Location: mdp_bdd.php');
        }
    }
    else
    {
        $champs = '<p style="color: rgb(255, 0, 0);">Veuillez remplir tous les champs.</p>' ; 
    }       
}
?>

        <div id="login">
            <form class="form" method="post" action="mdp_oublie.php">
                <label for="username"> Votre pseudo </label> <br>
                <input class="input" type="text" name="username" id="username">
                 <br>
                <label for="reponse_secrete">Réponse à la question secrète :</label>
                <input class="input" type="text" name="reponse_secrete" id="reponse_secrete">
                <input class="bouton_connexion" type="submit" value="Valider" name="submit"> <br>
            </form>
            <?php 
            if(isset($erreur)) {echo $erreur;}
            ?>
            <?php 
            if(isset($champs)) {echo $champs;}
            ?>
        </div>
<?php 
require_once('include/footer.php');
?>   
