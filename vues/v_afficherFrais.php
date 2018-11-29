<?php
/**
 * Vue des frais
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
<hr>
<div class="row">
    <?php
    //Liste des éléments forfaitisés
    ?>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=validerFrais&action=validerMAJFraisForfait" 
              role="form">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="4" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit" 

                        onclick="return confirm('Frais mis à jour');"
                        href="index.php?uc=validerFrais&action=validerMAJFraisForfait="
                        >Corriger</button>
                <button class="btn btn-danger" type="reset"
                        >Réinitialiser</button>
                <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                <input name="lstMois" value="<?php echo $moisASelectionner; ?>" type="hidden">

            </fieldset>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <?php
    /*
     * Boîte avec les fraits hors forfaits modifiables
     */
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <form method="post" 
              action="index.php?uc=validerFrais&action=supprimerEtReporterFraisHF" 
              role="form">
            <table class="table table-bordered table-responsive">

                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $statut = $unFraisHorsForfait['statut'];
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
                        ?>           
                        <tr>
                    <input class="form-control" name="id" type="hidden" value="<?php echo $id ?>">

                    <td> 
                        <div class="form-group">
                            <input type="text" id="idFrais" 
                                   name="lesFrais[<?php echo $id ?>]"
                                   size="6" maxlength="10" 
                                   value="<?php echo $date ?>" 
                                   class="form-control">
                        </div>

                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" id="idFrais" 
                                   name="lesFrais[<?php echo $id ?>]"
                                   size="20" maxlength="50" 
                                   value="<?php echo $statut . " : " . $libelle ?>" 
                                   class="form-control">
                        </div>
                    </td>
                    <td><div class="form-group">
                            <input type="text" id="idFrais" 
                                   name="lesFrais[<?php echo $id ?>]"
                                   size="3" maxlength="6" 
                                   value="<?php echo $montant ?>" 
                                   class="form-control">
                        </div></td>
                    <td>
                        <button class="btn btn-danger" type="submit" href="index.php?uc=validerFrais&action=supprimerFraisHF&idFraisHF=<?php echo $id ?>"
                                role="form" name="SupprIdFraisHF" value="<?php echo $id ?>"
                                onclick="if (confirm('Voulez-vous vraiment supprimer ce frais?')) {
                                            this.form.submit();
                                        } else {
                                            return false;
                                        }
                                ">Supprimer</button>


                        <button class="btn btn-success" type="submit" href="index.php?uc=validerFrais&action=reporterFraisHF&idFraisHF=<?php echo $id ?>"
                                role="form" name="ReportIdFraisHF" value="<?php echo $id ?>"
                                onclick="if (confirm('Voulez-vous vraiment reporter ce frais?')) {
                                            this.form.submit();
                                        } else {
                                            return false;
                                        }
                                ">Reporter</button>

                        <button class="btn btn-danger" type="reset" href="index.php?uc=validerFrais&action=ReinitialiserFraisHF&idFraisHF=<?php echo $id ?>" 
                                >Réinitialiser</button>                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>  
                <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
                <input name="lstMois" value="<?php echo $moisASelectionner; ?>" type="hidden">

            </table>
        </form>
    </div>
</div>
<div>
    <form method="post" 
          action="index.php?uc=validerFrais&action=majNbJustificatifs" 
          role="form">
              <?php
// boîte montrant le nombre de justificatifs reçus.
              ?>
        <h4>Nombre de justificatifs :</h4>

        <div class="form-group">
            <input type="text" id="nbJustificatifs" 
                   name="nbJustificatifs"
                   size="4" maxlength="3" 
                   value="<?php echo $nbJustificatifs ?>" 
                   class="form-control">

            <button class="btn btn-success" type="submit" 

                    onclick="return confirm('Nb justificatifs mis à jour');"
                    >Valider</button>
        </div>

        <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
        <input name="lstMois" value="<?php echo $moisASelectionner; ?>" type="hidden">

    </form>
</div>
<div>

    <div>
    <form method="post" 
          action="index.php?uc=validerFrais&action=validationFicheFrais" 
          role="form">
    <?php
//bouton pour valider de manière définitive la fiche de frais
    ?>
    <button class="btn btn-success" type="submit"
            href="index.php?uc=validerFrais&action=validationFicheFrais"
            onclick="if (confirm('Fiche de frais validée')) {
                        this.form.submit();
                    } else {
                        return false;
                    }
            ">Valider la fiche de frais</button>  
        <input name="lstVisiteurs" value="<?php echo $visiteurASelectionner; ?>" type="hidden">
        <input name="lstMois" value="<?php echo $moisASelectionner; ?>" type="hidden">

    </form>
         
</div>