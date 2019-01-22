<?php include("confige.php"); session_start();?>
<html>
<head>
<link rel="stylesheet" href="profile.css" />
<style>
table {
    border-collapse: collapse;
	text-align:center;
	width:1000px;
}

table,td,th{
    border: 2px solid grey;
}
th{
	height:50px;
	width:200px;
}
footer{
		height: 100px;
		margin-top: 12%;
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


 <?php
            
            
        echo "<center><table><tr>
                          <th>Rank</th>
                          <th>Username</th>
                          <th>Total Score</th>
                       </tr>";
        
        $sql = "select * from leaderboard order by total_score desc";
        $result = mysqli_query($conn,$sql);
        //$row = mysqli_fetch_array($result,MYSQL_ASSOC);
        $rank=0;
        if(mysqli_num_rows($result) > 0){
            echo"<h2>LeaderBoard</h2>";
            while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
                $user = $row['username'];
                $rank=$rank+1;
				$score=$row['total_score'];
                 echo "<tr>
                          <td>$rank</td>
                          <td>$user</td>
                          <td>$score</td>
                       </tr>";
            }
        }
        else{
            echo "LeaderBoard Empty";
        }
		echo "</table></center>";
                
        $conn->close();
?>

<footer><p style="margin-left:25%;">&copy; CODE@IIITDMJ <br> Copyright 2010-2017 Arihant Jain
The only programming contests Web 2.0 platform<br>
Server time: Nov/28/2017 00:55:40UTC+5.5 (c2).
Desktop version</p></footer>
</body>
</html>