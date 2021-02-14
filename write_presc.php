<?php
session_start();
?>
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
    <body style="border:1px solid black; margin:50px; padding:20px;width:500px;height:700px;">
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

        //CREATE TABLE FOR STORING CUSTOMER INFORMATION
        $sql="CREATE TABLE prescriptions(PRID INT primary key AUTO_INCREMENT, DID INT, PID INT, PatientName varchar(255), Diagnosis varchar(1000),
        Medicines varchar(1000), DoctorNotes varchar(1000), Fees varchar(255), StartDate DATE, EndDate DATE, RegistrationDate TIMESTAMP)";
        if($conn->query($sql)===False){
            echo("Error creating table!!".$conn->connect_error."<br>");
        }
        else{
           // echo("Table created successfully!!<br>");
        }
        $did=$conn->real_escape_string($_SESSION['DID']);
        $prpid=$conn->real_escape_string($_REQUEST['prpid']);
        $prpname=$conn->real_escape_string($_REQUEST['prpname']);
        $prdia=$conn->real_escape_string($_REQUEST['prdia']);
        $prmedi=$conn->real_escape_string($_REQUEST['prmedi']);
        $prnotes=$conn->real_escape_string($_REQUEST['prnotes']);
        $prbill=$conn->real_escape_string($_REQUEST['prbill']);
        $prstart=$conn->real_escape_string($_REQUEST['prstart']);
        $prend=$conn->real_escape_string($_REQUEST['prend']);
        

        $sql="INSERT INTO prescriptions(DID, PID, PatientName, Diagnosis, Medicines, DoctorNotes, Fees, StartDate, EndDate)
        VALUES('$did','$prpid','$prpname','$prdia','$prmedi','$prnotes','$prbill','$prstart','$prend')";
        if($conn->query($sql)===False){
            echo("Error inserting data into table!!".$conn->connect_error."<br>");
        }
        else{
            echo("Data inserted successfully!!<br>");

            $sql="SELECT * FROM prescriptions WHERE PID=".$_SESSION['PID'];
            $result=$conn->query($sql);
            if($result->num_rows>0){
                while ($row=$result->fetch_assoc()){
                    echo "<table id='d1'style='min-height:600px;min-width:500px;' align='center'>
                    <tr><th>PRSC_ID: </th><td>".$row["PRID"]."</td></tr><tr><th>PatientID: </th><td>".$row["PID"]."</td></tr><tr><th>Patient Name: </th><td>".$row["PatientName"]."</td></tr>
                    <tr><th>Diagnosis </th><td>".$row["Diagnosis"]."</td></tr><tr><th>Medicines: </th><td>".$row["Medicines"]."</td></tr>
                    <tr><th>Notes: </th><td>".$row["DoctorNotes"]."</td></tr><tr><th>Fees Paid: </th><td>".$row["Fees"]."</td></tr><tr><th>Start Date: </th><td>".$row["StartDate"]."</td></tr>
                    <tr><th>End Date: </th><td>".$row["EndDate"]."</td></tr><tr><th>Registered On: </th><td>".$row["RegistrationDate"]."</td></tr></table>";
                }
                
            }
            else{
                echo "No data found!!";
            }
        }
        ?>
    <br><br>
        <button><a href="write_presc.html">BACK</a></button>
        <br><hr><br>
        <form action="del_this_presc.php" method="POST"><input type="number"2 id="del_tpr" name="del_tpr" ><button type="submit">DELETE THIS</button></form>
    </body>
</html>