<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include TCPDF library
require_once('tcpdf/tcpdf.php');

// Connect to your database (modify these parameters as needed)
$server = "localhost";
$username = "root";
$password = "";
$db = "njr";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Prepare and execute the SQL query to retrieve CV data
    $stmt = $conn->prepare("SELECT * FROM user WHERE nom = :nom");
    $stmt->bindParam(':nom', $_POST['T1'], PDO::PARAM_INT); // Assuming 'cv_id' is an integer, adjust the type accordingly
    $stmt->execute();
    $cvData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve form data
    $nom = $cvData['nom'] ?? '';
    $prenom = $cvData['prenom'] ?? '';
    $dn = $cvData['date_naissance'] ?? '';
    $email = $cvData['email'] ?? '';
    $tel = $cvData['tel'] ?? '';
    $education = $cvData['education'] ?? '';
    $nom_entreprise = $cvData['nom_entreprise'] ?? '';
    $dd = $cvData['date_debut'] ?? '';
    $df = $cvData['date_fin'] ?? '';
    $skill1 = $cvData['skill1'] ?? '';
    $skill2 = $cvData['skill2'] ?? '';
    $skill3 = $cvData['skill3'] ?? '';

    // HTML content with form fields and values
    $htmlContent = '
    <!DOCTYPE html>
    <html lang="fr">
    <head>
    <meta charset="UTF-8">
    <title>CV</title>
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
}    </head>
    <body>
    <div class="container">
    <h1>'.$nom.'</h1>
    <h2>'.$prenom.'</h2>
    <hr />
    <p><strong>Date de Naissance:</strong> '.$dn.'</p>
    <p><strong>Email:</strong> '.$email.'</p>
    <p><strong>Téléphone:</strong> '.$tel.'</p>
    <p><strong>Education:</strong> '.$education.'</p>
    <p><strong>Nom de l\'entreprise:</strong> '.$nom_entreprise.'</p>
    <p><strong>Date de début - Date de fin:</strong> '.$dd.' - '.$df.'</p>
    <p><strong>Compétences:</strong></p>
    <ul>
    <li>'.$skill1.'</li>
    <li>'.$skill2.'</li>
    <li>'.$skill3.'</li>
    </ul>
    </div>
    </body>
    </html>
    ';

    // Create new TCPDF object
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', true);

    // Set document title
    $pdf->SetTitle('CV');

    // Add a page
    $pdf->AddPage();

    // Include HTML content in PDF
    $pdf->writeHTML($htmlContent, true, false, true, false, '');

    // Clean (erase) the output buffer and stop output buffering
    ob_end_clean();

    // Output the PDF file with a download prompt
    $pdf->Output($nom . '-' . $prenom . '_temp3.pdf', 'D');
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>





