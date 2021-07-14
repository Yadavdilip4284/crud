<?php include('../config/conn.php'); 

if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $sql="SELECT * FROM emp WHERE email = '$email'";
        $res=mysqli_query($conn,$sql);
        if($res==true){
	        $count=mysqli_num_rows($res);
			if($count>0){
				echo "false";
			}else{
				echo "true";
			}
        }

    }






















?>