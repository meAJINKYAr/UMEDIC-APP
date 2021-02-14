<?php
session_start();
?>
<html>
    <body style="border:1px solid black; margin:50px; padding:20px;width:600px;height:200px;">
        <?php
        $servername="localhost";
        $username="root";
        $password="";
        $db="medical_history";
        $conn=new mysqli($servername,$username,$password,$db);
        if($conn->connect_error){
            die("Error creating connecting to database.$db.!!".$conn->connect_error);
        }
        else{
        // echo("Connected to database.$db.successfully!!");
        }

        //CREATE TABLE FOR STORING CUSTOMER INFORMATION
        $sql="CREATE TABLE customers(CID INT primary key AUTO_INCREMENT,CustomerName varchar(255), CustomerMail varchar(255),CustomerDOB date,CustomerAddress varchar(255),
        BankAccount INT, BankIFSC varchar(255), BankPIN varchar(255), CUsername varchar(255), CPassword varchar(255), RegistrationDate TIMESTAMP)";
        if($conn->query($sql)===False){
            echo("Error creating table!!".$conn->connect_error);
        }
        else{
            //echo("Table created successfully!!);
        }
        $cname=$conn->real_escape_string($_REQUEST['cname']);
        $cmail=$conn->real_escape_string($_REQUEST['cmail']);
        $cdob=$conn->real_escape_string($_REQUEST['cdob']);
        $caddr=$conn->real_escape_string($_REQUEST['caddr']);
        $cbacc=$conn->real_escape_string($_REQUEST['cbacc']);
        $cifsc=$conn->real_escape_string($_REQUEST['cifsc']);
        $cpin=$conn->real_escape_string($_REQUEST['cpin']);
        $cuname=$conn->real_escape_string($_REQUEST['cuname']);
        $cpass=$conn->real_escape_string($_REQUEST['cpass']);

        $sql="INSERT INTO customers(CustomerName,CustomerMail,CustomerDOB,CustomerAddress,BankAccount,BankIFSC,BankPIN,CUsername,CPassword)
        VALUES('$cname','$cmail','$cdob','$caddr','$cbacc','$cifsc','$cpin','$cuname','$cpass')";
        if($conn->query($sql)===False){
            echo("Error inserting data into tabble!!".$conn->connect_error);
        }
        else{
            echo("Data inserted successfully!!");
        }
        ?>
    <br><br>
        <button><a href="signup.html">BACK</a></button>
        <button><a href="signin.html">SIGN IN</a></button>
    </body>
</html>