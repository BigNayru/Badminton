<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
try {
    require 'fonctions.php';
    /**
     * Recupération de l'id qui a transité par l'url depuis le fichier 
     * gestionAdh.php
     */
    $id = $_GET['id'];

    $bdd = getBdd();
    
    /**
     * Définition de la requete qui permet de recuperer TOUT le details d'un adherant precis.
     * Il faut récuperer : son matricule, nom, prenom, adresse, ville, cp, niveau de la table 
     * "adherant" mais aussi son type (Salarié, Etudiant ou Retraité) de la table "type"
     */
    $requete = "SELECT * FROM adherent LEFT JOIN type ON adherent.numType = type.numType WHERE matriculeAdh= '$id'";

    /**
     * Exécution de la requête SQL et récupération de ses résultats
     */
    $resultat = $bdd->query($requete);
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}


?>

<?php 

    $title = "Details de l'adhérant";
    require 'layout/header.php'; ?>
    <div class="container">

    <?php $cetAdherant = $resultat->fetch(); ?>

    <div class="list-group">
        <!-- Matricule -->
        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <i class="fas fa-id-card-alt"></i>
            <div>
                <h6 class="mb-0"><?= $cetAdherant['matriculeAdh']; ?></h6>
                <p class="mb-0 opacity-75">Matricule</p>
            </div>
        </div>
        <!-- Nom Prenom -->
        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <i class="fas fa-user"></i>
            <div>
                <h6 class="mb-0"><?= $cetAdherant['nomAdh']; ?> <?= $cetAdherant['prenomAdh']; ?></h6>
                <p class="mb-0 opacity-75">Nom Prénom</p>
            </div>
        </div>
        <!-- Adresse, CP, Ville -->
        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <i class="fas fa-map-marker-alt"></i>
            <div>
                <h6 class="mb-0"><?= $cetAdherant['adresseAdh']; ?>, <?= $cetAdherant['cpAdh']; ?>, <?= $cetAdherant['villeAdh']; ?></h6>
                <p class="mb-0 opacity-75">Adresse</p>
            </div>
        </div>
        <!-- Niveau -->
        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <i class="fas fa-level-up-alt"></i>
            <div>
                <h6 class="mb-0"><?= $cetAdherant['niveauAdh']; ?></h6>
                <p class="mb-0 opacity-75">Niveau</p>
            </div>
        </div>
        <!-- Type -->
        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
            <i class="fas fa-user-tie"></i>
            <div>
                <h6 class="mb-0"><?= $cetAdherant['libelleType']; ?></h6>
                <p class="mb-0 opacity-75">Type</p>
            </div>
        </div>
    </div>
    </div>
<?php require 'layout/footer.php'; ?>