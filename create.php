<?php include "header.php"; ?>


<?php

   	spl_autoload_register(function($class_name){
		
		include $class_name.".php";
	});

?>

<?php
   
   //create a object of 'Database' class
   $db = new Database();
   
   //put values inside variables which get's from text field when click 'Submit' button
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
		   
		   //write insert query
		   $query = "insert into tbl_user(name,email,skill) values('$name', '$email', '$skill')";
		   //call 'insert()' method from 'Database' class & put result inside $create variable
           //put message into $create variable which comes from 'insert()' method of 'Database' class
		   $create = $db->insert($query);
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
<form action="create.php" method="post">
	<table>

		<tr>
			<td>Name</td>	
			<td><input type="text" name="name" placeholder="Please enter name"/></td>	
		</tr>
		
		<tr>
			<td>Email</td>	
			<td><input type="text" name="email" placeholder="Please enter email"/></td>	
		</tr>
		
		<tr>
			<td>Skill</td>	
			<td><input type="text" name="skill" placeholder="Please enter skill"/></td>	
		</tr>
		
		<tr>
		<td></td>
		<td>
		<input type="submit" name="submit" value="Submit"/>
		<input type="reset" value="Cancel"/>
		</td>
		</tr>

	</table>
</form>	
	<a href="index.php">Go Back</a>














<?php include "footer.php"; ?>