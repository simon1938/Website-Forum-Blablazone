<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Styles\styles.css">
    <title>Connection Compte</title>
</head>
<body>
<?php

include('accesbdd.php');
// appel bdd
$bdd = connect_db();

// Vérification si le formulaire a été soumis
if (isset($_POST['email'],$_POST['motdepasse'])) {

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $motdepasse = md5($_POST['motdepasse']);
 

    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$motdepasse'";
    $result = $bdd->query($sql);
    
    // Vérification si l'utilisateur existe dans la base de données
    if ($result->num_rows > 0) {
        echo "Connexion réussie";
        echo" Bienvenue";

        //récupération de l'id utilisateur connecter pour pouvoir afficher son profil
        $sql2 ="SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$motdepasse'";
        $result2 = $bdd->query($sql2);
        $row = $result2->fetch_assoc();      
        if (!empty($row)) {
            session_start();    
            $_SESSION['id'] = $row['id_utilisateur'];
            $_SESSION['nom_utilisateur'] = $row['nom_utilisateur'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['age'] = $row['age'];
            $_SESSION['photo'] = $row['photo'];
            
        }
        
        
        echo $_SESSION['id'];
        header('Location: profil.php');
    } else {
        echo "Adresse e-mail ou mot de passe incorrect";
    }
}

// Fermeture de la connexion
$bdd->close();
?>
</body>
</html>