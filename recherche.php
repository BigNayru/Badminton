<?php 
session_start();
if(!isset($_SESSION['username'])){
  header('Location: login.php');
  exit;
}
$title = "Recherche d'un adhérant";
require 'layout/header.php';
$currentPage = 'recherche';
require 'layout/nav.php'; ?>

<div class="container">
  <form method="GET" action="search.php"> 
    <div class="rechercheAdh_container">
      <label class="form-label"></label> <input class="form-control" type="text" name="nom" placeholder="tapez le nom" required>
      <button class="btn btn-primary" type="submit">Rechercher</button>
    </div>

  </form>
</div>
<?php require 'layout/footer.php'; ?>

