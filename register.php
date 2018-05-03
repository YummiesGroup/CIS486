<?php session_start();






$link = mysqli_connect("localhost", "root", "", "system");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$usern = mysqli_real_escape_string($link, $_REQUEST['uname']);
$pass = mysqli_real_escape_string($link, $_REQUEST['pass']);
//$hpass = password_hash($pass, PASSWORD_DEFAULT);
// attempt insert query execution
$sql = "INSERT INTO users (name,pass) VALUES ('$usern', '$pass');";
if (mysqli_query($link, $sql)) {
    echo "Records added successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

//if (isset($_SESSION['na'])){
//header('Location: index.php');
//}

?>
