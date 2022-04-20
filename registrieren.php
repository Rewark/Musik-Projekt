<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Registrieren</title>
        <link rel="stylesheet" href="css\\login.css">
    </head>
    <body>
        <header> 
            <div id="logo">
                <a href="index1.html"><img src="Foto\\logo4.png" alt ="Logo">
                    </a></h2>DJ Musik</h2>
            </div>
                <nav id="main-nav">
                    <ul>
                        <li><a href="index1.html">Home</a></li>
                        <li><a href="#">kontakt</a></li>
                        <li><a href="login.php">login </a></li>
                    </ul>
                </nav>
            </header> <br> <br><br>
        <div container-fluid>    
        <h1><img src="Foto//logo4.png" alt="logo"> DJ Musik</h1>
          <?php
          if(isset($_POST["button"])){
              require_once(".\\model\\dbconnect.inc.php");
              $statement = $dbh->prepare("SELECT * FROM user WHERE username=:user");
              $statement->bindparam(":user", $_POST["username"]);
              $statement->execute();
              $count = $statement->rowCount();
              if($count == 0){
                  //Username ist frei
                  if($_POST["password"] == $_POST["password1"]){
                      //user anlegen
                      $statement = $dbh->prepare("INSERT INTO user (username, password) VALUES (:user, :pw)");
                      $statement->bindparam(":user", $_POST["username"]);
                      $hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
                      $statement->bindparam(":pw", $hash);
                      $statement->execute();
                      echo "<p class='par'>Dein Accont wurde angelegt</p>";
                  } else {
                      echo "<p class='par'>Die Passwörter stimmen nicht überein</p>";
                  }
              } else {
                  echo "<p class='par'>Der Username ist bereits vergeben</p>";
              }
          }
          ?>
        
            <form class="login" actio = "login.php" method = "post">
            <h2>Registriren</h2>
                <input type = "text" name="username" placeholder="Username">
                <input type ="password" name="password" placeholder="Password">
                <input type ="password" name="password1" placeholder="Password wiederholen">
                <input type = "submit" name ="button" value = "Registriren">
                <h3>Du hast bereits ein Konto?</h3>
                <a href="login.php">Anmelden</a>
                </form>
                
    </body>
</html>