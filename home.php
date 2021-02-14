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
                min-height: 800px;
                width:40%;
                float:left;
                padding:15px;
                margin-top:10px;
            }

             
            #fetch_pd{
                min-height: 800px;
            }

            #vp{
                border: 2px solid black;
                min-height: 800px;
                width:100%;
            }

            #main{
                width:60%;
                float:left;
                padding:10px;
                min-height:800px;
            }

            /* Clear floats after the columns */
            #home:after {
            content: "";
            display: table;
            clear: both;
            }

            #current{
                border: 2px solid blue;
                min-height:800px;
                padding:15px;
            }

            #log{
                border: 2px solid green;
                min-height: 250px;
                padding:10px;
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

            #d1,#d2{
                text-align:left;
                border-spacing:10px; 
                width:400px;
            }

            #pre_form{
                padding:10px;
                min-height:100px;
            }

            #wpresc{
                min-height:1000px;
                width:100%;
                border:2px solid black;
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
                    <li  name="proshow" id="proshow"><a >PROFILE</a></li>
                </ul>
            </div>
        </div>

        

        <div name="home" id="home">
            <h3 align="center">Hi, Dr. <b><?php echo $_SESSION["DUsername"];?></b></h3>
            
            <div name="profile" id="profile">

                <div name="fetch_pd" id="fetch_pd">
                    <h3 align="center">Fetch Patient Deatils</h3>
                    <hr>
                    <iframe src="vp1.html" id="vp" name="vp"></iframe>
                </div>
                <br><hr>
                <div name="prof1" id="prof1" hidden>
                    <h3 align="center">YOUR PROFILE</h3>
                    
                    <hr>
                    <?php
                    $sql="SELECT * FROM doctors WHERE DID=".$_SESSION['DID'];
                    $result=$conn->query($sql);
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<table id='d1'style='min-height:250px;min-width:300px;' align='center'><tr><p align='center'><img src='doctors_img_uploads/".$row['DoctorPic']."' alt='profile pic' style='height:100px;width:100px;border:1px solid red;padding:10px;border-style:round;'></p></tr>
                            <tr><th>PID: </th><td>".$row["DID"]."</td></tr><tr><th>Name: </th><td>".$row["DoctorName"]."</td></tr><tr><th>Email ID: </th><td>".$row["DoctorMail"]."</td></tr>
                            <tr><th>Contact Number: </th><td>".$row["DoctorContact"]."</td></tr><tr><th>DOB: </th><td>".$row["DoctorDOB"]."</td></tr>
                            <tr><th>Address: </th><td>".$row["DoctorAddress"]."</td></tr><tr><th>Registered On: </th><td>".$row["RegistrationDate"]."</td></tr></table>";
                            echo"<br><hr><h3 align='center'>Professional Details: </h3><hr><table id='d2' style='min-height:100px;min-width:300px;' align='center'><tr><th>Specialization/s: </th><td>".$row["JobType"]."</td></tr><tr><th>Practice Location: </th><td>".$row["JobAddress"]."</td></tr></table>";
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
                    <h3 align="center">WRITE A PRESCRIPTION</h3>
                    <hr>
                    <div name="presc" id="presc" align="center">
                        <iframe src="write_presc.html" alt="write prescription" name="wpresc" id="wpresc"></iframe>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div name="log" id="log">
                    <h3 align="center">PATIENTS CHECKUP HISTORY LOG</h3>
                    <hr>
                    <iframe src="view_logs_doctor.php" style="width:100%; min-height:200px;border:2px solid black;"></iframe>
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

                $("#proshow").click(function(){
                    $("#prof1").toggle("fast");
                    $("#fetch_pd").toggle("fast");
                    
                })

            })
        </script>

    </body>
</html>