<?php
	require_once 'begin.php';
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
			if(!empty($name)){ 
				$addQuery= $db->prepare("INSERT INTO items (name, user) VALUES (:name, :user)");
				$addQuery->execute(['name'=> $name, 'user'=> $_SESSION['user_id']]);
			}
	}
	header('Location: index.php');
?>