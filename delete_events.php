<?php
try {
    $pdo=new PDO("mysql:dbname=system;host=127.0.0.1","root","");
} catch(Exception $e) {
    exit('Unable to connect to database.');
}
$id = $_POST['id'];
$sql = "DELETE from events WHERE id=".$id;
$q = $pdo->prepare($sql);
$q->execute();
?>