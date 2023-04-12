<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laisser commentaire</title>
</head>
<body>
    <h1>Voici le commentaire que vous avez selectionner ! n'hesitez pas à laisser un petit commentaire !</h1>
    <?php
    // Connexion à la base de données
    require_once "accesbdd.php";
    $bdd = connect_db();

    // Récupération du post et des commentaires correspondants
    //recuper l'id du post via le formulaire et pour eviter les erreurs lord du
    // reload de la page on stocke dans variable session 
    session_start(); 
    if(isset($_POST['id_post'])){  
    $_SESSION['id_post'] = $_POST['id_post'];    
    }
    $id_post = $_SESSION['id_post'];
    
	$nom_utilisateur_post=$_SESSION['nom_utilisateurpost'];
    $id=$_SESSION['id'];
	echo $id_post;
    $query_post = "SELECT * FROM post WHERE id_post = '$id_post'";
    $result_post = mysqli_query($bdd, $query_post);
	if($result_post->num_rows>0){
		
	
    $post = mysqli_fetch_assoc($result_post);

    $query_comments = "SELECT * FROM commentaires WHERE id_post = '$id_post'";
    $result_comments = mysqli_query($bdd, $query_comments);
    ?>
   
    <h2>Post:</h2>
    <p><?php echo $post['contenu']; ?></p>
    <p>Posté par : <?php echo $nom_utilisateur_post; ?></p>
    <p>Date de création : <?php echo $post['date_de_creation']; ?></p>
   
    <?php
	if($result_comments->num_rows>0){
		while ($comment = mysqli_fetch_assoc($result_comments))
		{
			?>
			<p><?php echo $comment['contenu']; ?></p>
                <?php
                        $id_commentaire_utilisateur=$comment['id_utilisateur'];
                        //mini requete pour afficher le nom du mec qui as ecrit le post
                        $query = "SELECT * FROM utilisateur WHERE id_utilisateur = $id_commentaire_utilisateur";
                        $result = mysqli_query($bdd, $query);
                        
                        // Récupération du nom d'utilisateur à partir du résultat de la requête
                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $nom_utilisateur = $row["nom_utilisateur"];
                        } else {
                            echo "L'utilisateur avec l'ID $id_utilisateur n'a pas été trouvé.";
                        }
                        
            echo "<img src='".$row['photo']."' alt='Photo de profil de ".$row['nom_utilisateur']."' style='width: 3%;'>";?>
			<p>Posté par : <?php echo $nom_utilisateur; ?></p>
			<p>Date de création : <?php echo $comment['date_de_creation']; ?></p>
			<hr>
			<?php
   		}
	}
	else
	{
		echo'Pas de commentaire pour ce post encore !';
	}
    }
    else
    {
        echo'erreur post';
    }
    ?>  

    <h2>Ajouter un commentaire</h2>
    <form method="POST" action="commentairebdd.php">
        <label for="commentaire">Contenu du commentaire :</label><br>
        <textarea id="commentaire" name="commentaire"></textarea><br>
        <input type="submit" value="Ajouter le commentaire">             
    </form>

    <div>    
        <p><a href="profil.php">Revenir au Profil</a></p>
        <p><a href="fils.php">Retourner au fil d'actualité</a></p>
        <p><a href="index.php">Se déconnecter</a></p>          
    </div> 
</body>
</html>
