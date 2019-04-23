<!DOCTYPE HTML>
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
	
<?php
	if( ! empty($_POST['submit_course']) ){
		$mysqli = new mysqli( 'localhost', 'root', '', 'quizapp');
		if( $mysqli->connect_error){
			die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error);
		}

		$sql = "INSERT INTO course (Course_Name, Course_Description, Course_isOpen) VALUES ('{$mysqli->real_escape_string($_POST['courseName'])}','{$mysqli->real_escape_string($_POST['courseDesc'])}', '1')";

		$insert = $mysqli->query($sql);

		if($insert) {
			$message = "Success! Course: {$mysqli->real_escape_string($_POST['courseName'])} with ID: {$mysqli->insert_id} has been added";
			echo "<script type='text/javascript'>alert('$message');</script>";
		} else {
			die("Error: {$mysqli->errno} : {$mysqli->error}");
		}

		$mysqli->close();
	}else{

	}

	if( ! empty($_POST['submit_quiz']) ){
		$mysqli = new mysqli( 'localhost', 'root', '', 'quizapp');
		if( $mysqli->connect_error){
			die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error);
		}

		$sql = "INSERT INTO quiz (Quiz_Name, Quiz_Description, Quiz_Difficulty, Quiz_PassingScore, Course_ID) VALUES ('{$mysqli->real_escape_string($_POST['quizName'])}','{$mysqli->real_escape_string($_POST['quizDesc'])}','{$mysqli->real_escape_string($_POST['quizDiff'])}','{$mysqli->real_escape_string($_POST['quizPass'])}','{$mysqli->real_escape_string($_POST['quizCourseID'])}')";

		$insert = $mysqli->query($sql);

		if($insert) {
			$message = "Success! Quiz: {$mysqli->real_escape_string($_POST['quizName'])} with ID: {$mysqli->insert_id}, under Course ID: {$mysqli->real_escape_string($_POST['quizCourseID'])} has been added";
			echo "<script type='text/javascript'>alert('$message');</script>";
		} else {
			die("Error: {$mysqli->errno} : {$mysqli->error}");
		}

		$mysqli->close();
	}else{

	}
?>





	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="welcome.php">Quiz App</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="quizmaker.php">Quiz Maker <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">	
					<a class="nav-link" href="#">Quiz Taker</a>
				</li>
			</ul>
		</div>
		
		<form class="form-inline" action="main.php">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
		</form>
	</nav>
	
	<div class="card" style="width: 20rem;">
	
	<div class="card-body">
		<h5 class="card-title">CREATE A COURSE:</h5>
		<form method="post" action="quizmaker.php">
		<div class="form-group">
			<label for="formGroupExampleInput">Name</label>
			<input type="text" name="courseName" class="form-control" id="courseName">
		</div>
		<div class="form-group">
			<label for="formGroupExampleInput2">Description</label>
			<input type="text" name="courseDesc" class="form-control" id="courseDesc">
		</div>
			<input type="submit" name="submit_course" class="btn btn-primary" value="CREATE COURSE">
		</form>
	</div>
	<div class="card-body">
		<h5 class="card-title">CREATE A QUIZ:</h5>
		<form method="post" action="quizmaker.php">
			<div class="form-group">
				<label for="formGroupExampleInput2">Course ID</label>
				<input type="text" name="quizCourseID" class="form-control" id="quizCourseID">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput">Name</label>
				<input type="text" name="quizName" class="form-control" id="quizName">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput2">Description</label>
				<input type="text" name="quizDesc" class="form-control" id="quizDesc">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput2">Difficulty</label>
				<input type="text" name="quizDiff" class="form-control" id="quizDiff">
			</div>
			<div class="form-group">
				<label for="formGroupExampleInput2">Passing Score</label>
				<input type="text" name="quizPass" class="form-control" id="quizPass">
			</div>
				<input type="submit" name="submit_quiz" class="btn btn-primary" value="CREATE QUIZ">
		</form>
	</div>
	
	</div>
	
	
  
  
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  </body>
  
</html>