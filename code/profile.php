<?php include("confige.php"); session_start();?>
<html>
<head>
<link rel="stylesheet" href="profile.css" />
<style>
table,tr,td{
		border:2px solid black;
		border-collapse:collapse;
	}
	
	tr,td{
		padding-left:100px;
		padding-right:100px;
		padding-top:20px;
		padding-bottom:20px;
		text-align:center;
	}
	footer{
		height: 100px;
		margin-top: 5%;
		background-color:rgb(150,150,150);
		border: 1px solid black;
		border-radius: 10px;
		color: white;
	}
	#userimg{
		width:45px;
		height:45px;
		border-radius:30px;
        margin-bottom:40px;
        margin-right:20px;
	}
</style>
</head>
<body style="background-color:#fff5ee">
<ul>
  <li><a class="active" href="profile.php">Profile</a></li>
  <li><a href="Allquestion.php">Gym</a></li>
  <li><a href="leaderboard.php">LeaderBoard</a></li>
  <li><a href="about.php">AboutUs</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
  <li style="float:right;font-size:20px;color:white;margin-top:40px;">
  <?php
  $username = $_SESSION["username"];
  $sql = "select photo from user where username='$username'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $photo = $row["photo"];
  echo "<img src = '$photo' id='userimg' alt='user image' style='float:left;margin-bottom:5px'><div style='margin-top:2px;float:left;padding-left:8px;'> $username</div>";
  ?></a></li>
</ul>
<br>
    <center>
		 <a href='editprofile.php'><button type='button'><b>EDIT PROFILE</b></button></a>
		 


<br>
<?php
    
    
    $username = $_SESSION['username'];
    $sql = "select * from user where username='$username'";
    
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $address = $row['address'];
    $mobile = $row['mobile_number'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $institute = $row['institute_name'];
    $skills = $row['skills'];
    $discipline = $row['discipline'];
    $photo = $row['photo'];
    $name = $firstname . $lastname;
    $uid = $row['uid'];

    $sql1 ="select count(result) from prac_solve where uid ='$uid' and result='correct'";
    $sql2 ="select count(result) from prac_solve where uid ='$uid' and result='wrong'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    
    $correct = $row1['count(result)'];
    $wrong = $row2['count(result)'];
    
    echo"
	
        <div style='width:100%;'>
	<div style='float:left;margin-left:100px;'>
            <img src='$photo' alt='mypic' style='height:200px;width:200px;border:2px solid black;'>		 
		 </div>
         
		 <div style='float:left;margin-left:150px;margin-top:80px;'>
             <h1>$name</h1>
		 </div>
		         </center>
			</div>
            <br><br>
			<div style='margin-top:220px;margin-left:100px;'>
			<table>
			<tr>   <td><b>Institute Name : </b></td>    <td>$institute</td>   </tr>
			<tr>   <td><b>discipline: </b></td>    <td>$discipline</td>   </tr>
			<tr>   <td><b>skills: </b></td>    <td>$skills</td>   </tr>
			<tr>   <td><b>Address: </b></td>    <td>$address</td>   </tr>
			<tr>   <td><b>Mobile No: </b></td>    <td>$mobile</td>   </tr>
			<tr>   <td><b>Correct solution: </b></td>    <td>$correct</td>   </tr>
			<tr>   <td><b>Wrong solution: </b></td>    <td>$wrong</td>   </tr>
			
			</table>
            </div></html>";
?>
<footer><p style="margin-left:25%;">&copy; CODE@IIITDMJ <br> Copyright 2010-2017 Arihant Jain
The only programming contests Web 2.0 platform<br>
Server time: Nov/28/2017 00:55:40UTC+5.5 (c2).
Desktop version</p></footer>

</body>
</html>
</body>
</body>