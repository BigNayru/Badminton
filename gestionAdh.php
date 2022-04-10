<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
try {
    /**
     * Insertion du fichier functions.php dans ce fichier (gestionAdh.php)
     * pour que toutes les finctions soient disponible sur ce fichier
     * (pour qu'on puisse les utilisées)
     */
	require 'fonctions.php';

    /**
     * Connexion à la base de donnée grâce à la 
     * fonction "getBdd()", qui est contenue dans 
     * functions.php
     */
    $bdd = getBdd();

    /**
     * Définition de la requete qui permet de recuperer tous les adhérants 
     * ordonnée par leurs noms
     */
    $req = "SELECT * FROM adherent ORDER BY nomAdh";

    /**
     * Exécution de la requête SQL et récupération de ses résultats 
     */ 
    $resultat = $bdd->query($req);

    /**
     * Récuperation du nombres de ligne récupéré (nombre d'adhérants)
     */
    $nbAdh = $resultat->rowCount();
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}
?>

<!-- requete php -->
<?php 
$title = 'Gestion des adhérants';
require 'layout/header.php';
$currentPage = 'gestion';
require 'layout/nav.php'; ?>

<div class="container">

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Nom de l'adhérent</th>
                    <th scope="col">Prénom de l'adhérent</th>
                    <th scope="col">Niveau de l'adhérent</th>
                </tr>
            </thead>
            <tbody>
            <?php
            /**
             * Récupération de tous les résultats de la requête dans un tableau
             */
            $adherants_tab = $resultat->fetchAll();
            
            /**
             * Itération sur les résultats de la requête SQL
             */
            foreach ($adherants_tab as $unAdherant) {

                $nom = $unAdherant['nomAdh'];
                $prenom = $unAdherant['prenomAdh'];
                $niveau = $unAdherant['niveauAdh'];
                $matricule = $unAdherant['matriculeAdh'];

            ?>
            
                <tr>
                    <td>
                        <div class='action'>
                            <a class="btn btn-primary" href='detail.php?id=<?= $matricule ?>' role="button">Détails</a>
                            <a class="btn btn-warning" href='update.php?id=<?= $matricule ?>' role="button">Modifier</a>
                            <a class="btn btn-danger" href='delete.php?id=<?= $matricule ?>' role="button">Supprimer</a>
                        </div>
                    </td>
                    <td><?= $nom ?></td>
                    <td><?= $prenom ?></td>
                    <td><?= $niveau ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?= '<p>Le club compte '. $nbAdh . ' adhérents.</p>'; ?>
    </div>
</div>
<?php require 'layout/footer.php'; ?>