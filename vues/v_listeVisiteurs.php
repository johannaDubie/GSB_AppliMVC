<?php
/**
 * Vue Liste des visiteurs
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
?>
<div id="contenu">
    <h2>
        Validation des fiches de frais
    </h2>
    <h3>Selectionner le visiteur : </h3>
    <form action="index.php?uc=validerFrais&action=selectionnerMois" 
          method="post" role="form">
        <input nam="uc" value="validerFrais" type="hidden"/>
        <input name="action" value="selectionnerVisiteur" type="hidden"/>
        <div class="form-group">
            <label for="lstVisiteurs" accesskey="n">Visiteur : </label>
            <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                <?php
                foreach ($lesVisiteurs as $unVisiteur) {
                    $id = $unVisiteur['id'];
                    $nom = $unVisiteur['nom'];
                    $prenom = $unVisiteur['prenom'];
                    if ($id == $visiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo $id ?>">
                            <?php echo $prenom . ' ' . $nom ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $id ?>">
                            <?php echo $prenom . ' ' . $nom ?> </option>
                        <?php
                    }
                }
                ?>    
            </select>
        </div>
        <input id="ok" type="submit" value="Valider" class="btn btn-success" 
               role="button">
    </form>
</div>




