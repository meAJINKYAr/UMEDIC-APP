<?php
session_start();
?>
<html>
    <head>
        <style>
            tr,td,th,table{
                border-bottom:1px solid black;
                border-collapse:collapse;
                padding:10px;
                border-spacing:5px;
            }
            th{
                background-color:cornflowerblue;
            }
            tr:hover {
                background-color:cornsilk;
            }
        </style>
    </head>
    <body style="padding:20px;" align="center">
        <?php
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
            //echo("Connected to the database. $db .successfully!!<br>");
        }
        ?>
        
        <button><a href="view_logs_doctor.php">REFRESH</a></button>
        <br><hr><br>
        <?php
        $sql="SELECT * FROM prescriptions WHERE DID=".$_SESSION['DID'];
        $result=$conn->query($sql);
        if($result->num_rows>0){
            while ($row=$result->fetch_assoc()){
                echo "<table id='d1'style='min-width:1000px;' align='center'>
                <tr><th>PRSC_ID: </th><th>Patient ID: </th><th>Diagnosis </th><th>Medicines: </th><th>Notes: </th><th>Fees Paid: </th><th>Start Date: </th><th>End Date: </th><th>Registered On: </th></tr>
                <tr><td>".$row["PRID"]."</td><td>".$row["PID"]."</td><td>".$row["Diagnosis"]."</td><td>".$row["Medicines"]."</td><td>".$row["DoctorNotes"]."</td><td>".$row["Fees"]."</td><td>".$row["StartDate"]."</td><td>".$row["EndDate"]."</td><td>".$row["RegistrationDate"]."</td></tr></table>";
            }
            
        }
        else{
            echo "No data found!!";
        }
        
        ?>
        <br>
    </body>
</html>