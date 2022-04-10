<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
$title = "Resultat de recherche";
require 'layout/header.php';
require 'layout/nav.php'; ?>

<div class="container">
    <ul class="list-group">
        <?php
            require 'fonctions.php';
            $recherche = $_GET['nom'];

            if (isset($recherche)) {
                $bdd = getBdd();
                // Définition de la requête SQL
                $reqr = "SELECT * FROM adherent WHERE nomAdh LIKE '%$recherche%'";
                
                $resultatr = $bdd->query($reqr);


                $data = $resultatr->fetchAll();

                foreach ($data as $line) {
                    $nom = $line['nomAdh'];
                    $prenom = $line['prenomAdh'];
                    $niveau = $line['niveauAdh'];
                    $matricule = $line['matriculeAdh'];


                    echo '<li class="list-group-item"> '.$matricule.', '.$nom.', '.$prenom.'<br> '.$niveau.'</li> <br/>';
                }
            }

            ?>

    </ul>
</div>

<?php require 'layout/footer.php'; ?>