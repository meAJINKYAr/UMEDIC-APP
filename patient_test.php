<!DOCTYPE html>
<?php

session_start();
$servername="localhost";
$username="root";
$password="";
$db="medical_history";
$conn=new mysqli($servername,$username,$password,$db);
if($conn->connect_error){
    die("<html><script>window.alert('Cannot connect to the database.$db./n.$conn->connect_error')</script></html>");
}
else{
    //echo("<html><script>window.alert('Connected to the database. $db .successfully!!')</script></html>");
}
?>
<html>
    <head>
        <script src="jquery-3.3.1.min.js"></script>
        <style>
            #vp{
                border: 1px solid black;
                min-height: 600px;
                width:30%;
                float:left;
                padding:10px;
                margin-top:10px;
            }
        </style>
    </head>
    <body style="border:1px solid black; margin:50px; padding:20px;width:600px;height:200px;">
        <div>
            <iframe src="test1.html" id="vp" name="vp">
            </iframe>
        <div>

    </body>
</html>