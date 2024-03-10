<?php
include 'conecti.php';

class Admin {
    private $id;
    private $username;
    private $password;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // bch na3mlou hydratation lel objet admin avec un tableau
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // CRUD 

    // Cbch nasn3ou user jdid
    public function create(PDO $pdo) {
        $stmt = $pdo->prepare("INSERT INTO user (nom,mail,password) VALUES (?,?,?)");
        
        return $stmt->execute();
    }

    // bch nlawjou ala user
    public static function getById(PDO $pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $admin = new Admin();
        $admin->hydrate($data);
        return $admin;
    }

    // bch na"mlou update l user 
    public function update(PDO $pdo) {
        $stmt = $pdo->prepare("UPDATE user SET nom = :username, password = :password WHERE id = :id");
        $stmt->bindParam(':username', $this->nom);
        $stmt->bindParam(':email', $this->mail);
        $stmt->bindParam(':password', $this->password);
        return $stmt->execute();
    }

    // bch nfasskhou user
    public function delete(PDO $pdo) {
        $stmt = $pdo->prepare("DELETE FROM user WHERE nom = :username");
        $stmt->bindParam(':username', $this->nom);
        return $stmt->execute();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT CV Creator</title>
    <style>
        body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background-image: url('CV.jpg');
}
        .titre{
            text-align:center;
            color:#C7A7B3;
        }
        .add{
            text-align: center;
            color:#C7A7B3;

        }
        .update{
            text-align: center;
            color:#C7A7B3;

        }
        .select{
            text-align: center;
            color:#C7A7B3;

        }
        .delete{
            text-align: center;
            color:#C7A7B3;

        }
        #f1{
            text-align: center;
        }
        #f2{
            text-align: center;
        }
        #f3{
            text-align: center;
        }
        #f4{
            text-align: center;
        }
        .tab {
  width: 30%; 
  margin: 0 auto; 
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

.btn {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #C7A7B3;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #FC6736;
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
.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 600px; /* Ajuster la largeur selon votre préférence */
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

/* Autres règles CSS restent inchangées */


.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #f68e44;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #b79726;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #f49803;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #f4c803,
              0 0 25px #bd9d0b,
              0 0 50px #f4e403,
              0 0 100px #d5cf1e;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #f4c003);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #f4bc03);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #f4dc03);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #f4b003);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}
label{
    color:white;
}
    </style>
</head>
<body>
<div class="logo-container">
        <img src="1.png" alt="Logo">
    </div>
    <div class="login-box">
    <h1 class="titre">CRUD ADMIN</h1>

    <h2 class="add">Ajouter un nouveau utilisateur</h2>
    <form action="create.php" method="post" id="f1">
        <table class="tab">
            <tr>
       <td><label for="username">Nom</label></td>
        <td><input type="text" id="username" name="T1" required></td>
             </tr>
        <tr>
        <td><label for="new_username">Email</label></td>
        <td><input type="text" id="new_username" name="T2"></td>
    </tr>
        <tr>
        <td><label for="password">MDP </label></td>
        <td><input type="password" id="password" name="T3" required></td>
    </tr>
    </table>
    <input type="submit" value="Ajouter" class="btn" >

    </form>

    <h2 class="update">Mise à jour d un utilisateur</h2>
    <form action="update.php" method="post" id="f2">
        <table class="tab">
            <tr>
        <td><label for="update_id">Nom </label></td>
        <td><input type="text" id="update_id" name="T1" required ></td>
    </tr>
        <tr>
        <td><label for="new_username">E-mail </label></td>
        <td><input type="text" id="new_username" name="T2"></td>
    </tr>
        <tr>
        <td><label for="new_password">Password </label></td>
       <td><input type="password" id="new_password" name="T3"></td>
    </tr>
    </table>
    <input type="submit" value="Mise à jour" class="btn">

    </form>

    <h2 class="delete">Suppression d'un utilisateur</h2>
    <form action="delete.php" method="post" id="f3">
        <table class="tab">
            <tr>
        <td><label for="delete_id">Nom</label></td>
        <td><input type="text" id="delete_id" name="T1" required></td>
    </tr>
    </table>
        <input type="submit" value="Supprimer" class="btn">
    </form>

    <h2 class="select">Recherche d'un utilisateur</h2>
    <form action="select.php" method="post" id="f4">
        <table class="tab">
            <tr>
        <td><label for="admin_id">Nom</label></td>
        <td><input type="text" id="admin_id" name="T1" required></td>
    </tr>
    </table>
        <input type="submit" value="Recherche" class="btn">
    </form>
</body>
</html>



