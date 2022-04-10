<?php
/**
 
 * @param string $valeur Valeur à nettoyer
 * @return string Valeur nettoyée
 */
function escape($valeur)
{
    
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
}

/**
 
 * @return PDO Objet de connexion à la BD
 */
function getBdd() {
    return new PDO("mysql:host=localhost;dbname=badminton v2;charset=utf8",
        "root", "",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

?>