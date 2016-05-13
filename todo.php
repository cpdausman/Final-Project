<?php
/*
This is the note taking web application project for CS214 by Chris Dausman (cpd6).
This is the main page of my php project.
By setting up APACHE24 as a local webserver (accessable by going to localhost
in any Web Browser) I can view the various executed or html documents of all the files
C:\APACHE24\htdocs\.
I had to make various modifications to the php.ini (initialization) file by uncommenting
various lines of code -> https://www.youtube.com/watch?v=kuMTZowwjus
Also huge thanks to youtuber Alessandro Castellani for the essential help of
setting up MYSQL and PHP and APACHE. Let me not forget the php.net/manual that saved my mind numerous
times.
The other files I submit will also have the sources of help cited at the top.

*/
//define('__Root__', dirname('C:\Apache24\htdocs')); 
//set_include_path('/Apache24/htdocs');
//This problem was fixed by my recompiling the php.ini file 
// and uncommenting the extension=php_pdo_mysql.dll
require_once "app/inits.php";


/*initializing the items in my querry to select the id, name, and done sections of items
database. Also unsure as to whether or not this worked completely.
*/
$itemsQuerry = $db->prepare("
	SELECT id, name, done
	FROM items
	WHERE user = :user
");
/*This was supposed to set the user_id as set in inits.php line 5.
I'm unsure as to whether or not this worked
*/
$itemsQuerry->execute([
	'user' => $_SESSION['user_id']
]);

if($itemsQuerry->rowCount() > 0){
	$items = $itemsQuerry;
}else {
	$items = [];
}
//$items = $itemsQuerry->rowCount() ? $itemsQuerry : [];

/*I did this to try and view the various items in MYSQL data set, but it kept outputting
an empty array so... yeah.
*/
//echo '<pre>', print_r($items), '</pre>';

//The basic php html document structure below was found by watching youtube tutorials
//for presentation
//<span class="item">Create a to do list</span>
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To do list</title>
		
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link rel="stylesheet" href="td/td_front_end.css"
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="list">
			<h1 class="header">To do.</h1>
			<?php if(!empty($items)): ?>
			
			<ul class="items">
				<?php foreach($items as $item): ?>
				<li>
					<span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?>t</span>
					<?php if(!$item['done']):?>
						<a href="mark-read.php?as=done&item=1"<?php echo $item['id']; ?> class="done-button">Mark as done</a>
					<?php endif;?>
				</li>
			<?php endforeach;?>	
			</ul>
			<?php else: ?>
				<p>You haven't added any items yet.<p>
			<?php endif; ?>
			<form class="item-add" action="add.php" method="post">
				<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
				<input type="submit" value="Add" class="submit">	
			</form>
		</div>
	<body>
</html>