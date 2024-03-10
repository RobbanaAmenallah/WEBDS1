<?php
include 'admin.php'; 

function select(PDO $pdo, $username) {
    try {
       
        $stmt = $pdo->prepare("select * FROM user WHERE nom = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        // bch nchoufou les erreurs
        echo "Erreur: " . $e->getMessage();
        return false; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['T1']; 
    if (select($conn, $username) && ($username='nom')) { 
        echo "utilisateur existe.";
    } else {
        echo "utilisateur n existe pas .";
    }
}
?>