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
        <input type="hidden" name="form" value="login">
        <div class="form-group">
          <label for="inputUsername">Username</label>
          <input type="text" class="form-control" id="inputUsername" name="username">
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" class="form-control" id="inputPassword" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <button type="button" class="btn btn-secondary" onclick="goBackToHome()">Back</button>
      </form> <br>
    </div>

    <div class="container signup">
      <form action="main.php" method="post">
        <input type="hidden" name="form" value="signup">
        <div class="form-group">
          <label for="signupUser">Username</label>
          <input type="text" class="form-control" id="signupUser" name="signupUser">
        </div>
        <div class="form-group">
          <label for="signupPassword">Password</label>
          <input type="password" class="form-control" id="signupPassword" name="signupPassword">
        </div>
        <div class="form-group">
          <label for="signupEmail">Email</label>
          <input type="email" class="form-control" id="signupEmail" name="signupEmail">
        </div>
        <div class="form-group">
          <label for="signupAddress">Address</label>
          <input type="text" class="form-control" id="signupAddress" name="signupAddress">
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
        <button type="button" class="btn btn-secondary" onclick="goBackToHome()">Back</button>
      </form> <br>
    </div>

    <?php
      //if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['form'])){
        switch($_POST['form']){
          case 'login':
            if(empty($_POST['username']) || empty($_POST['password'])){
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
              $result = mysqli_query($con, "SELECT * FROM registered_user WHERE User_Name = '$username' AND User_Password = '$password'");

              if(!mysqli_fetch_row($result)){
                mysqli_close($con);
                echo "<script type=\"text/javascript\">alert('Invalid username or password!');</script>";
                echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
              }
              else{
                mysqli_close($con);
                session_start();
                $_SESSION['username'] = $username;
                $_POST = array();
                header('Location: welcome.php');
              }
            }
            break;

          case 'signup':
            $valid = true;

            if(empty($_POST['signupUser']) || empty($_POST['signupPassword']) || empty($_POST['signupEmail']) || empty($_POST['signupAddress'])){
              echo "<script type=\"text/javascript\">alert('Please enter data in all the fields!');</script>";
              echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
            }

            $username = test_input($_POST['signupUser']);
            $password = test_input($_POST['signupPassword']);
            $email = test_input($_POST['signupEmail']);
            $address = test_input($_POST['signupAddress']);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
              echo "<script type=\"text/javascript\">alert('Please enter a valid email!');</script>";
              echo "<script type=\"text/javascript\">window.location.replace('main.php');</script>";
            }

            $con = new mysqli('localhost', 'root', '', 'quizapp');

            if(mysqli_connect_errno()){
              echo "Failed to connect to database! " . mysqli_connect_error();
            }
            else{
              $sql = "INSERT INTO registered_user (user_name, user_email, user_address, user_password) VALUES ('$username', '$email', '$address', '$password')";

              if($con->query($sql) === true){
                mysqli_close($con);
                session_start();
                $_SESSION['username'] = $username;
                $_POST = array();
                header('Location: welcome.php');
              }
              else{
                echo "Error! Could not insert into database!" . $con->error;
                die();
              }
            }
            break;

          default:
            break;
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