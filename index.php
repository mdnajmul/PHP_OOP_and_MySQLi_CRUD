<?php include "header.php"; ?>


<?php

   	spl_autoload_register(function($class_name){
		
		include $class_name.".php";
	});

?>

<?php
   //create a object of 'Database' class
   $db = new Database();
   //write select query
   $query = "select * from tbl_user";
   //call 'select()' method from 'Database' class & put result inside $read variable
   $read = $db->select($query);

?>

<?php

   //catch the message& show the message
   if(isset($_GET['msg'])){
	   //show message
	   echo "<span style='color:green'>".$_GET['msg']."</span>";
   }

?>


<!-- Create a table for show data from database table -->
	<table class="tblone">

		<tr>
		    <th width="10%">Serial</th>
			<th width="30%">Name</th>
			<th width="23%">Mail</th>
			<th width="15%">Skill</th>
			<th width="22%">Action</th>
		</tr>
		
	<?php if($read){?>
       <?php
       $i = 1;	   
	   while($row = $read->fetch_assoc()){ 
	   
	   ?>	
		<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['email']; ?></td>
		<td><?php echo $row['skill']; ?></td>
		<td>
		<a href="update.php?id=<?php echo urlencode($row['id']); ?>">Edit</a> ||
		<a href="delete.php?id=<?php echo urlencode($row['id']); ?>"><span style="color:red">Delete</span></a>
		</td>
		</tr>
	   <?php } ?>	
    <?php } else {?>
	    <p>Data is not available!!</p>
	<?php } ?>

	</table>
	<a href="create.php">Create</a>














<?php include "footer.php"; ?>