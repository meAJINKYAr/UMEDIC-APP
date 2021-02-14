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
    <body style="border:1px solid black; margin:50px; padding:20px;width:500px;height:200px;">
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

        $sql="DELETE FROM prescriptions WHERE PRID=".$_REQUEST["del_tpr"];
        if($conn->query($sql)===False){
            echo("Error Deleting Entry!!<br>");
        }
        else{
            echo("Entry deleted successfully!!<br>");
        }
        ?>
        <br><br>
        <button><a href="write_presc.html">BACK</a></button>
    </body>
</html>