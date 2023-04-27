<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Styles\styles.css">
    <title>Modifier post</title>
</head>
<body>
    
</body>
</html>
<?php
//acces bd
include('accesbdd.php');
$bdd = connect_db();

// Vérifiez si l'ID du post est fourni dans l'URL
if(isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];
    
    // Requête SQL pour récupérer les informations du post
    $sql = "SELECT * FROM post WHERE id_post = $id_post";
    $result = $bdd->query($sql);
    
    // Vérifiez si le post existe et affiche
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $contenu = $row['contenu']; 
        echo '<h1>Modifier le post</h1>';
        echo '<form method="POST">';
        echo '<label for="contenu">Contenu :</label>';
        echo '<textarea id="contenu" name="contenu" rows="5" cols="50">'. $contenu .'</textarea>'; 
        echo '<button class="button_confirmation" type="submit" name="confirmer_modification">Confirmer la modification</button>';
        echo '<button class="button_confirmation" type="button" onclick="annulerModification()">Annuler</button>';

        echo '</form>';
    } else {
        echo "Le post n'existe pas.";
    }
} else {
    echo "L'ID du post n'est pas fourni.";
}

if(isset($_POST['confirmer_modification'])) {
    $id_post = $_GET['id_post'];
    $contenu = $_POST['contenu'];
    $contenu = mysqli_real_escape_string($bdd, $contenu);

    // Requête pour mettre à jour le post
    $sql = "UPDATE post SET contenu = '$contenu' WHERE id_post = $id_post";

    if(mysqli_query($bdd, $sql)) {
        // La mise à jour a été effectuée avec succès
        header("Location: profil.php");
        exit();
    } else {
        // message d'erreur
        echo "Erreur lors de la mise à jour du post: " . mysqli_error($bdd);
    }
}

$bdd->close();
?>

<!-- JS pour le pop-up de confirmation -->
<script>     
    function annulerModification() {
        window.location.href = "profil.php";
    }
</script>
