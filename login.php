<?php 
session_start(); 
$title = "Se connecter";
require 'layout/header.php';
require 'fonctions.php';
$msgError = '';


if(isset($_POST['connect'])){
    if(!empty($_POST['identifiant']) && !empty($_POST['pass'])){
        $bdd = getBdd();
        $requete = "SELECT * FROM user WHERE username='" . $_POST['identifiant'] . "' AND password= '" . $_POST['pass'] . "'";
        $reponse = $bdd->query($requete);
        if($reponse->rowCount() > 0){
            $_SESSION["username"] = $_POST['identifiant'];
            header('Location: index.php');
        }else{
            $msgError = 'Identifiant ou mot de passe incorrect';
        }
    }else{
        $msgError = 'Tous les champs doivent être remplis';
    }
}
?>
<div class="signin-page">
<main class="form-signin">
    <form method="POST" action="">
        <h1>Club de Badminton</h1>
        <h1 class="h3 mb-3 fw-normal">Connectez-vous</h1>
        <?php if($msgError != '') : ?>
            <div class="alert alert-danger" role="alert">
                <?= $msgError; ?>
            </div>
        <?php endif; ?>
        <div class="form-floating">
        <input type="text" class="form-control" id="identifiant" placeholder="identifiant" name="identifiant" required>
        <label for="identifiant">Identifiant</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="pass" placeholder="Mot de passe" name="pass" required>
        <label for="pass">Mot de passe</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" name="connect" type="submit">connexion</button>
    </form>
</main>
</div>
<?php require 'layout/footer.php'; ?>