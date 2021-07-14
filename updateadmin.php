<?php include("headfoot/header.php"); ?>


	<!-- main content -->
	<div class="main-content">
		<div class="wrapper">
		<p>update employee</p><br>
		

		<?php
		$id=$_GET['id'];
		

		$sql="SELECT *FROM emp WHERE id=$id";

		$res=mysqli_query($conn,$sql);
		if($res==true){

			$count=mysqli_num_rows($res);
			
			if($count==1){
				echo"admin available";
				$row=mysqli_fetch_assoc($res);
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$email=$row['email'];
				$gender=$row['gender'];

			}else{
				header("location:".URL."admin/index.php");
			}
		}



		?>
		
			<form id="update-form" method="POST" enctype="multipart/form-data">
			<table>
			<tr>
				<td><label>First Name:</label></td>
				<td><input type="text" name="first_name" value="<?php echo $first_name; ?>"></td>
			</tr>
			<tr>
				<td><label>Last Name:</label></td>
				<td><input type="text" name="last_name" value="<?php echo $last_name; ?>"></td>
			</tr>
			<tr>
				<td><label>Email:</label></td>
				<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td><label>Gender:</label></td>
				<td> <select  name="gender" value="<?php echo $gender; ?>">
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
					<input id="id" type="hidden" name="id" value="<?php echo $id; ?>">
					<button class="btn-secondary" name="update">update</button>
				</td>
			</tr>



		</table>
		</form>
	</div>
</div>

<?php include("headfoot/footer.php"); ?>
<?php
if(isset($_POST['update'])){
	// echo"button cliker";
$id=$_POST['id'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$gender=$_POST['gender'];

if (isset($_POST['update'])) {
	 
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

if(!empty($filename)){
	$sql="UPDATE emp SET
		first_name='$first_name',
		last_name='$last_name',
		email='$email',
		gender='$gender',
		image='$filename'
		WHERE id=$id";
}else{
	$sql="UPDATE emp SET
	first_name='$first_name',
	last_name='$last_name',
	email='$email',
	gender='$gender'
	WHERE id=$id";
}


$res=mysqli_query($conn,$sql);
if($res==true)
{
	$_SESSION['update']="<div class='sucess'>employee details updated</div>";
	header("location:".URL."admin/index.php");
}else{
	// echo"not";
	$_SESSION['update']="<div class='error'>unable to update</div>";
	header("location:".URL."admin/index.php");
}

}
?>
<script>
	
$(document).ready(function () {
    $('#update-form').validate({ 
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
                    url: "isEmailAvailableOnEditForm.php",
                    type: "post",
                    data: {
                    'email': $('#email').val(),
                    'id': $('#id').val()
                	},
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