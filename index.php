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
    #echo("<html><script>window.alert('Connected to database $db');</script></html>");
}

?>

<html>
    <head>
        <script src="jquery-3.3.1.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
            box-sizing: border-box;
            }
            #title{
                position:fixed;
                width:100%;
                top:0;
            }
            #heading{
             color:white;   
             border:2px solid black;
             background-color:darkblue;
             width:100%;
             
            }

            #navbar{
                border:1px solid black;
                width:100%;
            }

            #home{
                border:1px solid lightgreen;
                padding:10px;
                padding-top:150px;
            }

            #profile{
                border: 2px solid red;
                min-height: 600px;
                width:30%;
                float:left;
                padding:10px;
                margin-top:10px;
            }

            #main{
                width:70%;
                float:left;
                padding:10px;
            }

            /* Clear floats after the columns */
            #home:after {
            content: "";
            display: table;
            clear: both;
            }

            #current{
                border: 2px solid blue;
                min-height: 250px;
                padding:10px;
            }

            #log{
                border: 2px solid green;
                min-height: 250px;
                padding:15px;
            }
            
            ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            }

            li {
            float: left;
            }

            li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

            li a:hover:not(.active) {
            background-color: #111;
            }

            .active {
            background-color: #4CAF50;
            }

            /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
            @media (max-width: 600px) {
            nav, article {
                width: 100%;
                height: auto;
            }
            }

            #about{
                background-color:grey;
                border:1px solid lightblue;
                margin-top:50px;
                bottom:0;
            }

            tr,td,th,table{
                border:1px solid brown;
                border-collapse:collapse;
                padding:10px;
                text-align:left;
            }

            .d1,.d2{
                text-align:left;
                border-spacing:10px; 
            }
        </style>
    </head>

    <body>
        <div name="title" id="title">
            <div name="heading" id="heading">
                <h1 align="center" style="word-spacing:30px;"><a href="index.php" style="text-decoration:none;color:white;"><img src="medical.png" alt="medical sign" style="height:30px; width:30px;padding:0px;" > UMEDIC APP</a></h1>
            </div>

            <div name="navbar" id="navbar">
                <ul>
                    <li><a class="active" href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li onclick="window.alert('Logging Out...')"><a href="logout.php">LOG OUT</a></li>
                </ul>
            </div>
        </div>

        

        <div name="home" id="home">
            <div name="profile" id="profile">
                <div name="prof1" id="prof1">
                    <h3 align="center">PROFILE</h3>
                    <hr>
                    

                    <?php
                    //echo '<p align="center"><img src="user_image.png" style="height:100px;width:100px;border:1px;padding:10px;"></p>'
                    //echo "<hr><img src='uploads/my photo.jpg'>";
                    $sql="SELECT * FROM patients WHERE PID=".$_SESSION['PID'];
                    $result=$conn->query($sql);
                    if($result->num_rows>0){
                        //echo "<table><tr><th>PID</th></tr><tr><th>Patient Name</th></tr><tr><th>Patient Pic</th></tr>";
                        while ($row=$result->fetch_assoc()){
                            echo "<table class='d1'style='min-height:250px;min-width:300px;' align='center'><tr><p align='center'><img src='patients_img_uploads/".$row['PatientPic']."' alt='profile pic' style='height:100px;width:100px;border:1px solid red;padding:10px;border-style:round;'></p></tr>
                            <tr><th>PID: </th><td>".$row["PID"]."</td></tr><tr><th>Name: </th><td>".$row["PatientName"]."</td></tr><tr><th>Email ID: </th><td>".$row["PatientMail"]."</td></tr>
                            <tr><th>Contact Number: </th><td>".$row["PatientContact"]."</td></tr><tr><th>DOB: </th><td>".$row["PatientDOB"]."</td></tr>
                            <tr><th>Address: </th><td>".$row["PatientAddress"]."</td></tr><tr><th>Registered On: </th><td>".$row["RegistrationDate"]."</td></tr></table>";
                            echo"<br><hr><h3 align='center'>Health Stats</h3><hr><table class='d2' style='min-height:100px;min-width:300px;' align='center'><tr><th>Blood Group: </th><td>".$row["BloodGroup"]."</td></tr><tr><th>Health Conditions: </th><td>".$row["HealthConditions"]."</td></tr></table>";
                        }
                        
                    }
                    else{
                        echo "No data found!!";
                    }
                    ?>
                </div>

            </div>
            
            <div name="main" id="main">
                <div name="current" id="current">
                    <h3 align="center">CURRENT PRESCRIPTION</h3>
                    <hr>
                    <?php
                        $sql="SELECT * FROM prescriptions WHERE PID=".$_SESSION['PID'];
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while ($row=$result->fetch_assoc()){
                                global $nw,$did;
                                $nw=(date('Y-m-d'));
                                $did=$row["DID"];
                                
                                /*
                                $ed=($row["EndDate"]);
                                echo $ed;
                                echo "<hr>";
                                echo $nw;
                                */
                            }
                            $sql1="SELECT * FROM prescriptions WHERE EndDate >'$nw' AND PID=".$_SESSION['PID'];
                            $sql2="SELECT * FROM doctors WHERE DID=".$did;
                           
                            $result1=$conn->query($sql1);
                            $result2=$conn->query($sql2);
                            if($result1->num_rows>0){
                                if($result2->num_rows>0){
                                    while ($row1=$result1->fetch_assoc() and $row2=$result2->fetch_assoc()){
                                        echo "<table class='d1'style='min-height:600px;min-width:500px;' align='center'>
                                        <tr><th>PRSC_ID: </th><td>".$row1["PRID"]."</td></tr><tr><th>Doctor Name: </th><td>".$row2["DoctorName"]."<tr><th>Doctor Contact Info: </th><td>".$row2["DoctorMail"]."<br><br>".$row2["DoctorContact"]."</tr>
                                        <tr><th>Diagnosis </th><td>".$row1["Diagnosis"]."</td></tr><tr><th>Medicines: </th><td>".$row1["Medicines"]."</td></tr>
                                        <tr><th>Notes: </th><td>".$row1["DoctorNotes"]."</td></tr><tr><th>Fees Paid: </th><td>".$row1["Fees"]."</td></tr><tr><th>Start Date: </th><td>".$row1["StartDate"]."</td></tr>
                                        <tr><th>End Date: </th><td>".$row1["EndDate"]."</td></tr><tr><th>Registered On: </th><td>".$row1["RegistrationDate"]."</td></tr></table>";
                                        
                                    }
                                }
                                
                                else{
                                    echo "No data for result 2!!";
                                }
                            }
                            else{
                                echo "No data for result 1!!";
                            }
                            
                        }
                        else{
                            echo "No data found at all!!";
                        }
                    ?>
                </div>
                <br>

                <div name="log" id="log">
                    <h3 align="center">MEDICAL HISTORY LOG</h3>
                    <hr>
                    <iframe src="view_logs_patient.php" style="width:100%; min-height:400px;border:2px solid black;"></iframe>
                    <br><br>
                </div>
            </div>
        </div>
        <br>

        <div name="about" id="about">
            <h3 align="center">UMEDIC Pvt. Ltd.</h3>
        </div>
        <br>

        
        <script>
            $(document).ready(function(){

                $("#bt").click(function(){
                    $("#ps").toggle();
                })

            })
        </script>

    </body>
</html>