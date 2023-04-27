<?php
// Connexion à bdd
require_once "accesbdd.php";
$bdd = connect_db();
// Récupération de l'id_utilisateur 
session_start();

// Récupération des données du formulaire
$commentaire = $_POST['commentaire'];
$commentaire = mysqli_real_escape_string($bdd, $commentaire);
$id_post = $_SESSION['id_post']; 


$id_utilisateur = $_SESSION['id'];

// Insertion du commentaire dans la base de données
echo $commentaire.$id_post.$id_utilisateur;
$query = "INSERT INTO commentaires (contenu, date_de_creation, id_utilisateur, id_post) 
          VALUES ('$commentaire', NOW(), '$id_utilisateur', '$id_post')";
$result = mysqli_query($bdd, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($bdd));
    exit();
}
if ($result)
{
    // Redirection vers la page des commentaires pour afficher le nouveau commentaire       
    //commentaire bien ajouté    
        echo "<script>alert('" . "Votre magnifique commentaire à bien été ajouté !" . "')</script>";
        header('Location: commentaire.php');
}
else
{
    echo "Une erreur est survenue lors de l'ajout du commentaire";
}
?>
