<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit;
}
$title = 'Accueil';
require 'layout/header.php'; ?>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">CLUB DE BADMINTON</h1>
        <p class="lead text-muted">
			Gérer le club depuis notre administration.
			<div class="time">
				<?php
				$date = date("d/m/Y");
				Print("<p><b>Nous sommes le $date</b></p>");
				?>
			</div>
		</p>
      </div>
    </div>
</section>
	<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<img src="img/gestion.jpeg" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">Gestion des adhérants</h5>
					<p class="card-text">Permet de gérer les différents adhérants du club de badminton.</p>
					<a href="gestionAdh.php" class="btn btn-primary">Gérer</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<img src="img/add.jpeg" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">Ajouter un adhérant</h5>
					<p class="card-text">Permet d'ajouter un adhérant au club de badminton.</p>
					<a href="ajout.php" class="btn btn-primary">Gérer</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<img src="img/search.jpeg" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">Rechercher un adhérant</h5>
					<p class="card-text">Permet de rechercher un adhérant du club de badminton.</p>
					<a href="recherche.php" class="btn btn-primary">Gérer</a>
				</div>
			</div>	
		</div>
	</div>
	</div>
<?php require 'layout/footer.php'; ?>