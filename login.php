<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Anmelden</title>
        <link rel="stylesheet" href="css\\login.css">
    </head>
    <body>
        <header> 
            <div id="logo">
                <a href="index1.html"><img src="Foto\\logo4.png" alt ="Logo">
                DJ Musik</a>
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
        session_start();
          if(isset($_POST["button"])){
              require_once(".\\model\\dbconnect.inc.php");
              $statement = $dbh->prepare("SELECT * FROM user WHERE username=:user");
              $statement->bindparam(":user", $_POST["username"]);
              $statement->execute();
              $count = $statement->rowCount();
              if($count == 1){
                  //Username ist frei
                 $row = $statement->fetch();
                 if(password_verify($_POST["password"], $row["password"])){
                    $_SESSION["username"] = $row["username"];
                    header("location: index1.html");
                 } else {
                     echo "<p class='par'>Passwotr ist falsch</p>";
                 }
              } else {
                  echo "<p class='par'>Username ist nicht vorhanden</p>";
              }
          }
          ?>
        
            <form class="login" actio = "login.php" method = "post">
            <h2>Anmelden </h2>
                <input type = "text" name="username" placeholder="Username">
                <input type ="password" name="password" placeholder="Password">
                <input type = "submit" name ="button" value = "Anmelden">
                <h3>Du hast kein Konto?</h3>
                <a href="registrieren.php">Bei DJ Musik Registrieren</a>
                </form>                
    </body>
</html>