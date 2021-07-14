<?php include("headfoot/header.php"); ?>


	<!-- main content -->
	<div class="main-content">
		<div class="wrapper">
		<p>Employee Listing</p><br>
		<?php

			if(isset($_SESSION['add'])){
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			if(isset($_SESSION['delete'])){
				 	echo $_SESSION['delete'];
				 	unset($_SESSION['delete']);
				 } 
				 if(isset($_SESSION['update'])){
				 	echo $_SESSION['update'];
				 	unset($_SESSION['update']);
				 } 



		 ?>
		 
		<button class="btn-primary"><a href="addadmin.php">Add Employee</a></button>
		<table class="tbl-full" >
			<tr>
			<th>srno</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>image</th>
			<th>Actions</th>
		</tr>
		<?php 
		$sql="SELECT * FROM emp";

		 $res=mysqli_query($conn,$sql);
		if($res==true){
			 $count=mysqli_num_rows($res);
			if($count>0)
				$srno=1;
					
				
			{
				while($rows=mysqli_fetch_assoc($res)){
					$id=$rows['id'];
					$first_name=$rows['first_name'];
					$last_name=$rows['last_name'];
					$email=$rows['email'];
					$gender=$rows['gender'];
					$image=$rows['image'];



					?>
					<tr>
						<td><?php echo $srno++; ?></td>
						<td><?php echo$first_name; ?></td>
						<td><?php echo$last_name; ?></td>
						<td><?php echo$email; ?></td>
						<td><?php echo$gender; ?></td>
						<td><?php echo$image; ?></td>

			<td><button class="btn-secondary" name="update"><a href="<?php echo URL;?>admin/updateadmin.php?id=<?php echo $id;?>">Edit</a></button></td>
			<td><button class="btn-delete" name="delete"><a href="<?php echo URL;?>admin/deleteadmin.php?id=<?php echo $id;?>">Delete</a></button></td>
			
		</tr>


					<?php
				}

			}

		}


		?>
		

		</table>

		</div>
		
	</div>



	
		<!-- footer section -->
	
<?php include('headfoot/footer.php'); ?>