<?php

require_once 'app/inits.php';

if(isset($_POST['name'])) {
	$name = trim($_POST['name']);
	
	if(!empty($name)) {
		$addedQuerry = $db->prepare("
			INSERT INTO items (name, user, done, created)
			VALUES (:name, :user, 0, NOW())	
		");
		$addedQuerry->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
		]);
	}
}
header('Location: todo.php');
?>

