<?php

require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])) {
	$as   	= $_GET['as'];
	$item 	= $_GET['item'];
	
	switch($as) {
		case 'done':
			$doneQuerry = $$db->prepare("
				UPDATE todo_items
				SET done = 1
				WHERE id = :todo_item
				AND user = :todo_user
			");
		$doneQuerry->execute([
			'item' => $item,
			'user' => $_SESSION['user_id']
		]);
		break;
	}
}

header('Location: todo.php');