<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Quiz App</title>
  </head>
  <body>
    <div class="jumbotron">
      <h1 class="display-4" id="mainDesign"> Quiz App </h1>
    </div>

    <div class="container homePageButtons">
      <button type="button" class="btn btn-primary" onclick="login()">Login</button>
      <button type="button" class="btn btn-secondary" onclick="signup()">Signup</button>
    </div>

    <div class="container loginCredentials">
      <form action="main.php" method="post">
        <div class="form-group">
          <label for="inputUsername">Username</label>
          <input type="text" class="form-control" id="inputUsername" name="username">
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" class="form-control" id="inputPassword" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" onclick="goBackToHome()">Back</button>
      </form> <br>
    </div>

    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $valid = true;

        if(empty($_POST['username']) || empty($_POST['password'])){
          //echo "<script type=\"text/javascript\">console.log('loaded');</script>";
          echo "<script type=\"text/javascript\">alert('Please enter both a username and a password!');</script>";
          echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
        }

        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);

        $con = new mysqli('localhost', 'root', '', 'quizapp');
        
        if(mysqli_connect_errno()){
          echo "Failed to connect to database! " . mysqli_connect_error();
        }
        else{
          $result = mysqli_query($con, "SELECT * FROM registered_user WHERE user_name = '%{$username}%' AND user_password = '%{$password}%'");

          if(empty($result)){
            mysqli_close($con);
            echo "<script type=\"text/javascript\">alert('Invalid username or password!');</script>";
            echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
          }
          else{
            mysqli_close($con);
            session_start();
            $_SESSION['username'] = $username;
            echo "<script type=\"text/javascript\">alert('logged in!');</script>";
            echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
            //go to dashboard
          }
        }
      }

      function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="main.js"></script>
  </body>
</html>