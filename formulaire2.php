<?php

include 'conecti.php';

function cvput($nom, $prenom, $date_naissance, $email, $tel, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3, $conn) {
    $sql = "INSERT INTO cv1 (nom, prenom, date_naissance, email, tel, nom_entreprise, date_debut, date_fin, skill1, skill2, skill3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $date_naissance, $email, $tel, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nom = $_POST['nom']; // Utilisez $nom ici
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email']; // Utilisez $email ici
    $tel = $_POST['tel'];
    $nom_entreprise = $_POST['nom_entreprise']; // Utilisez $nom_entreprise ici
    $date_debut = $_POST['date_debut']; // Utilisez $date_debut ici
    $date_fin = $_POST['date_fin'];
    $skill1 = $_POST['skill1'];
    $skill2 = $_POST['skill2'];
    $skill3 = $_POST['skill3'];

    // Create user
    cvput($nom, $prenom, $date_naissance, $email, $tel, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3, $conn);
    echo "User created successfully!";
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RT CV Creator</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url('CV.jpg');

    }

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        padding: 10px;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
    body {
  height: 100vh;
  background-image: url('CV.jpg');
  overflow-y: hidden!important;
	 font-family: 'Poppins', sans-serif;
}
 a {
	 text-decoration: none;
	 color: #01939c;
	 transition: 0.5s ease;
}
 a:hover {
	 color: #179b77;
}
.logo-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.logo-container img {
    width: 150px; 
    height: auto; 
}
form {
	background-color:#DEB887;
    
}
.btn {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff; /* Couleur du bouton */
    color: #ffffff; /* Couleur du texte */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3; /* Couleur du bouton au survol */
}
.btn {
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 300%;
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transition: all 0.5s ease;
    transform: translate(-50%, -50%);
    z-index: 0;
}

.btn:hover::before {
    width: 0;
    height: 0;
}

.btn span {
    position: relative;
    z-index: 1;
}

</style>
</head>
<body>
<div class="logo-container">
        <img src="1.png" alt="Logo">
    </div>
<form action="" method="POST">
    <table>
        <caption><h2>السيرة الذاتية</h2></caption>
        <tr>
            <th colspan="2">معلومات شخصية</th>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="nom" required></td>

            <td><label for="nom">: اسم</label></td>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="prenom" required></td>
            <td><label for="prenom">: اللقب </label></td>
        </tr>
        <tr>
        <td><input type="date" id="arabicInput" name="date_naissance" required></td>
            <td><label for="date_naissance">: تاريخ الميلاد </label></td>
        </tr>
        <tr>
        <td><input type="email" id="email" name="email" required></td>

            <td><label for="email">: بريد إلكتروني </label></td>
        </tr>
        <tr>
        <td><input type="tel" id="arabicInput" name="tel" required></td>

            <td><label for="tel">: هاتف </label></td>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="education" required></td>
            <td><label for="education"> : التعليم</label></td>
        </tr>
        <tr>
            <th colspan="2">خبرة</th>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="nom_entreprise" required></td>

            <td><label for="nom_entreprise">:  اسم الشركة </label></td>
        </tr>
        <tr>
        <td><input type="date" id="arabicInput" name="date_debut" required></td>

            <td><label for="date_debut">:  تاريخ البدء</label></td>
        </tr>
        <tr>
        <td><input type="date" id="arabicInput" name="date_fin"></td>

            <td><label for="date_fin">: تاريخ النهاية </label></td>
        </tr>
        <tr>
            <th colspan="2">مهارات</th>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="skill1" required></td>

            <td><label for="skill1">: كفاءة 1 </label></td>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="skill2" required></td>

            <td><label for="skill2">: 2 كفاءة </label></td>
        </tr>
        <tr>
        <td><input type="text" id="arabicInput" name="skill3" required></td>

            <td><label for="skill3">: كفاءة 3 </label></td>
        </tr>
    </table>
    <div>
        <button type="submit" class="btn">Enregistrer</button>
        <button type="button" class="btn" onclick="window.location.href='temp1.php'">Recevoir CV</button>
    </div>
</form>


<script>
document.getElementById("arabicInput").addEventListener("keypress", function(event) {
    var arabicCharacters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]/; // Plage Unicode pour les caractères arabes

    var key = event.key;
    if (!arabicCharacters.test(key) && key !== " " && key !== "\n") { // Permettre les espaces et les retours à la ligne
        event.preventDefault();
    }
});
</script>
</body>
</html>