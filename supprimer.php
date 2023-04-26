<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Styles\styles.css">
    <title>Supprimer post</title>
</head>
<body>
    
</body>
</html>
<?php
include('accesbdd.php');
$bdd = connect_db();

// Vérifiez si l'ID du post est fourni dans l'URL
if(isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];
    
    // Requête SQL pour récupérer les informations du post
    $sql = "SELECT * FROM post WHERE id_post = $id_post";
    $result = $bdd->query($sql);
    
    
    
    // Vérifiez si le post existe et affichez-le
    if($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        echo '<h1>Supprimer le post</h1>';
        echo '<div>';
        echo '<h2>Voulez-vous vraiment supprimer le post suivant ?</h2>';
        echo '<div style="text-align:center;"><h3>'. $row['contenu'] .'</h3></div>';
        echo '</div>';
        echo '<div>';
        echo '<form method="POST">';
        echo '<button class="button_confirmation" type="submit" name="confirmer_suppression">Confirmer la suppression</button>';
        echo '<button class="button_confirmation" type="button" onclick="annulerSuppression()">Annuler</button>';

        echo '</form>';

        echo '</div>';
    } else {
        echo "Le post n'existe pas.";
    }
} else {
    echo "L'ID du post n'est pas fourni.";
}
if(isset($_POST['confirmer_suppression'])) {
    $id_post = $_GET['id_post'];

    // Requête SQL pour supprimer le post

    $sql_likes = "DELETE FROM post_like WHERE post_id = $id_post";
    $sql_comments = "DELETE FROM commentaires WHERE id_post = $id_post";
    $sql_post = "DELETE FROM post WHERE id_post = $id_post";

    if(mysqli_query($bdd, $sql_likes)){
        echo "Les likes ont été supprimés avec succès";
    } else {
        echo "Erreur lors de la suppression des likes: " . mysqli_error($bdd);
    };

    if(mysqli_query($bdd, $sql_comments)){
        echo "Les commentaires ont été supprimés avec succès";
    } else {
        echo "Erreur lors de la suppression des commentaires: " . mysqli_error($bdd);
    };



    if(mysqli_query($bdd, $sql_post)) {
        // La suppression a été effectuée avec succès, rediriger l'utilisateur vers la page du profil
        header("Location: profil.php");
        exit();
    } else {
        // En cas d'erreur, afficher un message d'erreur
        echo "Erreur lors de la suppression du post: " . mysqli_error($bdd);
    }
}



$bdd->close();
?>

<!-- Code JavaScript pour le pop-up de confirmation -->
<script>     
    function annulerSuppression() {
        window.location.href = "profil.php";
    }
</script>
