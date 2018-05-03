<?php session_start();

//set vars
$_SESSION['na'] = false; 

$user = $_POST['uname'];
$pass = ($_POST['pass']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "system";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT name FROM users WHERE name = '$user' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $vname = $row['name'];
    }
} if (!isset($vname)) {
    echo 'username not found';
    exit;
}




$sql = "SELECT pass FROM users WHERE name = '$user' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $vpass = $row['pass'];
    }
}

        if ($vpass == $pass) {
            
     $_SESSION['na'] = true; 
            
header('Location: index.php');    
        } 
        echo ' nope';
//        header('Location: index.php');
        exit
        
    

    
        
//        if (password_verify($pass, $vpass)) {
//            echo "match";
//        }
//
//        echo' wrong';
   
        

?>