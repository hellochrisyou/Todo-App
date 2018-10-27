<?php
require_once "begin.php";
//Sorting
if (isset($_GET['isSort'])) {
    $isSort = $_GET['isSort'];
    switch ($isSort) {
        case 'active':
            $callItem = "SELECT id, name, done FROM items WHERE done=0";
            $query_item = $db->prepare($callItem);
            $query_item->execute(['user' => $_SESSION['user_id']]);
            $items = $query_item->fetchAll();
        break;
        case 'done':
            $callItem = "SELECT id, name, done FROM items WHERE done=1";
            $query_item = $db->prepare($callItem);
            $query_item->execute(['user' => $_SESSION['user_id']]);
            $items = $query_item->fetchAll();
        break;
        default:
            $callItem = "SELECT id, name, done FROM items";
            $query_item = $db->prepare($callItem);
            $query_item->execute(['user' => $_SESSION['user_id']]);
            $items = $query_item->fetchAll();
    }
}
//Default Sorting
else {
    $callItem = "SELECT id, name, done FROM items";
    $query_item = $db->prepare($callItem);
    $query_item->execute(['user' => $_SESSION['user_id']]);
    $items = $query_item->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <title>Todo</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"/>
      <link href="https://fonts.googleapis.com/css?family=Archivo+Black|Work+Sans:300,400,600" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
   </head>
   <body>
      <!-- Header -->
      <div class="container" id="header">
         <div class="row">
            <img class="col-1" id="todo-image" src="assets/todo.png">						
            <p class="col" id="todo-title">Todo</p>
         </div>
      </div>
      <!--Create Task-->
      <div class="container" style="margin-top:50px">
         <div class="row">
            <form method="post" action="add.php" style="width:100%" role="form">
               <div class="form-group">
                  <input type="text" name ="name" class="form-control" placeholder="Type your next task here...">
                  <a href="add.php"><button class="btn btn-primary col-auto" type="submit">Create</button></a>			
               </div>
            </form>
         </div>
      </div>
      <!--Toolbar-->
      <div class="container" style="margin-bottom:0px; margin-top:30px">
         <div class="row">
            <p class="text-primary col-auto" id="total-active">Active:</p>
            <p id="number-active-tasks col" id="total-active">
               <?php 
                  $counter=0;
                  foreach ($items as $item) {
                  	if(!$item['done']){
                  		$counter++;
                  	}
                  }
                  echo $counter;
                  ?>
            </p>
            <div class="btn-group show-on-hover col offset-9">
               <button type="button" class="btn btn-default dropdown-toggle" style="background-color:transparent">Sort<span class="caret"></span></button>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="index.php?isSort=all">All</a></li>
                  <li><a href="index.php?isSort=active">Active</a></li>
                  <li><a href="index.php?isSort=done">Completed</a></li>
               </ul>
            </div>
            <a href="delete.php?deleteAll=true" class="col-auto"><button class="btn btn-danger" type="submit">Delete All</button></a>	
         </div>
      </div>
      <!--Task List-->
      <div class="container" style="margin-top:0px">
         <div class="row">
            <?php foreach ($items as $item): ?>
            <li class="list-group-item list-group-item-action item<?php echo $item['done']==1? ' done' : '' ?>">
               <?php echo $item['name']; ?>
               <div class="row justify-content-end col" style="width:100%; margin: 0 auto">
                  <?php if(!$item['done']): ?>
                  <a href="update.php?isDone=done&item=<?php echo $item['id']; ?>" class="button col-auto">
                  <i class="fa fa-square-o" style="color:green; margin-right:15px;" aria-hidden="true"></i>
                  </a>
                  <?php else: ?>						
                  <a href="update.php?isDone=notDone&item=<?php echo $item['id']; ?>" class="button col-auto">
                  <i class="fa fa-check-square-o" style="color:green; margin-right:15px;" aria-hidden="true"></i>
                  </a>
                  <?php endif; ?>
                  <a href="delete.php?&item=<?php echo $item['id']; ?>" class="col-auto"><i class="fa fa-times delete-button" style="color:red" aria-hidden="true"></i></a>
               </div>
            </li>
            <?php endforeach; ?>
         </div>
      </div>
   </body>
</html>