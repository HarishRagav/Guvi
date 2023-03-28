<?php
// include('../assets/db_connect.php');
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "Registration";


$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if($conn -> connect_error){ 
   die("Connection failed:".$conn->connect_error);
}

if (isset(($_POST["username"]),($_POST["email"]),($_POST["phone"]),($_POST["password"]))) {
    $name=$_POST["username"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $password=$_POST["password"];
}

// name 
if(isset($_POST["username"])) {
    $username=mysqli_real_escape_string($conn, $_POST["username"]);
    if($username==" ") {
        echo '<span class="text-danger">please enter username</span>';
    } else {
        if (strlen($username)<5 || strlen($username)>25) {
            echo '<span class="text-danger"> Username should be between 5 and 25 characters</span>';
        } else {
            $sql="select * from userdata where name='".$username."'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1) {
                echo '<span class="text-danger">Username already exist</span> ';
            } else { 
                echo '<span class="text-success">Accepted</span>';
            }
        }
    }
}

// mail 
if(isset($_POST["email"])) {
    $email=mysqli_real_escape_string($conn, $_POST["email"]);
    if($email==" ") {
        echo '<span class="text-danger">please enter mailid</span>';
    } else {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            echo '<span class="text-danger">Enter valid emailid</span>';
        } else {
            $sql="select * from userdata where email='".$email."'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1) {
                echo '<span class="text-danger">email already registered</span>';
            } else { 
                echo '<span class="text-success">Not registered</span>';
            }
        }
    }
}

// Phone number validation
if(isset($_POST["phone"])) {
    $phone=mysqli_real_escape_string($conn, $_POST["phone"]);
    if(!preg_match('/^[0-9]{10}+$/', $phone)) {
        echo '<span class="text-danger">Enter valid phone number</span>';
    } else if(isset($_POST["password"])) {
        $password=mysqli_real_escape_string($conn, $_POST["password"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            echo '<span class="text-danger"> Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</span>';
        } else{
            echo '<span class="text-success">Strong password</span>';
        }
    }}
    // Prepare statement for checking if the email is already registered or not
    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM userdata WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $count = mysqli_stmt_get_result($stmt)->fetch_row()[0];

    if ($count > 0) {
     
        echo "Email is already registered.";
    } else {
        // Email not registered, proceed for registration

        // Prepare statement for inserting data into database
        $stmt = mysqli_prepare($conn, "INSERT INTO userdata (Name, Email, Phone, Password) VALUES (?, ?, ?, ?)");

        // Bind parameters to statement
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $password);

        // Executing statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page
            echo "<script>alert('Registered Successfully');</script>";
            echo "<script>window.location.href='login.html';</script>";     
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close connection
    mysqli_close($conn);

?>