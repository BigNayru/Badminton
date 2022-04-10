<div class="container">
    <header class="d-flex flex-wrap justify-content-between py-3 mb-4 border-bottom">

        <h2><?= $title; ?></h2>
        <?php $currentPage = "";
        ?> 

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Accueil</a></li>
            <li class="nav-item"><a href="gestionAdh.php" class="nav-link <?= ($currentPage=="gestion") ? 'active' : '' ?>" aria-current="page">Gestion des adhérants</a></li>
            <li class="nav-item"><a href="ajout.php" class="nav-link  <?= ($currentPage=="ajout") ? 'active' : '' ?>">Ajouter un adhérant</a></li>
            <li class="nav-item"><a href="recherche.php" class="nav-link  <?= ($currentPage=="recherche") ? 'active' : '' ?>">Rechercher un adhérant</a></li>

            <?php if(isset($_SESSION['username'])) : ?>
                <li class="nav-item"><a href="logout.php" class="nav-link ">Deconnexion</a></li>
            <?php else :  ?>
                <li class="nav-item"><a href="login.php" class="nav-link">Connexion</a></li>
            <?php endif;  ?>

        </ul>
    </header>
</div>