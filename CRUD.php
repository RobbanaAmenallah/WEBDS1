<?php
include 'conecti.php';

// bch nchoufou el method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['T1']; 

    // bch nchoufou el admin mawjoud wallé 
    $sql = "SELECT * FROM admin WHERE id=:id";
    
    // bch na3mlou requet preparé
    $stmt = $conn->prepare($sql);

    // norbtou el parametre b requet
    $stmt->bindParam(':id', $id);

    // exuction mta3 requet
    if ($stmt->execute()) {
        // Check if admin with provided ID exists
        if ($stmt->rowCount() > 0) {
          header("location: admin.php");

        } else {
            echo "Admin not found";
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $stmt->errorInfo()[2];
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
<title>RT CV Creator</title>
  <meta charset="utf-8">
 
  <style>
  html {
  height: 100%;
}
body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background-image: url('CV.jpg');
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

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

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
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
  <div class="login-box">
    <h2>Login</h2>
    <form method="post" action="">
    <div class="user-box">
        <input type="text" name="T1" required="">
        <label>ID</label>
      </div>
      <div class="user-box">
        <input type="text" name="T2" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="T3" required="">
        <label>Password</label>
      </div>
      <button type="submit" class="btn">submit</button>

     
    </form>
  </div>
</body>
</html>