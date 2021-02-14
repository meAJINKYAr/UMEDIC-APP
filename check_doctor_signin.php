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
    $un=$_POST['duname'];
    $ps=$_POST['dpass'];

    $sql="SELECT * FROM doctors";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($un==$row['DUsername']){
                if($ps==$row['DPassword']){
                    session_start();
                    $_SESSION['DID']=$row["DID"];
                    $_SESSION['DUsername']=$row['DUsername'];
                    echo"<script>window.location.assign('home.php')</script>";
                    //echo "<script>confirm('Doctor Log In Success!!')</script>";
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