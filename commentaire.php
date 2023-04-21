<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\style_fils.css">
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

    $query_comments = "SELECT * FROM commentaires WHERE id_post = '$id_post' ORDER BY date_de_creation DESC";
    $result_comments = mysqli_query($bdd, $query_comments);
    
    $contenu=$post['contenu'];
    $date_de_creation=$post['date_de_creation'];    
// petite requete pour affiche la photo de profil de la personne qui à écrit le post que l'on veux commenter 
    $query = "SELECT photo FROM utilisateur UTL INNER JOIN post POS ON POS.id_utilisateur=UTL.id_utilisateur WHERE
     POS.id_post = $id_post" ;
    $result = mysqli_query($bdd, $query);
    $row=mysqli_fetch_assoc($result);

    ?>
<!-- ici c'est l'affichage du post  -->
      
          <div class="post-container">
                <h3>Post</h3>
                <img src="<?php echo $row['photo']; ?>" alt="Photo de profil">
                <div class="user-info">                                          
                        <h2>Posté par:  <?php echo $nom_utilisateur_post; ?></h2>
                    </div>
                    <ul class="post-info">                        
                       <li><?php echo $date_de_creation; ?></li>                    
                    </ul>                    

                    <div class="content">
                    <p><?php echo $contenu;?></p>
                    </div> 
            </div>
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

    <h2>Commentaires du post selectionné : </h2>
    <?php
    
	if($result_comments->num_rows>0){
		while ($comment = mysqli_fetch_assoc($result_comments))
		{
			?>
			
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
                   ?>  
            <h2>Réponse</h2>
            <div class="commentaire">
            <img src="<?php echo $row['photo']; ?>" alt="Photo de profil de <?php echo $row['nom_utilisateur']; ?>">
            <h3><?php echo $comment['contenu']; ?></h3>
            <p>Posté par : <?php echo $nom_utilisateur; ?></p>
            <p>Date de création : <?php echo $comment['date_de_creation']; ?></p>
            <hr>
            </div>


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

    
</body>
</html>
