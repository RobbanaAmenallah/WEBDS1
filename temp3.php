

<?php
// Vérifiez si l'e-mail est défini
if(isset($_POST['test'])) {
    // Récupérez l'e-mail depuis le formulaire
    $email = $_POST['test'];

    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=njr';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit;
    }

    // Requête pour récupérer les données du CV
    $query = "SELECT nom, prenom, date_naissance, email, tel, education, nom_entreprise, date_debut, date_fin, skill1, skill2, skill3 FROM cv1 WHERE email=:email";
    $stmt = $db->prepare($query);
    $stmt->execute(['email' => $email]);
    $cvData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si aucune donnée n'est trouvée pour cet e-mail, affichez un message approprié
    if(!$cvData) {
        echo "Aucune donnée trouvée pour cet e-mail.";
        exit;
    }

    // Remplissage de la template avec les données récupérées
    $template = "
   
    ";

    // Affichage de la template remplie
    echo $template;
} else {
    // Affichez un message si l'e-mail n'est pas défini
    echo "L'e-mail n'est pas défini.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>RT CV Creator</title>
  <meta charset="utf-8">
  <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <style>
    /* Resetting default margin and padding */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body styles */
    body {
      margin:0;
      padding:0;
      font-family: sans-serif;
      background-image: url('CV.jpg');
    }

    /* Container styles */
    .cv-container {
      max-width: 800px;
      margin: 0 auto;
      background-color:#F0F8FF;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Header styles */
    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header input[type="text"],
    .header textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    /* Section styles */
    .section {
      margin-bottom: 20px;
    }

    .section h2 {
      margin-bottom: 10px;
      color: #333;
    }

    .section input[type="text"],
    .section textarea {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color:#72A0C1;
    }

    /* Button styles */
    button[type="submit"] {
      padding: 10px 20px;
      background-color:blue;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-warning{ 
      position: relative; 
      padding: 11px 16px; 
      font-size: 15px;
      line-height: 1.5; 
      border-radius: 3px; 
      color: #fff; 
      background-color:blue;
      border: 0;
      transition: 0.2s; 
      overflow: hidden;
    } 

    .btn-warning input[type = "file"]{
      cursor: pointer; 
      position: absolute; 
      left: 0%; 
      top: 0%; 
      transform: scale(3); 
      opacity: 0; 
    }

    .btn-warning:hover{ 
      background-color: blue; 
    }

    .btn{
      color:blue;
      border:none;
      height:40px;
      width: 100px;
      border-radius:7px;
      cursor: pointer;
    }

    .btn:hover{
      color:white;
      background-color: #3b82f6;
      box-shadow: 0 0 0 5px #3b83f65f;
      align-items: center;
    }

    .image{
      width:180px;
      height:180px;
      border-radius:50%;
      margin-top:40px;
      margin-bottom:30px;
    }

    .logo-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .logo-container img {
      width: 150px; 
    }
    * {
  max-width: 700px;
  margin: auto;
}


/*body {
    min-width: 500px;
}*/

div {
  border-radius: 5px;
}

#header {
  height: 40px;
  width: 100%;
  position: relative;
  z-index: 1;
}

#title {
  margin-left: 3%;
}
#header,
#footer {
  background-color: #3b82f6; /* Bleu */
}

/* Couleur vert */
.section input[type="text"],
.section textarea {
  background-color: #3b82f6; /* Bleu */
}
#footer {
  height: 50px;
  width: 100%;
  clear: both;
  position: relative;
}

.left {
  height: 1000px;
  width: 45px;
  float: left;
  background-color: #e0eeee;

  position: relative;
}

.right {
  height: 1000px;
  width: 45px;
  background-color: #e0eeee;
  float: right;
  position: inherit;
}

.stuff {
  display: inline-block;
  margin-top: 6px;
  margin-left: 55px;
  width: 75%;
  height: 1000px;
  font-size: 30px; /* Augmentez la taille de la police selon vos besoins */
  margin-bottom: 20px; /* Ajoutez une marge inférieure pour séparer du footer */
}

p,
li {
  font-family: 'Cormorant Garamond';
}

.head {
  font-size: 40px;
  color:blue;
}

#name {
  font-family: Sacramento;
  float: right;
  margin-top: 10px;
  margin-right: 4%;
}

a {
  color: black;
  text-decoration: none;
}

@media only screen and (max-width: 430px) {
  .left,
  .right {
    display: none;
  }
  .stuff {
    width: 100%;
    margin-left: 10px;
  }
}


li{
    text-align:left;

}
p{
    text-align:left;

   }   /* Ajoutez ces styles pour agrandir les balises h1 et h2 */


   h1 {
  margin-top: 20px; /* Ajoutez la marge supérieure souhaitée */
}
  </style>
</head>
<body>
  <div class="logo-container">
    <img src="1.png" alt="Logo">
  </div>
  <form method="post" action="">
    <input type="email" name="test"> <input type="submit" value="generer">
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    let profilepic = document.getElementById("pdp");
    let inputfile = document.getElementById("inputfile");

    inputfile.onchange = function() {
      profilepic.src = URL.createObjectURL(inputfile.files[0]);
    };
  });
</script>
  </form>
  <div class="cv-container">
    <div class="header">
      <img src="profile.png" class="image" id="pdp">
      <div class="upload">
        <button type="button" class="btn-warning">
          <i class="fa fa-upload"></i> Upload Picture <input type="file" id="inputfile">
        </button> 
      </div>
      <div id="header"></div>
<div class="left"></div>
<div class="stuff">
  <br><br>
  <h1><?php echo $cvData['nom']; ?></h1>
  <h2><?php echo $cvData['prenom']; ?></h2>
  <hr />
  <br>
  <p class="head">Informations personnelles</p>
  <ul>
    <li><?php echo $cvData['date_naissance']; ?></li>
    <li> <?php echo $cvData['email']; ?></li>
    <li><?php echo $cvData['tel']; ?></li>

  </ul>
  <p class="head">Education</p>
  <?php if(isset($cvData)): ?>
                <ul><li><?php echo $cvData['education']; ?></li></ul>
            <?php endif; ?>
  <p class="head">Experience</p>
  <ul>
    <li><?php echo $cvData['nom_entreprise']; ?></li>
    <li>(<?php echo $cvData['date_debut']; ?> - <?php echo $cvData['date_fin']; ?>)</li>
  </ul>
  <p class="head">Compétences</p>
  <ul>
    <li><?php echo $cvData['skill1']; ?></li>
    <li><?php echo $cvData['skill2']; ?></li>
    <li><?php echo $cvData['skill3']; ?></li>
  </ul>
</div>
<div class="right"></div>
<div id="footer">
  <h2 id="name">CV Creator</h2></div>
  <a href="telecharger_cv.php" target="_blank">Télécharger le CV en PDF</a>

</div>
</body>
</html>
