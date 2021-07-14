<?php 

 include('../config/conn.php');
$id=$_GET['id'];

$sql="DELETE FROM emp WHERE id=$id";

$res=mysqli_query($conn,$sql);

if($res==true){

			$_SESSION["delete"]="<div class='sucess'>Admin deleted succesfully</div";
		  	 header("location:".URL.'admin/index.php');

			}else{
				//echo"failed to delete admin";
				$_SESSION["deleted"]=" <div class='error'>failed to  deleted admin</div>";
				header("location:".URL."admin/deleteadmin.php");
}






?>