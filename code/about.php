<?php include("confige.php"); session_start();?>
<html lang="en">
<head>
<link rel="stylesheet" href="profile.css" />
<style>
	html {
background: url(aboutus.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	}

	.img1{
		width: 200px;
		height: 200px;
		border-radius: 100px;
		float:left;
		margin-left:14%;
		margin-top: 3%;
	}
	p{
		font-size:120%;
	}
	table{
		margin-left: 13%;
		margin-top: 3%;
	}
	tr{
		margin: 3%;
	}
	.image{
		padding: 50px;
	}
	.name{
		margin-left:32%;
	}
	footer{
		height: 100px;
		margin-top: 5%;
		background-color:rgb(150,150,150);
		border: 1px solid black;
		border-radius: 10px;
		color: white;
	}
	.skills{
		font-size: 16px;
		margin-left:34%;
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
    <body style="margin: 0; padding: 0;">
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

<table>
<tr><td class="image"><img src="mypic.jpg" class="img1"></td>
<td class="image"><img src="abhilash.jpg" class="img1"></td>
<td class="image"><img src="aditya.jpg" class="img1"></td></tr>
<tr><td><h2 class="name">Arihant Jain</h2><p class="skills">Backend & frontend developer</p></td>
<td><h2 class="name">Abhilash Gupta</h2><p class="skills">Backend & frontend developer</p></td>
<td><h2 class="name">Aditya Abhishek</h2><p class="skills">frontend developer</p></td>
</tr>
</table>
<div style="border:2px solid grey;border-radius:10px;margin-left:90px;margin-right:85px;padding-left:85px;margin-top:50px;padding-right:35px">
<center><h1>About Us</h1></center>
<p>CODING@IIITDM is a not-for-profit educational initiative by a group of students at PDPM Indian Institute of Information Technology. It is a website for the coding community at IIITDM, so they develop as competitive programmer's. We have just started and are trying to build a bigger community of programmers.<br><br>
CODING@IIITDM was created as a platform to help programmers make it big in the world of algorithms, computer programming and programming contests. The site now is only hosting practice questions. Apart from this, the platform is open to the entire programming community to post their own question's.
User's could ask question in comment's which could by answered by other user's.<br><br></p>
<h2>How it all started and when?</h2>
<p>It started as a course project but the goal extended to improve and expand the programming community. This goal was inspired by different companies which host such coding competition and a following desire to implement such competetion in our college.<br><br>

</p>
</div>
<footer><p style="margin-left:25%;">&copy; CODE@IIITDMJ <br> Copyright 2010-2017 Arihant Jain
The only programming contests Web 2.0 platform<br>
Server time: Nov/28/2017 00:55:40UTC+5.5 (c2).
Desktop version</p></footer>
	
</body>
</html>