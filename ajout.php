<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}

/**
 * Recuperer les types d'adhérant pour l'utiliser dans le formulaire
 */
try {
    require 'fonctions.php';

    $bdd = getBdd();

    /**
     * Définition de la requete qui permet de recuperer tout les types (Salarié, ...)
     */
    $requete = "SELECT * FROM type ORDER BY numType";

    $reponse = $bdd->query($requete);
}
catch (Exception $e) {
    $msgErreur = $e->getMessage() . '(' . $e->getFile() . ', ligne ' . $e->getLine() . ')';
}

try {
    if (isset($_POST['nom'])
        && isset($_POST['prenom']) 
        && isset($_POST['niveau']) 
        && isset($_POST['adresse']) 
        && isset($_POST['cp'])) {

            // Récupération des champs saisis
            $numTy      = $_POST['type'];
            $nom        = $_POST['nom'];
            $prenom     = $_POST['prenom'];
            $adresse    = $_POST['adresse'];
            $ville      = $_POST['ville'];
            $cp         = $_POST['cp'];
            $niveau     = $_POST['niveau'];
            
            $requete_ajout = $bdd->prepare("INSERT INTO adherent  VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $requete_ajout->execute(array($nom, $prenom, $adresse, $ville, $cp, $niveau, $numTy, $numTy));

        
            $modifOk = true;
            
    }
}
catch (Exception $e) {
    $msgErreur = $e->getMessage() . '(' . $e->getFile() . ', ligne ' . $e->getLine() . ')';
}
?>

<?php 
$title = "Ajout d'un adhérant";
require 'layout/header.php'; 
$currentPage = 'ajout';
require 'layout/nav.php';
?>
<?php if(isset($_SESSION['username'])) : ?> 
    <div class="container">
        <div class="ajoutherAdhForm">
        <?php if(isset($_POST['nom'])) : ?>
            <div class="ajouterAdhConfirmation">
                <p>
                    <?php
                    if (isset($modifOk)) {
                        echo "L'adhèrent à bien été rajouté ";
                    }else{
                        echo "Probleme lors de l'ajout ";
                    }
                    ?>
                </p>
            </div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="label_container">
                    <p>
                        <label class="form-label" for="nom">Nom</label>
                        <input class="form-control" type="text" name="nom" required>
                    </p>
                    <p>
                        <label class="form-label" for="prenom">Prénom</label>
                        <input class="form-control" type="text" name="prenom">
                    </p>
                    <p>
                        <label class="form-label" for="adresse">Adresse</label>
                        <input class="form-control" type="text" name="adresse">
                    </p>
                    <p>
                        <label class="form-label" for="cp">Code postal</label> <input class="form-control" type="text" name="cp">
                    </p>
                    <p>
                        <label class="form-label" for="ville">Ville</label> <input class="form-control" type="text" name="ville">
                    </p>
                    <div>
                        <label class="form-label" for="type">Type :</label>
                        <select class="form-select" name="type" id="ty">
                            <?php
                                $types_tab = $reponse->fetchAll();
                                foreach ($types_tab as $unType) { 
                                    $libType = $unType['libelleType'];
                                    $idType = $unType['numType'];
                                ?>
                            <option value='<?= $idType ?>'><?= $libType ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="label8">
                        <label class="form-label" for="niveau">Niveau :</label>

                        <select class="form-select" name="niveau">
                            <option value="Expert" selected>Expert</option>
                            <option value="Confirmé"> Confirmé</option>
                            <option value="Débutant"> Débutant</option>
                        </select>
                    </div>
                </div>
                <input class="sub" type="submit" value="Ajouter">
            </form>
        </div>
    </div>

<?php
try {
    if (isset($_POST['nom'])
        && isset($_POST['prenom']) 
        && isset($_POST['niveau']) 
        && isset($_POST['adresse']) 
        && isset($_POST['cp'])) {

            // Récupération des champs saisis
            $numTy      = $_POST['type'];
            $nom        = $_POST['nom'];
            $prenom     = $_POST['prenom'];
            $adresse    = $_POST['adresse'];
            $ville      = $_POST['ville'];
            $cp         = $_POST['cp'];
            $niveau     = $_POST['niveau'];
            
            $requete_ajout =  $bdd->prepare("INSERT INTO adherent  VALUES (0, ?, ?, ?, ?, ?, ?, ?)");
            
            $requete_ajout->execute(array($nom, $prenom, $adresse, $ville, $cp, $niveau, $numTy));

          
            $modifOk = true;
            
    }
}
catch (Exception $e) {
    $msgErreur = $e->getMessage() . '(' . $e->getFile() . ', ligne ' . $e->getLine() . ')';
}


?>

<?php else : ?>
	<?php header('Location: login.php'); ?>
<?php endif; ?>
    <?php require 'layout/footer.php'; ?>
