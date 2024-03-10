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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RT CV Creator</title>
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
.btn-warning{ 
    position: relative; 
    padding: 11px 16px; 
    font-size: 15px;
     line-height: 1.5; 
     border-radius: 3px; 
     color: #fff; 
     background-color:blue;
      border: 0;
       transition: 
       0.2s; overflow: hidden;
        } 
        .btn-warning input[type = "file"]{
             cursor: pointer; position: absolute; left: 0%; top: 0%; transform: scale(3); opacity: 0; }
              .btn-warning:hover{ background-color: blue; }



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
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Styles du corps */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #F5F5F5; /* Fond gris clair */
        color: #333; /* Texte gris foncé */
        padding: 20px;
    }

    /* Styles du conteneur */
    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #FFF; /* Fond blanc */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Styles de l'en-tête */
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


    .photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 20px;
        background-color: #FF7043; /* Couleur orange */
        border: 5px solid #FF7043; /* Bordure orange */
    }

    /* Styles de la section */
    .section {
        margin-bottom: 30px;
        background-color: #81D4FA; /* Fond bleu clair */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section h2 {
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: bold;
        color: #37474F; /* Texte gris foncé */
    }

    .section p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 10px;
        color: #37474F; /* Texte gris foncé */
    }

    /* Styles du pied de page */
    .footer {
        text-align: center;
        margin-top: 50px;
        color: #666; /* Texte gris */
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
            <br>
            <br>
            <br>
        </div>
        <div class="section">
            <h2>Personal Informations</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>Last Name : </strong><?php echo $cvData['nom']; ?></p>
                <br>
                <p><strong>First name : </strong> <?php echo $cvData['prenom']; ?></p>
                <br>
                <p><strong>Date of birth : </strong><?php echo $cvData['date_naissance']; ?></p>
                <br>
                <p><strong>E-mail : </strong> <?php echo $cvData['email']; ?></p>
                <br>
                <p><strong>Phone : </strong> <?php echo $cvData['tel']; ?></p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2>Education</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>Education : </strong><?php echo $cvData['education']; ?></p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2>Experiences</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>Experience : </strong><?php echo $cvData['nom_entreprise']; ?><br>
                <br> (<?php echo $cvData['date_debut']; ?> - <?php echo $cvData['date_fin']; ?>)</p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2>Competences</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>Competences : </strong><br><?php echo $cvData['skill1']; ?><br> <?php echo $cvData['skill2']; ?><br> <?php echo $cvData['skill3']; ?></p>
            <?php endif; ?>
        </div>
        <a href="telecharger_cv.php" target="_blank">Télécharger le CV en PDF</a>

    </div>

</body>
</html>

