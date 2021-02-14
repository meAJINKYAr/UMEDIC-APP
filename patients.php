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
                die("<html><script>window.alert('Cannot connect to the database.$db./n.$conn->connect_error')</script></html>");
            }
            else{
                echo("<html><script>window.alert('Connected to the database. $db .successfully!!')</script></html>");
            }

            //CREATE TABLE FOR STORING CUSTOMER INFORMATION
            $sql="CREATE TABLE patients(PID INT primary key AUTO_INCREMENT, PatientName varchar(255), PatientMail varchar(255),PatientContact varchar(255), PatientDOB DATE, BloodGroup varchar(255),
            PatientAddress varchar(255), HealthConditions varchar(255), PatientPic varchar(255), PUsername varchar(255), PPassword varchar(255), RegistrationDate TIMESTAMP)";
            if($conn->query($sql)===False){
                echo("Error creating table!!".$conn->connect_error);
            }
            else{
                //echo("Table created successfully!!);
            }
            $pname=$conn->real_escape_string($_REQUEST['pname']);
            $pmail=$conn->real_escape_string($_REQUEST['pmail']);
            $pcontact=$conn->real_escape_string($_REQUEST['pcontact']);
            $pdob=$conn->real_escape_string($_REQUEST['pdob']);
            $pbg=$conn->real_escape_string($_REQUEST['pbg']);
            #$pdob="31-10-1998";
            $paddr=$conn->real_escape_string($_REQUEST['paddr']);
            $hc=$conn->real_escape_string($_REQUEST['hc']);
            $ppic=$conn->real_escape_string(basename($_FILES["ppic"]["name"]));
            $puname=$conn->real_escape_string($_REQUEST['puname']);
            $ppass=$conn->real_escape_string($_REQUEST['ppass']);

            $sql="INSERT INTO patients(PatientName,PatientMail,PatientContact,PatientDOB,BloodGroup,PatientAddress,HealthConditions,PatientPic,PUsername,PPassword)
            VALUES('$pname','$pmail','$pcontact','$pdob','$pbg','$paddr','$hc','$ppic','$puname','$ppass')";
            if($conn->query($sql)===False){
                echo("Error inserting data into tabble!!".$conn->connect_error);
            }
            else{
                echo("Data inserted successfully!!");
                echo"<br><hr>";
                echo("Starting Image Upload.....");

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["ppic"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["ppic"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["ppic"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["ppic"]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                
                //echo basename($_FILES["ppic"]["name"]);
            }
        ?>
    <br><br>
        <button><a href="signup.html">BACK</a></button>
        <button><a href="signin.html">SIGN IN</a></button>
    </body>
</html>