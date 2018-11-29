<?php

/**
 * Validation des frais
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
        include 'vues/v_afficherFrais.php';
        break;

    case 'supprimerEtReporterFraisHF':
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

        //si je clic sur "refuser":
        if (isset($_POST['SupprIdFraisHF'])) {
            //Récupération de l'id du frais HF qu'on souhaite supprimer
            $idFraisHF = filter_input(INPUT_POST, 'SupprIdFraisHF', FILTER_SANITIZE_STRING);
            //Son satttu passe à "refusé"
            $pdo->modifieStatutRefuse($idFraisHF, $idVisiteur, $leMois);
        }

        //Si je clic sur "reporter":
        if (isset($_POST['ReportIdFraisHF'])) {
            //Récupération de l'idFraisHF qu'on souhaite supprimer
            $idFraisHF = filter_input(INPUT_POST, 'ReportIdFraisHF', FILTER_SANITIZE_STRING);

            //Obtention du mois suivant:
            $moisSuivant = getMoisSuivant($leMois);
            //Première saisie du mois ?
            if ($pdo->estPremierFraisMois($idVisiteur, $moisSuivant)) {
                //Créaion de la fiche de frais:
                $pdo->creeNouvellesLignesFrais($idVisiteur, $moisSuivant);
            }
            //Récupération des différentes données du fraisHF:
            $libelle = $pdo->getLibelleFraisHF($idFraisHF, $idVisiteur, $leMois);
            $dateFrais = getNewMois($moisSuivant);
            $montant = $pdo->getMontantFraisHF($idFraisHF, $idVisiteur, $leMois);
            //Création du frais HF:
            $pdo->creeNouveauFraisHorsForfait($idVisiteur, $moisSuivant, $libelle, $dateFrais, $montant);
            //Suppression de ce frais du mois en cours de saisi:
            $pdo->supprimerFraisHorsForfait($idFraisHF);
        }

        //Pour tous :
        //MAJ des frais du mois en cours de saisie:
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $pdo->majFraisHF($idVisiteur, $leMois, $lesFrais);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        include 'vues/v_afficherFrais.php';

        break;


    case 'majNbJustificatifs':
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

        //maj du nb de justificatifs lors du clic sur le bouton
        $newNbJustificatifs = filter_input(INPUT_POST, 'nbJustificatifs', FILTER_SANITIZE_STRING);
        $pdo->majNbJustificatifs($idVisiteur, $leMois, $newNbJustificatifs);
        $nbJustificatifs = $pdo->getNbJustificatifs($idVisiteur, $leMois);

        include 'vues/v_afficherFrais.php';

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
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);

        //Récupération des totaux des frais:
        $totalFHF = $pdo->totalFraisHF($idVisiteur, $leMois);
        $totalForfait = $pdo->totalFraisForfait($idVisiteur, $leMois);
        //Conversion en entier ?
        //
        //
        $sommeValidee = $totalForfait + $totalFHF;
        //maj du montant Validé :
        $pdo->majMontantValide($idVisiteur, $leMois, $sommeValidee);
        //maj de la fiche de frais:
        $etat = 'VA';
        $pdo->majEtatFicheFrais($idVisiteur, $leMois, $etat);

        break;
    
}
