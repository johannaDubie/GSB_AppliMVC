<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}
//action demandée : se connecter
switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';//afficher la page ou on peut se connecter
    break;

case 'valideConnexion': //on demande à valider la connection
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);//on rentre le login
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);//on rentre le mot de passe
    $visiteur = $pdo->getInfosVisiteur($login, $mdp);//recherche dans la base de données pour verifier que les infos rentrées sont valides
    
    if (!is_array($visiteur)) { //Si ça n'existe pas ds la base de données
        ajouterErreur('Login ou mot de passe incorrect');//alors on ajoute ce message d'erreur
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
    } 
    else { //sinon, si c'est valide et que ça existe
        $id = $visiteur['id']; //alors on recupere l'id, le nom et le prenom depuis la base de données
        $nom = $visiteur['nom'];
        $prenom = $visiteur['prenom'];    
        $typepersonnel = $visiteur['typepersonnel'];  
        connecter($id, $nom, $prenom, $typepersonnel);
        
        if($typepersonnel == 'c'){
            include 'vues/v_sommaireC.php';
        }else{
            include 'vues/v_accueil.php';
        }
        header('Location: index.php');
        
    }
    /*
     * A rajouter :
     * 
     * quand on verifie dans la base de données que le mdp et le login rentrés sont bien réels,
     * une fois qu c'est validé, il faut qu'on determine si c'est un visiteur simple ou
     * alors un comptable.
     * Si c'est un simple employé, alors on affiche les cases qui correspondent,
     * mais si c'est un comptable, alors on affiche les cases qui lui corrspondent à lui.
     * L'affichage ne sera pas le même pour les deux.
     * 
     * 
     * 
     * Fiches à créer:
     * 
     * v_accueilC
     * ...ect. Les mêmes que pour les visiteurs normaux. Mais pour les comptables. 
     * cad que le principe de contruction de la page de code sera le même. Apres, c'est 
     * a moi de créer ce qu'il faut sur chaque page, derriere chaque bouton pour
     * que cela corresponde aux demandes, aux consignes.
     * 
     */
    break;
default:
    include 'vues/v_connexion.php';
    break;
}
