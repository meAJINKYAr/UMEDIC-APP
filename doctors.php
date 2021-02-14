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
        $sql="CREATE TABLE doctors(DID INT primary key AUTO_INCREMENT,DoctorName varchar(255), DoctorMail varchar(255),
        DoctorContact varchar(255), DoctorDOB date, DoctorAddress varchar(255), DoctorPic varchar(255), JobType varchar(255),
        JobProof varchar(255), JobAddress varchar(255), DUsername varchar(255), DPassword varchar(255), RegistrationDate TIMESTAMP)";
        if($conn->query($sql)===False){
            echo("Error creating table!!".$conn->connect_error);
        }
        else{
            //echo("Table created successfully!!);
        }
        $dname=$conn->real_escape_string($_REQUEST['dname']);
        $dmail=$conn->real_escape_string($_REQUEST['dmail']);
        $dcontact=$conn->real_escape_string($_REQUEST['dcontact']);
        $ddob=$conn->real_escape_string($_REQUEST['ddob']);
        $daddr=$conn->real_escape_string($_REQUEST['daddr']);
        $dpic=$conn->real_escape_string(basename($_FILES["dpic"]["name"]));
        $job=$conn->real_escape_string($_REQUEST['job']);
        $jp=$conn->real_escape_string(basename($_FILES["jp"]["name"]));
        $jaddr=$conn->real_escape_string($_REQUEST['jaddr']);
        $duname=$conn->real_escape_string($_REQUEST['duname']);
        $dpass=$conn->real_escape_string($_REQUEST['dpass']);

        //echo basename($_FILES["dpic"]["name"])
        //echo basename($_FILES["jp"]["name"])

        $sql="INSERT INTO doctors(DoctorName,DoctorMail,DoctorContact,DoctorDOB,DoctorAddress,DoctorPic,JobType,JobProof,JobAddress,DUsername,DPassword)
        VALUES('$dname','$dmail','$dcontact','$ddob','$daddr','$dpic','$job','$jp','$jaddr','$duname','$dpass')";
        if($conn->query($sql)===False){
            echo("Error inserting data into table!!".$conn->connect_error);
        }
        else{
            echo("Data inserted successfully!!");
            echo"<br><hr>";
            echo("Starting Image Upload.....");

            $target_dir = "doctors_img_uploads/";
            $target_file = $target_dir . basename($_FILES["dpic"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["dpic"]["tmp_name"]);
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
                if (move_uploaded_file($_FILES["dpic"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["dpic"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            echo"<br><hr>";
            echo("Starting File Upload.....");

            $target_dir = "doctors_file_uploads/";
            $target_file = $target_dir . basename($_FILES["jp"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["jp"]["tmp_name"]);
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
                if (move_uploaded_file($_FILES["jp"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["jp"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

        }
        ?>
    <br><br>
        <button><a href="signup.html">BACK</a></button>
        <button><a href="signin.html">SIGN IN</a></button>
    </body>
</html>