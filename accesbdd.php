<?php
function connect_db() {
    // Connexion à la base de données
    $bdd = new mysqli("localhost", "root", "root", "blablazone");

    // Vérification de la connexion
    if ($bdd->connect_error) {
        die("Connection failed: " . $bdd->connect_error);
    }

    return $bdd;
}
?>
