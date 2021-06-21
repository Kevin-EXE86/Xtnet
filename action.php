<?php
session_start();
$title = 'Like';
require("include/connecbdd.php");
require_once("include/header.php");


if(isset($_GET['t'], $_GET['id'], $_SESSION['id_user']) AND !empty($_GET['t']) AND !empty($_GET['id']) AND !empty($_SESSION['id_user'])) 
{
    
    $getid = (int) $_GET['id'];
    $gett = (int) $_GET['t'];
    $sessionid = (int) $_SESSION['id_user'];

    
    $check = $bdd->prepare('SELECT id_acteur FROM acteurs WHERE id_acteur =?');
    $check->execute(array($getid));
    
    
    if($check->rowCount() == 1) 
    {
        
        if($gett == 1) 
        {   
            
            $check_like = $bdd->prepare('SELECT id_like FROM likes WHERE acteur_id = ? AND user_id = ?');
            $check_like->execute(array($getid, $sessionid));
            
            $deldislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = ? AND user_id = ?');
            $deldislike->execute(array($getid, $sessionid));
            
            
            if($check_like->rowCount() == 1) 
            { 
                $dellike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = ? AND user_id = ?');
                $dellike->execute(array($getid, $sessionid));
            }
            
            else 
            {
                $ins = $bdd->prepare('INSERT INTO likes (acteur_id, user_id) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        } 
        
        elseif ($gett == 2) 
        {
            
            $check_like = $bdd->prepare('SELECT id_dislike FROM dislikes WHERE acteur_id = ? AND user_id = ?');
            $check_like->execute(array($getid, $sessionid));
            
            $dellike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = ? AND user_id = ?');
            $dellike->execute(array($getid, $sessionid));
            
            
            if($check_like->rowCount() == 1) 
            { 
                $deldislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = ? AND user_id = ?');
                $deldislike->execute(array($getid, $sessionid));
            } 
            
            else 
            {
                $ins = $bdd->prepare('INSERT INTO dislikes (acteur_id, user_id) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        }
        
        header('Location: acteur.php?id=' .$getid);
    } 
    else 
    {
        exit('Erreur Fatale');
    }       
} 
else 
{
    exit('Erreur Fatale. <a href="index_user.php">Revenir à la page d\'accueil</a>');
}
?>
