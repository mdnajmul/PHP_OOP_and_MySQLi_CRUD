<?php
   
   include "config.php";
   
   class Database{
	   
	   //initialize $host, $user, $pass, $dbname
	   public $host    = DB_HOST;
	   public $user    = DB_USER;
	   public $pass    = DB_PASS;
	   public $dbname  = DB_NAME;
	   
	   public $link;
	   public $error;
	   
	   //Access the "connectDB()" method for create database connection
	   public function __construct(){
		   
		   $this->connectDB();
	   }
	   
	   //This method is for database connection
	   private function connectDB(){
		   
		   $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
		   
		   if(!$this->link){
			   $this->error = "Connection Fail ".$this->link->connect_error;
			   return false;
		   }
	   }
	   
	   //select or read data
	   public function select($query){
		   
		   $result = $this->link->query($query) or die ($this->error.__LINE__);
		   if($result->num_rows > 0){
			   return $result;
		   } else {
			   return false;
		   }
	   }
	   
	   //insert or create data from html form
	   //Here, 'query()', 'header()', 'urlencode()', 'errno', '__LINE__' are build in function
	   public function insert($query){
		   
		   $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
		   
		   if($insert_row){
			   header("Location: index.php?msg=".urlencode('Data inserted successfully.'));
			   exit();
		   } else {
			   
			   die("Error: (".$this->link->errno.")".$this->link->error);
		   }
	   }
	   
	   
	   //update data from html form
	   //Here, 'query()', 'header()', 'urlencode()', 'errno', '__LINE__' are build in function
	   public function update($query){
		   
		   $updated_row = $this->link->query($query) or die ($this->link->error.__LINE__);
		   
		   if($updated_row){
			   header("Location: index.php?msg=".urlencode('Data updated successfully.'));
			   exit();
		   } else {
			   
			   die("Error: (".$this->link->errno.")".$this->link->error);
		   }
	   }
	   
	   
	   //insert or delete data from html form
	   //Here, 'query()', 'header()', 'urlencode()', 'errno', '__LINE__' are build in function
	   public function delete($query){
		   
		   $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
		   
		   if($delete_row){
			   header("Location: index.php?msg=".urlencode('Data deleted successfully.'));
			   exit();
		   } else {
			   
			   die("Error: (".$this->link->errno.")".$this->link->error);
		   }
	   }
	   
   }

?>