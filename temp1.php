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
  text-align:right;
}
.btn-warning{ 
    position: relative; 
    padding: 11px 16px; 
    font-size: 15px;
     line-height: 1.5; 
     border-radius: 3px; 
     color: #fff; 
     background-color: green;
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
  background: lemonchiffon;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color:grey;
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
  background-color:burlywood;
}

/* Button styles */
button[type="submit"] {
  padding: 10px 20px;
  background-color: green;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}




.btn{
	color:green;
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
    left: 20px;
    z-index: 9999;
}

.logo-container img {
    width: 150px; 
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
            <h2>معلومات شخصية</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>: اسم </strong><br><?php echo $cvData['nom']; ?></p>
                <br>
                <p><strong>: اللقب</strong><br> <?php echo $cvData['prenom']; ?></p>
                <br>
                <p><strong>: تاريخ الميلاد </strong><br><?php echo $cvData['date_naissance']; ?></p>
                <br>
                <p><strong>: بريد إلكتروني </strong><br> <?php echo $cvData['email']; ?></p>
                <br>
                <p><strong>: هاتف  </strong><br> <?php echo $cvData['tel']; ?></p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2> التعليم</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>: التعليم  </strong><br><?php echo $cvData['education']; ?></p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2>خبرة</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>: خبرة </strong><br><?php echo $cvData['nom_entreprise']; ?> (<?php echo $cvData['date_debut']; ?> - <?php echo $cvData['date_fin']; ?>)</p>
            <?php endif; ?>
        </div>
        <div class="section">
            <h2>مهارات</h2>
            <br>
            <?php if(isset($cvData)): ?>
                <p><strong>: مهارات </strong><br><?php echo $cvData['skill1']; ?><br> <?php echo $cvData['skill2']; ?><br> <?php echo $cvData['skill3']; ?></p>
            <?php endif; ?>
        </div>
        <a href="telecharger_cv.php" target="_blank">Télécharger le CV en PDF</a>

    </div>

</body>
</html>