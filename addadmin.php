<?php include("headfoot/header.php"); ?>


	
	<div class="main-content">
		<div class="wrapper">
		<p>Add employee</p><br>
		<?php 
		if(isset($_SESSION['add'])){
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}

		 ?>
		<form id="register-form" action="" method="POST" name='register-form' enctype="multipart/form-data">

			<table>
			<tr>
				<td><label>First Name:</label></td>
				<td><input type="text" name="first_name" placeholder="enter your first name"></td>
			</tr>
			<tr>
				<td><label>Last Name:</label></td>
				<td><input type="text" name="last_name" placeholder="enter your last name"></td>
			</tr>
			<tr>
				<td><label>Email:</label></td>
				<td><input type="text" id="email" name="email" placeholder="enter your email"></td>
			</tr>
			<tr>
				<td><label>Gender:</label></td>
				<td> <select  name="gender">
   					<option value="m">male</option>
    				<option value="f">female</option>
   
 					 </select>
				</td>
			</tr>
			<tr>
				<td><label>Select image to upload:</label></td>
				<td>
					<input type="file" name="image" id="image">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="btn-secondary" name="submit">Submit</button>
				</td>
			</tr>



		</table>
			
		</form>
	</div>
</div>
<?php include('headfoot/footer.php'); ?>

<?php


if(isset($_POST['submit'])){
	// echo"button";
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];


	 if (isset($_POST['submit'])) {
	 
	    $filename = $_FILES["image"]["name"];
	    $tempname = $_FILES["image"]["tmp_name"];   
	    $folder = "uploads/".$filename;    
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

	  }


	$sql="INSERT INTO emp SET
	first_name='$first_name',
	last_name='$last_name',
	email='$email',
	gender='$gender',
	image= '$filename'";


 $res=mysqli_query($conn,$sql) or die(mysqli_error());

if($res==true){
	// echo"data inserted";
	$_SESSION['add']="<div class='sucess'>new employee details added sucessfully</div>";
	header("location:".URL."admin/index.php");
}else{
	$_SESSION['add']="<div class='error'>failed to add employee!!</div>";
	header("location:".URL."admin/addadmin.php");
// 	echo"failed";
 }
	



}


 ?>


<script>
	
$(document).ready(function () {
    $('#register-form').validate({ 
    errorLabelContainer: "#cs-error-note",
    wrapper: "li",
    rules: {
    	first_name: "required", 
		last_name: "required",//firstname is corresponding input name   
		password: {
			        required: true,
			       
			      },
        email: {
            required: true,
            email: true,
                remote: {
                    url: "isEmailAvailable.php",
                    type: "post"
                 }
        }
    },
    messages: {
        email: {
        	first_name: "Enter First Name",
			last_name: "Enter Last Name",
			password: "Enter Passowrd",
            required: "Please enter your email address.",
            email: "Please enter a valid email address.",
            remote: "Email already in use!"
        }
    },
    submitHandler: function(form) {
                        form.submit();
                     }
    });
});
</script>