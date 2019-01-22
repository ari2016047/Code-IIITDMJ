  <?php include("confige.php"); session_start();?>
  <html>
<head>
<link rel="stylesheet" href="profile.css" />
<style>
table {
    border-collapse: collapse;
	text-align:center;
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
		margin-top: 17%;
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
      
   
  <?php
            
            
        echo "<center><table><tr>
                          <th style='width:500px;'>Name of Question</th>
                          <th>Difficulty level</th>
                          <th>Score</th>
                          <th>Rating</th>
                       </tr>";
        
        $sql = "select Name_of_question, qid, difficulty_level,score from practice_question";
        $result = mysqli_query($conn,$sql);
        
		        
        if(mysqli_num_rows($result) > 0){
            echo"<h2>Problems</h2>";
            while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
                $Name_of_question = $row['Name_of_question'];
                $qid = $row['qid'];
                $difficulty_level = $row['difficulty_level'];
                $score = $row['score'];
				
				$sql1 = "select avg(rating) from rates where qid='$qid' ";
				$result1 = mysqli_query($conn,$sql1);
				$row1 = mysqli_fetch_array($result1,MYSQL_ASSOC);
				$res = $row1["avg(rating)"];
				$res1=number_format($res,1);
                 echo "<tr>
                          <td><a href=question.php?qid=$qid style='text-decoration:none;'>$Name_of_question</td>
                          <td>$difficulty_level</td>
                          <td>$score</td>
						  <td>$res1</td>
                       </tr>";
            }
        }
        else{
            echo "no result";
        }
		echo "</table></center>";
                /*$qid = "q1";
                echo "<a href=question.php?qid=q1 style='text-decoration:none;'>Add Two Numbers</a>"."<br>";
                $qid = "q2";
                echo "<a href=question.php?qid=q2 style='text-decoration:none;'>Subtract Two Numbers</a>";*/
        $conn->close();
?>

<footer><p style="margin-left:25%;">&copy; CODE@IIITDMJ <br> Copyright 2010-2017 Arihant Jain
The only programming contests Web 2.0 platform<br>
Server time: Nov/28/2017 00:55:40UTC+5.5 (c2).
Desktop version</p></footer>
</body>
</html>
