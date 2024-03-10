<?php

include 'conecti.php';

function cvput($nom, $prenom, $date_naissance, $email, $tel,$education, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3, $conn) {
    $sql = "INSERT INTO cv1 (nom, prenom, date_naissance, email, tel,education, nom_entreprise, date_debut, date_fin, skill1, skill2, skill3) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom, $date_naissance, $email, $tel,$education, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nom = $_POST['nom']; // Utilisez $nom ici
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email']; // Utilisez $email ici
    $tel = $_POST['tel'];
    $education= $_POST['education'];
    $nom_entreprise = $_POST['nom_entreprise']; // Utilisez $nom_entreprise ici
    $date_debut = $_POST['date_debut']; // Utilisez $date_debut ici
    $date_fin = $_POST['date_fin'];
    $skill1 = $_POST['skill1'];
    $skill2 = $_POST['skill2'];
    $skill3 = $_POST['skill3'];

    // Create user
    cvput($nom, $prenom, $date_naissance, $email, $tel,$education, $nom_entreprise, $date_debut, $date_fin, $skill1, $skill2, $skill3, $conn);
    echo "User created successfully!";
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulaire</title>
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
    form{
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

<form action="" method="POST">
    <table>
        <caption><h2>Formulaire CV</h2></caption>
        <tr>
            <th colspan="2">Personal Informations</th>
        </tr>
        <tr>
            <td><label for="nom">Last Name :</label></td>
            <td><input type="text" id="nom" name="nom" required></td>
        </tr>
        <tr>
            <td><label for="prenom">First Name :</label></td>
            <td><input type="text" id="prenom" name="prenom" required></td>
        </tr>
        <tr>
            <td><label for="date_naissance">Date of birth :</label></td>
            <td><input type="date" id="date_naissance" name="date_naissance" required></td>
        </tr>
        <tr>
            <td><label for="email">E-mail :</label></td>
            <td><input type="email" id="email" name="email" required></td>
        </tr>
        <tr>
            <td><label for="tel">Téléphone :</label></td>
            <td><input type="tel" id="tel" name="tel" required></td>
        </tr>
        <tr>
            <td><label for="education">Education :</label></td>
            <td><input type="text" id="edu" name="education" required></td>
        </tr>
        <tr>
            <th colspan="2">Experience</th>
        </tr>
        <tr>
            <td><label for="nom_entreprise">Company Name :</label></td>
            <td><input type="text" id="nom_entreprise" name="nom_entreprise" required></td>
        </tr>
        <tr>
            <td><label for="date_debut">Start date :</label></td>
            <td><input type="date" id="date_debut" name="date_debut" required></td>
        </tr>
        <tr>
            <td><label for="date_fin">End Date :</label></td>
            <td><input type="date" id="date_fin" name="date_fin"></td>
        </tr>
        <tr>
            <th colspan="2">Competences</th>
        </tr>
        <tr>
            <td><label for="skill1">Competence 1 :</label></td>
            <td><input type="text" id="skill1" name="skill1" required></td>
        </tr>
        <tr>
            <td><label for="skill2">Competence 2 :</label></td>
            <td><input type="text" id="skill2" name="skill2" required></td>
        </tr>
        <tr>
            <td><label for="skill3">Compéetence 3 :</label></td>
            <td><input type="text" id="skill3" name="skill3" required></td>
        </tr>
    </table>
    <div>
        <button type="submit" class="btn">Enregistrer</button>
        <button type="button" class="btn" onclick="window.location.href='temp2.php'">Recevoir CV</button>
    </div>
</form>

</body>
</html>