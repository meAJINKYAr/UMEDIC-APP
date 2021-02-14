<!DOCTYPE html>
<html>
    <head>
        <style>
            tr,td,th,table{
                border:1px solid brown;
                border-collapse:collapse;
                padding:10px;
                text-align:left;
            }
        </style>
    </head>
    <body>
        <br>
        <a href="vp1.html"><button>Back</button></a>
        <hr>
        <br>
    <body>
</html>
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

    echo("<html><script>window.alert('Fetching Data....')</script></html>");
    $sql="SELECT * FROM patients WHERE PID=".$_REQUEST['vpid'];
    $result=$conn->query($sql);
    if($result->num_rows>0){
        //echo "<table><tr><th>PID</th></tr><tr><th>Patient Name</th></tr><tr><th>Patient Pic</th></tr>";
        while ($row=$result->fetch_assoc()){
            echo "<table id='d1'style='min-height:250px;min-width:300px;' align='center'><tr><p align='center'><img src='patients_img_uploads/".$row['PatientPic']."' alt='profile pic' style='height:100px;width:100px;border:1px solid red;padding:10px;border-style:round;'></p></tr>
            <tr><th>PID: </th><td>".$row["PID"]."</td></tr><tr><th>Name: </th><td>".$row["PatientName"]."</td></tr><tr><th>Email ID: </th><td>".$row["PatientMail"]."</td></tr>
            <tr><th>Contact Number: </th><td>".$row["PatientContact"]."</td></tr><tr><th>DOB: </th><td>".$row["PatientDOB"]."</td></tr>
            <tr><th>Address: </th><td>".$row["PatientAddress"]."</td></tr><tr><th>Registered On: </th><td>".$row["RegistrationDate"]."</td></tr></table>";
            echo"<br><hr><h3 align='center'>Health Stats</h3><hr><table id='d2' style='min-height:100px;min-width:300px;' align='center'><tr><th>Blood Group: </th><td>".$row["BloodGroup"]."</td></tr><tr><th>Health Conditions: </th><td>".$row["HealthConditions"]."</td></tr></table>";
        }
        
    }
    else{
        echo("<html><script>window.alert('Unable to Fetch Data....')</script></html>");
        //echo("<html><a href='test1.html'><button>Back</button></a></html>");
    }
?>