<?php
session_start();
require("include/connecbdd.php");
   
    $req = $bdd->prepare('SELECT id_user, nom, prenom, password FROM users WHERE username = ?');
    $req->execute(array($_POST['username']));
    $resultat = $req->fetch();

    if (!empty($_POST['username']) AND !empty($_POST['password'])) 
    {
        
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
        
        if (!$isPasswordCorrect) 
        {
            header('Location: page_connexion.php?err=password');    
        }
        else 
        {
            $_SESSION['id_user'] = $resultat['id_user'];
            $_SESSION['pseudo'] = $_POST['username'];
            $_SESSION['nom']= $resultat['nom'];
            $_SESSION['prenom']= $resultat['prenom'];
            header('Location: index_user.php');
        }
    }
    else
    {
        header('Location: page_connexion.php?err=champs');
    }        
?>