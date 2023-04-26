<?php
// inclure le fichier d'accès à la base de données
require_once('accesbdd.php');


// Vérifier si le formulaire a été soumis et si l'utilisateur est connecté
session_start();
$bdd = connect_db();

if(isset($_SESSION['id']) && isset($_POST['id_post'])) {

    // Récupérer les données du formulaire
    $id_utilisateur = $_SESSION['id'];
    $id_post = $_POST['id_post'];


// Vérifier si l'utilisateur a déjà aimé ce post
$sql = "SELECT * FROM post_like WHERE user_id='$id_utilisateur' AND post_id='$id_post'";
$result = $bdd->query($sql);
if(mysqli_num_rows($result) > 0){
    $verif = "Vous avez déjà aimé ce post.";    
    header('Location: fils.php?erreur=' . urlencode($verif));
    exit;
} else {
        // Ajouter un like dans la table post_like
        $sql = "INSERT INTO post_like (user_id, post_id) VALUES ('$id_utilisateur', '$id_post')";
        $result = $bdd->query($sql);
        if($result){
            $verif = " Votre like à bien été ajouté !";    
            header('Location: fils.php?erreur=' . urlencode($verif));        
            exit;
        } else {
            echo "Erreur : le like n'a pas pu être ajouté.";
        }
    }
}

?>
