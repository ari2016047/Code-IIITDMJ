<?php
    include("confige.php");
    session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_SESSION['username'];
        if(empty(basename($_FILES["photo"]["name"])) == false){
        $target_dir = "";
        $filename = $username . basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        //$update = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "File already exists.";
            //$uploadOk = 1;
            //$update = 1;
            $path = $_SERVER['DOCUMENT_ROOT']. $filename;
            unlink($path);
        }
        // Check file size
        if ($_FILES["photo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $sql1 = "update user set photo = '$filename' where username = '$username'";
        $result = mysqli_query($conn,$sql1);
        
        }
            
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
        $institute = mysqli_real_escape_string($conn,$_POST['institute']);
        $skills = mysqli_real_escape_string($conn,$_POST['skills']);
        $discipline = mysqli_real_escape_string($conn,$_POST['discipline']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
        
        $sql = "update user  set address = '$address',
        skills =  '$skills',
        institute_name = '$institute',
        discipline = '$discipline',
        firstname = '$firstname',
        lastname = '$lastname',
        mobile_number = $mobile
        where username = '$username'";
        
        $result = mysqli_query($conn,$sql);
        
        if($result === true){
            header("location: profile.php");
        }
        else{
            echo "error : " . $sql . $conn->error;
        }
    }
?>
<html>
<head>
<link rel="stylesheet" href="profile.css" />
</head>
<body>
<ul>
  <li><a class="active" href="profile.php">Profile</a></li>
  <li><a href="Allquestion.php">Gym</a></li>
  <li><a href="leaderboard.php">LeaderBoard</a></li>
  <li><a href="about.php">AboutUs</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
  <li style="float:right;font-size:20px;color:white;margin-top:40px;"><?php echo $_SESSION["username"]?></a></li>
</ul>
  <br><br>
<form action="" method="post" enctype="multipart/form-data">
<table class="p">
<tr>
<td>
  Profile Photo:
</td>
<td>
  <input type="file" name = "photo" value="Browse" style= "width:200px;height:30px">
  </td>
</tr>
<tr>
<td>
  First Name:
</td>
<td>
  <input type="text" name="firstname" style="height:30px;width:200px">
</td>
<td>
  Last Name:
</td>
<td>
  <input type="text" name="lastname" style="height:30px;width:200px"><br/>
  </td>
<td>
</tr>
<tr>
<td>
Mobile Number:
</td>
<td>
  <input type="digits" name="mobile" style="height:30px;width:200px"><br/>
</td>
</tr>
<tr>
<td>
  Institution Name:
</td>
<td>
  <input type="text" name="institute" style= "width:300px;height:30px" ><br/>
</td>
</tr>
<tr>
<td>
  Discipline:
</td>
<td>
  <input type="text" name="discipline" style= "width:300px;height:30px" ><br/>
</td>
</tr>
<tr>
<td>
  Skills:
</td>
<td>
  <input type="text" name="skills" style= "width:300px;height:30px" ><br/>
  </td>
  </tr>
  <tr>
<td>
  Address:
</td>
<td>
  <textarea rows="4" cols="35" name="address"></textarea><br/>
  </td>
<td></tr>
</table>
<br><br>
<center>
<input type="submit" name="submit" value="Submit" style="padding-left:20px;padding-right:20px;font-size:25px;text-align:center;">
</center>
</form>
</body>
</html>
