<?php
/**
 * Vue suivi de la fiche de frais
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
<div>
    <br>
    <h4><?php  echo'Fiche de frais de ' . $nom . ' ' . $prenom. ' ('.$mois.')'  ?></h4>
    <hr>
    <h3>Eléments forfaitisés : </h3>
    <div class="panel panel-info">
        <table class="table table-bordered table-responsive">
            <tbody>
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <tr>
                        <td> <?php echo $libelle . ' : ' . $quantite ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h3>Elements hors-forfaits : </h3>
    <div class="panel panel-info">
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
                        <td> <?php echo $date ?></td>
                        <td> <?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody> 
        </table>        
    </div>

    <div>
        <h4>Nombre de justificatifs : <?php echo $nbJustificatifs ?></h4>
    </div>
    <div>        
        <form method="post" 
              action="index.php?uc=suivreFrais&action=changerEtat" 
              role="form">
                  <?php //btn pr changer etat de la fiche de frais?>
            <button class="btn btn-success" type="submit"
                    action="index.php?uc=suivreFrais&action=changerEtat"

                    >Passer la fiche à l'état suivant </button> 

            <input name="mois" value="<?php echo $mois ?>" type="hidden">
            <input name="lstFiche" value="<?php echo $idVisiteur ?>" type="hidden">

        </form>       
    </div>
</div>