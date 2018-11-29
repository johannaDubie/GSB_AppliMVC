<?php
/**
 * Gestion de l'accueil
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
    
if ($estConnecte && isset($typepersonnel)) 
    {
    if ( $typepersonnel !== 'c'){
        include 'vues/v_accueil.php';
    }
    else
    {
        if($typepersonnel =='c'){
            include 'vues/v_accueilC.php';
        }
    }
} else {
    include 'vues/v_connexion.php';
}