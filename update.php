<?php
	require_once 'begin.php';
	if (isset($_GET['isDone'], $_GET['item'])) {
		$isDone = $_GET['isDone'];
		$item = $_GET['item'];
		
		switch($isDone){
			case 'done':
				$queryDone = $db->prepare("
					UPDATE items
					SET done=1
					WHERE id= :item
					AND user= :user"
					);				
				$queryDone->execute([
					'item' => $item,
					'user' => $_SESSION['user_id']
				]);		
			break;
			case 'notDone':
			$queryDone = $db->prepare("
					UPDATE items
					SET done=0
					WHERE id= :item
					AND user= :user"
					);				
				$queryDone->execute([
					'item' => $item,
					'user' => $_SESSION['user_id']
				]);		
			break;
		}		
	}
	header('Location: index.php');
?>