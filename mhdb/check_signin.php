<?php
$servername="localhost";
$username="root";
$password="";
$db="medical_history";

$conn=new mysqli($servername, $username, $password, $db);

if($conn->connect_error){
    die("Error connecting to database".$db."!!".$conn->connect_error);
}
else{
    $un=$_POST['signin_name'];
    $ps=$_POST['signin_pass'];

    $sql="SELECT * FROM users";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($un==$row['UserName']){
                if($ps==$row['UserPass']){
                    session_start();
                    $_SESSION['UID']=$row["UID"];
                    $_SESSION['UserName']=$row['UserName'];
                    echo"<script>window.location.assign('home.php')</script>";
                }
                else{
                    echo "Wrong 2!!";
                }
            }
            else{
                echo "Wrong 1!!";
            }
        }

        echo "<script>alert('Wrong!!Pls Try Again.')</script>";
        echo "<script>window.location.assign('signin.html')</script>";
    }
    else{
        echo "No data found!!<br>";
        echo "Please first signup and then login!!<br>";
        echo "<button><a href=signup.html>SIGNUP</a></button>";
    }
}
?>