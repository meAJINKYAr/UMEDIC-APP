<?php
$servername="localhost";
$username="root";
$password="";
$db="medical_history";

$conn=new mysqli($servername, $username, $password, $db);

if($conn->connect_error){
    die("<html><script>window.alert('Cannot connect to the database.$db./n.$conn->connect_error')</script></html>");
}
else{
    $un=$_POST['puname'];
    $ps=$_POST['ppass'];

    $sql="SELECT * FROM patients";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($un==$row['PUsername']){
                if($ps==$row['PPassword']){
                    session_start();
                    $_SESSION['PID']=$row["PID"];
                    $_SESSION['PUsername']=$row['PUsername'];
                    echo"<script>window.location.assign('index.php')</script>";
                }
                else{
                    echo "<script>confirm('Wrong password!!!!')</script>";
                    echo "<script>alert('Wrong!!Pls Try Again.')</script>";
                }
            }
            else{
                echo "<script>confirm('Wrong username!!')</script>";
                echo "<script>alert('Wrong!!Pls Try Again.')</script>";
            }
        }
        echo "<script>window.location.assign('signin.html')</script>";
    }
    else{
        echo "No data found!!<br>";
        echo "Please first signup and then login!!<br>";
        echo "<button><a href=signup.html>SIGNUP</a></button>";
    }
}
?>