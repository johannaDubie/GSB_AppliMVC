<?php
/**
 * Vue selection fiche de frais
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
?>
<div id="contenu">
    <h3>Selectionner le visiteur : </h3>
    <form action="index.php?uc=suivreFrais&action=afficherFiche" 
          method="post" role="form">
        <input nam="uc" value="suivreFrais" type="hidden"/>
        <input name="action" value="afficherFiche" type="hidden"/>
        <div class="form-group">
            <label for="lstFiche" accesskey="n">Visiteur : </label>
            <select id="lstFiche" name="lstFiche" class="form-control">
                <?php
                foreach ($lesFiches as $uneFiche) {
                    $idVisiteur = $uneFiche['idVisiteur'];
                    $nom = htmlspecialchars($uneFiche['nom']);
                    $prenom = htmlspecialchars($uneFiche['prenom']);
                    $etatV = htmlspecialchars($uneFiche['idEtat']);
                    $mois = ($uneFiche['mois']);
                    $numAnnee = substr($mois, 0, 4);
                    $numMois = substr($mois, 4, 2);
                    $montantValide = ($uneFiche['montantValide']);
                    $dateModif = ($uneFiche['dateModif']);

                    if ($idVisiteur == $visiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo $idVisiteur ?>">
                            <?php echo $prenom . ' ' . $nom . ' ' . ':' . ' ' . $numMois . '/' . $numAnnee . ' (' . $etatV . ')' ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $idVisiteur ?>">
                            <?php echo $prenom . ' ' . $nom . ' ' . ':' . ' ' . $numMois . '/' . $numAnnee . ' (' . $etatV . ')' ?> </option>
                        <?php
                    }
                }
                ?>  
            </select>
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input name="mois" value="<?php echo $mois ?>" type="hidden">
            <input name="etat" value="<?php echo $etatV ?>" type="hidden">
        </div>
    </form>
</div>