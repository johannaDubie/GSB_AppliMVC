<?php

/**
 * Gestion des frais
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
switch ($action) {
    case 'selectionnerVisiteur':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        include 'vues/v_listeVisiteurs.php';
        break;

    case 'selectionnerMois':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteurs.php'; // Pour afficher de nouveau le choix fait à l'étape précédente
        $lesMois = $pdo->getLesMoisDisponibles($visiteurASelectionner);
        include 'vues/v_listeDesMois.php';
        break;

    case 'afficherFicheFrais':
        $lesVisiteurs = $pdo->getLesVisiteurs(); //Récupération de la liste de visiteurs
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING); //Enregistrement du visiteur selectionné
        include 'vues/v_listeVisiteurs.php'; // Pour afficher de nouveau le choix fait à l'étape précédente
        $idVisiteur = $visiteurASelectionner; //$id correspondant à celui du visiteur selectionné

        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur); //récupération de la liste des mois
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING); //enregistrement du mois selectionné
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php'; //Pour laisser le choix affiché
        /*
         * j'ai récupéré $leMois et $idVisiteur. 
         * Je peux donc en théorie utilier les fonctions ci-dessous.
         */
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois); //Récupération des frais hors forfaits
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois); //récupération des frais forfaitisés
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois); //récupération des différentes infos des fiches
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois); //Récupération du nombre de justificatifs.

        include 'vues/v_afficherFrais.php';
        break;

    case 'validerMAJFraisForfait':
        $lesVisiteurs = $pdo->getLesVisiteurs(); //Récupération de la liste de visiteurs
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING); //Enregistrement du visiteur selectionné
        include 'vues/v_listeVisiteurs.php'; // Pour afficher de nouveau le choix fait à l'étape précédente
        $idVisiteur = $visiteurASelectionner; //$id correspondant à celui du visiteur selectionné

        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur); //récupération de la liste des mois
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING); //enregistrement du mois selectionné
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php'; //Pour laisser le choix affiché
        /*
         * j'ai récupéré $leMois et $idVisiteur. 
         * Je peux donc en théorie utilier les fonctions ci-dessous.
         */
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois); //Récupération des frais hors forfaits
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois); //récupération des frais forfaitisés
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois); //récupération des différentes infos des fiches
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois); //Récupération du nombre de justificatifs.


        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);

        include 'vues/v_afficherFrais.php';
        break;

    case 'reinitialiserFraisHF':
        /*
         * Récupération de toutes les variables nécessaires pour
         * garder la vue complète et le choix du visiteur/mois
         * à chaque fois qu'on clique sur un bouton
         */
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteurs.php';
        $idVisiteur = $visiteurASelectionner;
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois);


        break;

    case 'supprimerFraisHF':
        /*
         * Récupération de toutes les variables nécessaires pour
         * garder la vue complète et le choix du visiteur/mois
         * à chaque fois qu'on clique sur un bouton
         */
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteurs.php';
        $idVisiteur = $visiteurASelectionner;
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois);


        //Récupération des infos sur les frais HF
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $lesIdHF = $pdo->getLesIdHorsFrais($idVisiteur, $leMois);

        //Récupération de l'id du frais HF qu'on souhaite supprimer
        $idFraisHF = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);

        /*
         * Pour ce fraisHF, on lui change son statut:
         * il passe à "REFUSE":
         */        
        $pdo -> modifieStatutRefuse($idFraisHF, $idVisiteur, $leMois);  
        
        /* On utilise la fonction majFraisHF, qui met à jour la 
         * base de données en rajoutant le statut "REFUSE"
         */
        $pdo-> majFraisHF($idVisiteur, $leMois, $lesFrais);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        /*
         * Et le statut doit apparaitre dans la case du libellé,
         * ça se fait automatiquement depuis la vue
         */
        include 'vues/v_afficherFrais.php';

        break;

    case 'reporterFraisHF':
        /*
         * Récupération de toutes les variables nécessaires pour
         * garder la vue complète et le choix du visiteur/mois
         * à chaque fois qu'on clique sur un bouton
         */
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteurs.php';
        $idVisiteur = $visiteurASelectionner;
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois);

        /*
         * Récupération de l'id du fraisHF qu'on souhaite modifier
         * On change son statut : il passe à "REPORTE"
         * 
         *  On utilise la fonction majFraisHF, qui met à jour la 
         * base de données en rajoutant le statut "REPORTE"
         * 
         * On affiche ce statut dans la case, avant le libellé.
         * 
         * 
         * Ou alors, on le déplace simplement sur la fiche suivante,
         * en le supprimant de cette fiche là...à voir avec
         * la fiche descriptive, plus en détail.
         */
        
        /*
         * on déplace ce frais pour le mois suivant.
         * Donc si la fiche n'est pas créée, on la crée.
         * Si elle est créée, on ajoute une ligne de frais HF
         * avec ce frais là.
         * La fiche aura les valeur à 0 pour les forfaitisés, 
         * et sera dans l'état "saisie en cours" (ds le cas où new fiche)
         */



        break;

    case 'validationFicheFrais':
        /*
         * Récupération de toutes les variables nécessaires pour
         * garder la vue complète et le choix du visiteur/mois
         * à chaque fois qu'on clique sur un bouton
         */
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        include 'vues/v_listeVisiteurs.php';
        $idVisiteur = $visiteurASelectionner;
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        include 'vues/v_listeDesMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois);

        //L'état de la fiche passe à "validé"
        //Et MAJ de la date de modification de la fiche 

        break;
}
