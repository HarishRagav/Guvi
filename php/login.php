<?php
include('../assets/db_connect.php');
if(isset(($_POST["password"]),($_POST["email"]))){
    $password=mysqli_real_escape_string($conn, $_POST["password"]);
    $email=mysqli_real_escape_string($conn, $_POST["email"]);
    if($password=="")
    {
        echo "please enter the password";
    }
    else
    {
        $sql="select * from users where Email='".$email."' && Password='".$password."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            echo "Success";
            $_SESSION['email']=$email;
            }
        else
        {
            echo '<span class="text-danger">Password is incorrect</span>';
        }
    }
}
else if(isset(($_POST["email"])))
{
  $email=mysqli_real_escape_string($conn, $_POST["email"]);
  if($email==" ")
  {
    echo '<span class="text-danger">please enter mailid</span>';
  }
  else
  {
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
      echo '<span class="text-danger">Enter valid emailid</span>';
    }
    else
    {
      $sql="select * from users where Email='".$email."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==1){
          echo 'Success';
        }
      else{ echo 'Incorrect/Not registered';
      }
    }
  }
}


