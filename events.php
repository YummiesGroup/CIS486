<?php
header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=system;host=127.0.0.1","root","");


$action= (isset($_GET['action']))?$_GET['action']:'leer';

switch ($action) {
	case 'add':
		//instruction of add
		$sentenceSQL = $pdo->prepare("INSERT INTO events(title,name,number,address,description,total,color,textColor,start,end)VALUES(:title,:name,:number,:address,:description,:total,:color,:textColor,:start,:end)");

		$answer=$sentenceSQL->execute(array(
			"title" =>$_POST['title'],
			"name" =>$_POST['name'],
			"number" =>$_POST['number'],
                        "address" =>$_POST['address'],
			"description" =>$_POST['description'],
			"total" =>$_POST['total'],
			"color" =>$_POST['color'],
			"textColor" =>$_POST['textColor'],
			"start" =>$_POST['start'],
			"end" =>$_POST['end'],
		));
		echo json_encode($answer);
		break;
	case 'delete':
		$answer=false;
		
		$sentenceSQL= $pdo->prepare("DELETE FROM events WHERE ID=:ID");
		$answer= $sentenceSQL->execute(array("ID"=>$_POST['id']));
		
		echo json_encode($answer);
		break;
	case 'modify':
		//instruction of modify
		$sentenceSQL = $pdo->prepare("UPDATE events SET 
		title=:title,
		name=:name,
		number=:number,
                address=:address,
		description=:description,
		total=:total,
		color=:color,
		textColor=:textColor,
		start=:start,
		end=:end
		WHERE ID=:ID
		");

		$answer=$sentenceSQL->execute(array(
			"ID" =>$_POST['id'],
			"title" =>$_POST['title'],
			"name" =>$_POST['name'],
			"number" =>$_POST['number'],
                        "address" =>$_POST['address'],
			"description" =>$_POST['description'],
			"total" =>$_POST['total'],
			"color" =>$_POST['color'],
			"textColor" =>$_POST['textColor'],
			"start" =>$_POST['start'],
			"end" =>$_POST['end'],
		));
		echo json_encode($answer);

		break;
	default:
		//select events
			$sentenceSQL= $pdo->prepare("SELECT * FROM events");
			$sentenceSQL->execute();

			$result= $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($result);
		break;
}




?>