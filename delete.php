<?php include "header.php"; ?>


<?php

   	spl_autoload_register(function($class_name){
		
		include $class_name.".php";
	});

?>

<?php
   $id = $_GET['id'];
   
   //create a object of 'Database' class
   $db = new Database();
    //write select query
   $query = "select * from tbl_user where id=$id";
   //call 'select()' method from 'Database' class & put result inside $getData variable
   $getData = $db->select($query)->fetch_assoc();
   
   //put values inside variables which get's from text field when click 'Delete' button
   //Here, 'mysqli_real_escape_string(var_1,var_2)' is build in function
   // It is used for remove special character from text feild   
   if(isset($_POST['submit'])){
	   $name = mysqli_real_escape_string($db->link, $_POST['name']);
	   $email = mysqli_real_escape_string($db->link, $_POST['email']);
	   $skill = mysqli_real_escape_string($db->link, $_POST['skill']);
	   
	   //check variables feild are empty or not
	   if($name == '' || $email == '' || $skill == ''){
		   $error = "Feild must not be empty!";
	   
	   } else {
		   
		   //write update query
		   $query = "delete from tbl_user where id=$id";
		   //call 'update()' method from 'Database' class & put result inside $create variable
		   $deleteData = $db->delete($query);
	   }
	   
   }

?>

<?php
   //show error message top of the form
   if(isset($error)){
	   
	   echo "<span style='color:red'>".$error."</span>";
   }

?>

<!-- create a form for give input -->
<form action="delete.php?id=<?php echo $id;?>" method="post">
	<table>

		<tr>
			<td>Name</td>	
			<td><input type="text" name="name" value="<?php echo $getData['name']?>"/></td>	
		</tr>
		
		<tr>
			<td>Email</td>	
			<td><input type="text" name="email" value="<?php echo $getData['email']?>"/></td>	
		</tr>
		
		<tr>
			<td>Skill</td>	
			<td><input type="text" name="skill" value="<?php echo $getData['skill']?>"/></td>	
		</tr>
		
		<tr>
		<td></td>
		<td>
		<input type="submit" name="submit" value="Delete"/>
		<input type="reset" value="Cancel"/>
		</td>
		</tr>

	</table>
</form>	
	<a href="index.php">Go Back</a>














<?php include "footer.php"; ?>