<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
$title = "Modification d'un adhérant";
require 'layout/header.php'; 
require 'layout/nav.php';
?>

    
<?php
    /**
     * Récuperation des types d'adhérant 
     * Récuperation de l'adherant dont l'id a transité par l'url depuis le fichier *gestionAdh.php
     */
    try {
        require 'fonctions.php';
        $bdd = getBdd();
        $id = $_GET['id'];

        /**
         * Recuperation des types d'adhérant
         */
        $requete1 = "SELECT * FROM type ORDER BY numType";
        $reponse1 = $bdd->query($requete1);
        
        /**
         * Recuperation des adhérants
         */
        $requete2 = "SELECT * FROM adherent WHERE matriculeAdh= '$id'";
        $reponse2 = $bdd->query($requete2);

    }
    catch (Exception $e) {
        $msgErreur = $e->getMessage() . '(' . $e->getFile() . ', ligne ' . $e->getLine() . ')';
    }
?>
<?php
    /**
     * Modification de l'adherantdans la base de donnée
     */
    try {
  	    $bdd = getBdd();
          if (isset($_POST['matricule']) 
          && isset($_POST['type']) 
          && isset($_POST['nom'])
          && isset($_POST['prenom']) 
          && isset($_POST['niveau']) 
          && isset($_POST['adresse']) 
          && isset($_POST['ville']) 
          && isset($_POST['cp'])) {

                $matricule = $_POST['matricule'];
                $type = $_POST['type'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $adresse = $_POST['adresse'];
                $ville = $_POST['ville'];
                $cp = $_POST['cp'];
                $niveau = $_POST['niveau'];

        
            $requete3 = "UPDATE adherent SET matriculeAdh='" . $matricule . "', numType= " . $type . " , nomAdh='" . $nom . "', prenomAdh='" . $prenom . "', adresseAdh='" . $adresse. "', villeAdh='" . $ville . "', cpAdh= " . $cp . ", niveauAdh='" . $niveau . "' WHERE matriculeAdh= '" . $id . "'";
            
            $reponse3 = $bdd->query($requete3);
            $modifOk = "OK";
            $reponse3->execute();
          }
                                     

        }

        catch (Exception $e) {
            $modifOk = "KO";
            die('Erreur fatale : ' . $e->getMessage());
        }
?>
    <div class="container">
        <form method="post" action="">
            <?php if(isset($_POST['nom'])) : ?>
            <div class="ajouterAdhConfirmation">
                <p>
                    <?php
                    if ($modifOk == "OK") {
                        echo "L'adhèrent à bien été modifié ";
                    }else{
                        echo "Probleme lors de la modification ";
                    }
                    ?>
                </p>
            </div>
            <?php endif; ?>
            <?php  $cetAdherant = $reponse2->fetch(); ?>
            <p>
                <label class="form-label" for="nom">Nom :</label>
                <input class="form-control" type="text" name="nom" value="<?= $cetAdherant['nomAdh'];?>">
            </p>
            <p>
                <label class="form-label" for="prenom">Prénom :</label>
                <input class="form-control" type="text" name="prenom" value="<?= $cetAdherant['prenomAdh'];?>">
            </p>
            <p>
                <label class="form-label" for="adresse">Adresse :</label>
                <input class="form-control" type="text" name="adresse" value="<?= $cetAdherant['adresseAdh'];?>">
            </p>
            <p>
                <label class="form-label" for="cp">Code postal :</label>
                <input class="form-control" type="number" name="cp" value="<?= $cetAdherant['cpAdh'];?>">
            </p>
            <p>
                <label class="form-label" for="ville">Ville :</label> 
                <input class="form-control" type="text" name="ville" value="<?= $cetAdherant['villeAdh'];?>">
            </p>

            <p>
                <label class="form-label" for="type">Type :</label>
                <select name="type" id="ty" class="form-select">
                    <?php
                        $types_tab = $reponse1->fetchAll();
                        $cetAdherantType = $cetAdherant['numType'];

                        foreach ($types_tab as $unType) { 
                            $libType = $unType['libelleType'];
                            $idType = $unType['numType'];
                        ?>
                    <option value='<?= $idType ?>' <?= ($idType == $cetAdherantType) ? 'selected' : ''; ?>>
                        <?= $libType ?>
                    </option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label class="form-label" for="niveau">Niveau :</label>

                <select class="form-select" name="niveau">
                    <option value="Expert" <?= ($cetAdherant['niveauAdh'] == 'Expert') ? 'selected' : ''; ?>>Expert</option>
                    <option value="Confirmé" <?= ($cetAdherant['niveauAdh'] == 'Confirmé') ? 'selected' : ''; ?>>Confirmé
                    </option>
                    <option value="Débutant" <?= ($cetAdherant['niveauAdh'] == 'Débutant') ? 'selected' : ''; ?>>Débutant
                    </option>
                </select>
            </p>

            <button class="btn btn-primary" type="submit">Modifier</button>

        </form>
    </div>

<?php require 'layout/footer.php'; ?>