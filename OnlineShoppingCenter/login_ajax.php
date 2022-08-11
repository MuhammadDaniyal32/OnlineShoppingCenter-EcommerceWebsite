<?php
require_once "config.php";

if($_POST['type']==1){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $userrole=$_POST['role'];
        $password=$_POST['pass'];
        
        $duplicate=mysqli_query($con,"select * from user_tbl where Email='$email'");
        if (mysqli_num_rows($duplicate)>0)
        {
            echo json_encode(array("statusCode"=>201));
        }
        else{
            $sql = "INSERT INTO `user_tbl`( `Username`, `Email`, `Password`, `User_role`, `phoneNo`) 
            VALUES ('$name','$email','$password','$userrole', '$phone')";
            if (mysqli_query($con, $sql)) {
                echo json_encode(array("statusCode"=>200));
            } 
            else {
                echo json_encode(array("statusCode"=>203));
            }
        }
        mysqli_close($con);
    }
    
    if($_POST['type']==2){
        session_start();
        $email=$_POST['email'];
        $password=$_POST['password'];
        $cap=$_POST['cap'];
        $check=mysqli_query($con,"select * from user_tbl where Email='$email' and Password='$password'");

        if($_SESSION['captcha']==$cap){
        
        
        if (mysqli_num_rows($check)>0)
        {
            while ($row = mysqli_fetch_assoc($check)) {
                $name=$row['Username'];
                $role=$row['User_role'];
                $User_id=$row['User_id'];
            }
            $_SESSION['Userid']=$User_id;
            $_SESSION['Email']=$email;
            $_SESSION['Role']=$role;
            $_SESSION['Username']=$name;
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201));
        }
    }

    else{
        echo json_encode(array("statusCode"=>202));
    }
        mysqli_close($con);
    }

?>