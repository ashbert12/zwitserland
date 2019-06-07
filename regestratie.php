<?php
    $conn = new mysqli('localhost','root','','concurrent');
    if($conn->connect_error){
        die("Connection faild: " . $conn->connect_error);
    }
?>
<html>
	<head>
		<title>Regestratie</title>
		<link rel="stylesheet" type="text/css" href="fietsenzaak.css">
		<style>
				.error {color: #FF0000;}
	input[type=text]{
		width: 15%;
		padding: 5px 2px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	
	input[type=password]{
		width: 15%;
		padding: 5px 2px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	
		</style>
	</head>
	<body>
	<div class="container">
	<header>
	<a href="website fietsenzaak.php">
	<img style="width:400px; height:150px" src="afb/logo.png"/>
	</header>
	</a>
		<nav>
			<ul>
		<li><a class="active" href="">Home</a></li>
			<li><a href="webshop.php">Webshop</a></li>
			<li><a href="regestratie.php">Regestratie</a></li>
			<li><a href="afspraak.php">Afpsraak</a></li>
			<li><a href="contact.html">Contact</a></li>
			<li><a href="over ons.php">Over ons</a></li>
			</ul>
		</nav>
<?php
// define variables and set to empty values
$nameErr = $passwordErr = $genderErr = $websiteErr = "";
$name = $password = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Naam"])) {
    $nameErr = "Name is required";
  } else {
    $name = $_POST["Naam"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["Wachtwoord"])) {
    $passwordErr = "Email is required";
  } else {
    $password = $_POST["Wachtwoord"];
    // check if e-mail address is well-formed
    
  }
    
  if (empty($_POST["Plaats"])) {
    $websiteErr = "website is required";
  } else {
    $website = $_POST["Plaats"];
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    
  }

  if (empty($_POST["Postcode"])) {
    $comment = "comment is required";
  } else {
    $comment = $_POST["Postcode"];
  }

  if (empty($_POST["Telefoon"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = $_POST["Telefoon"];
  }

  $sql = "INSERT INTO `user` (Naam, Wachtwoord, Plaats, Postcode, Telefoon)
  VALUES ('$name', '$password', '$website', '$comment', '$gender')";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<article>
<h2>Regestratie</h2>
<p><span class="error">* Verplicht.</span></p>
<form method="post" action="website fietsenzaak.php">  
  Naam: <input type="text" name="Naam" value="">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Wachtwoord: <input type="password" name="Wachtwoord" value="">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Postcode: <input type="text" name="Postcode" value="">
  <span class="error">* <?php echo $websiteErr;?></span>
  <br><br>
  Plaats: <input type="text" name="Plaats" value="">
  <br><br>
  Telefoon:<input type="text" name="Telefoon" value="">
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <button type="submit">Verzenden</button>  
</form>


</article>
		<footer>
			&copy; 2018 De Concurrent - Alle rechten voorbehouden
		</footer>
	</div>
	</body>
</html>