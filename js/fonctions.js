//fonction de redirection
function rediriger_creationC() {
    window.location.href = "Creation_compte.php";
  }  
  function rediriger_profil() {
    window.location.href = "profil.php";
  }  
  function rediriger_index() {
    window.location.href = "index.html.html";
  }
  function rediriger_ajouterpost() {
    window.location.href = "ajouterpost.php";
  }
  function rediriger_fils() {
    window.location.href = "fils.php";
  }
  function rediriger_ajouterpost() {
    window.location.href = "ajouterpost.php";
  }
  //fonction pour supprimer /modier post on garde l'id du post dans l'url et on recupère avec un get
  function supprimer(id_post) {
    window.location.href = 'supprimer.php?id_post=' + id_post;
  }
  
  function modifier(id_post) {
    window.location.href = 'modifier.php?id_post=' + id_post;
  }
  