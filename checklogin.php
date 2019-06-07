<?php
    session_start();
    $conn = new mysqli('localhost','root','','concurrent');
    if($conn->connect_error){
        die("Connection faild: " . $conn->connect_error);
    }
?>
<h1>Inloggen</h1>
        <form action="checklogin.php" method="post">
            <input name="u" placeholder="Gebruikersnaam" type="text">
            <br/>
            <input  name="p" type="password" placeholder="Wachtwoord">
            <br/>
            <button type="submit">log in</button>
            <a href="register.php">register</a>
        </form>
	<?php
if($_SERVER{"REQUEST_METHOD"} == "POST"){
    $user = $_POST["u"];
    $password = $_POST["p"];
	$_SESSION["usernaam"] = $user;

    $slq = "select * FROM user where Naam = '$user' and Wachtwoord = '$password' ";
    $result = $conn->query($slq);
    if($result->num_rows > 0){
        
        $_SESSION["logedin"] = true;
			
        $sql = "select ID from user where Naam = '$user' AND Wachtwoord = '$password'";
        $result = $conn->query($sql);
        if (!$result) {
            trigger_error('Invalid query'. $conn->error);
            exit;
        }
        $row = $result->fetch_assoc();
        $_SESSION["userID"] = $row["ID"];
		

        header('location: website fietsenzaak.php');
			
    }else{
        echo "Fout wachtwoord of gebruikersnaam";
    }
}
?>