<?php

/**
 * Suivi des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Johanna DUBIE <jonanadu38@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'choisirFicheDeFrais':
        $lesFiches = $pdo->getLesFicheFraisApayer();
        include 'vues/v_selectionFiche.php';
        break;
    case 'afficherFiche':
        $lesFiches = $pdo->getLesFicheFraisApayer();
        include 'vues/v_selectionFiche.php';

        //Récupération du visiteur :
        $idVisiteur = filter_input(INPUT_POST, 'lstFiche', FILTER_SANITIZE_STRING);
        //Récupération du mois: 
        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois); //récupération des différentes infos des fiches
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $mois); //Récupération du nombre de justificatifs.

        $prenom = $pdo->getPrenom($idVisiteur);
        $nom = $pdo->getNom($idVisiteur);
        include 'vues/v_suiviDesFiches.php';

        break;
    case 'changerEtat':
        //Récupération des valeurs nécessaires:
        $lesFiches = $pdo->getLesFicheFraisApayer();
        $idVisiteur = filter_input(INPUT_POST, 'lstFiche', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $etat = $pdo->getEtatFiche($idVisiteur, $mois);
        $prenom = $pdo->getPrenom($idVisiteur);
        $nom = $pdo->getNom($idVisiteur);


        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois); //récupération des différentes infos des fiches
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $mois); //Récupération du nombre de justificatifs.
        //Si la fiche est "MP":
        if ($etat == "MP") {
            $newEtat = "RB"; //alors elle passe à l'état "remboursée"
        } else { //Si elle est "VA" :
            $newEtat = "MP"; //Alors elle passe à l'état "mise en paiement"
        }

        //MAJ de l'état de la fiche et de la date:
        $pdo->majEtatFicheFrais($idVisiteur, $mois, $newEtat);
        //Affichage d'un message expliquant ce qui a eu lieu:
        if ($newEtat == "MP") {
            echo "La fiche de ".$nom." ".$prenom. " a bien été mise en paiement ";
        } else {
            echo "La fiche de ".$nom." ".$prenom. " frais a bien été remboursée ";
        }

        //retour au choix des fiches à changer
        $lesFiches = $pdo->getLesFicheFraisApayer();
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois); //récupération des différentes infos des fiches

        include 'vues/v_selectionFiche.php';

        break;
}