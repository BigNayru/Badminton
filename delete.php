<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
$title = "Supression d'un adhérant";
require 'layout/header.php';
require 'layout/nav.php'; ?>

<?php

try {
    require 'fonctions.php';
    $bdd = getBdd();

    $id = $_GET['id'];

    $requete = "DELETE FROM adherent WHERE matriculeAdh='" .  $id . "'";
    $reponse = $bdd->query($requete);
    $reponse->execute(); 
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}
?>
    <div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-6 shadow">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title">L'adhèrent a été supprimé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer flex-column border-top-0">
            <a class="btn btn-lg btn-primary w-100 mx-0 mb-2" href="index.php">Retour à l'accueil</a>
            <a class="btn btn-lg btn-light w-100 mx-0" href="gestionAdh.php">Retour à liste d'adherant</a>
        </div>
        </div>
    </div>
    </div>
<?php require 'layout/footer.php'; ?>