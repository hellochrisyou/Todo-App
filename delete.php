<?php
require_once 'begin.php';
//Delete All Items
if (isset($_GET['deleteAll'])) {
    $deleteAll = $_GET['deleteAll'];
    $queryDone = $db->prepare("
			DELETE FROM items");
    $queryDone->execute();
}
//Delete One Item
else if (isset($_GET['item'])) {
    $item = $_GET['item'];
    $queryDone = $db->prepare("
			DELETE FROM items			
			WHERE id= :item
			AND user= :user");
    $queryDone->execute(['item' => $item, 'user' => $_SESSION['user_id']]);
}
header('Location: index.php');
?>