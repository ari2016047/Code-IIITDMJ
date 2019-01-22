<?php include("confige.php"); session_start();?>
<html>
    <head>
<link rel="stylesheet" href="profile.css" />
<style>
#submit{
	margin-top:20px;
	
}
#submit2{
	height:40px;
	width:100px;
}
#submit3
{
	height:25px;
	width:100px;
}
#comment{
	width:400px;
	height:40px;
	border:1px solid gray;
	border-radius:10px;
}
td,th{
	text-align:center;
	padding-right:70px;
	padding-left:70px;
}
th{
	padding-bottom:20px;
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
<body>
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
  ?></li>
</ul>
        <?php
            
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $qid1 = $_SESSION["qid"];
            }
            else{
                $qid1 = $_GET['qid'];
            }
            $_SESSION["qid"] = $qid1;
			
			$sql5 = "select count(qid) from prac_solve where qid='$qid1'";
            $result5 = mysqli_query($conn,$sql5);
            $row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC);
            $noofsubmission = $row5["count(qid)"];
            echo"<div style='margin-left:100px;font-weight:bold;font-size:120%;margin-top:20px;'>No of Submissions : $noofsubmission</div>";
			
            echo "<div style='background-color:#fffff0;border:2px solid grey;border-radius:10px;margin-left:90px;margin-right:85px;padding-left:85px;margin-top:20px;padding-right:35px'>";
            $sql = "SELECT question_description,Name_of_question FROM practice_question WHERE qid='$qid1'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $question_description = $row['question_description'];
					$name = $row['Name_of_question'];
                    echo "<h1>$name</h1>";
                    echo "<p>$question_description</p>";
                }
            }
            else{
                echo "no result";
            }
        echo "</div>";
        echo"<center><h2>Instructions:</h2><p>Note : Take input from stdin and give output to stdout</p>
        
        <form method ='post' action='compile.php' enctype='multipart/form-data'>
		<p>UPLOAD SOLUTION HERE</p>
            <select name = 'com_language' id = 'com_language'>
                <option>java</option>
                <option>c++</option>
                <option>python</option>
            </select>
            <input type = 'file' name = 'codefile' id = 'codefile'><br>
            <input type = 'submit' name = 'submit' id = 'submit' value = 'UPLOAD'><br>
                    </form></center>";
		echo "<div style='background-color:#fffff0;border:2px solid grey;border-radius:10px;margin-left:90px;margin-right:85px;padding-left:85px;margin-top:50px;padding-right:35px'>";
		 echo"<form action='question.php' method='post'>
		         <p><b>Rate above question :&emsp;&emsp;&emsp;&emsp;</b><select name = 'rating' id = 'rating'>
                <option>1 Star</option>
                <option>2 Star</option>
                <option>3 Star</option>
                <option>4 Star</option>
                <option>5 Star</option>
            </select>&emsp;&emsp;
			<input type='hidden' name = 'rateflag' value='rate'>
			<input type = 'submit' name = 'submit3' id = 'submit3' value='Rate'><br><br></p>";
			if($_SERVER["REQUEST_METHOD"]=="POST"){
			$user = $_SESSION["username"];
			$sql10 = "SELECT uid from user where username='$user'";
    $result10 = mysqli_query($conn,$sql10);
    $row10 = mysqli_fetch_array($result10,MYSQLI_ASSOC);
				$qid10 = $_SESSION["qid"];
				
			$uid10 = $row10["uid"];
			if($_POST['rateflag'] == "rate"){
			$r = $_POST['rating'];
			if($r=="1 Star")
				$r1=1;
			if($r=="2 Star")
				$r1=2;
			if($r=="3 Star")
				$r1=3;
			if($r=="4 Star")
				$r1=4;
			if($r=="5 Star")
				$r1=5;
			
			if($r!=NULL)
			{
				$sql11="select uid,qid from rates where uid=$uid10 and qid='$qid10'";
				$result11 = mysqli_query($conn,$sql11);
				$row11 = mysqli_fetch_array($result11,MYSQLI_ASSOC);
				if(mysqli_num_rows($result11) > 0){
					$sql12 = "update rates set rating=$r1 where uid=$uid10 and qid='$qid10'";
				$result12 = mysqli_query($conn,$sql12);
				}
				else{
				$sql9 = "insert into rates values($uid10,'$qid10',$r1)";
				$result9 = mysqli_query($conn,$sql9);
				}
				header("location:question.php?qid=".urlencode("$qid10"));
			}
		
			}
			}		
		
		
		
		
		
    echo"<form action='question.php' method='post'>
            <p><b>Post your comments :&emsp;&emsp;</b><input type = 'textarea' name='comment' id='comment'>
            <input type = 'hidden' name = 'flag' id = 'flag' value = '1'>
            &emsp;<input type = 'submit' name = 'submit2' id = 'submit2' value='post'>
            </form></p></div>";
    $username = $_SESSION["username"];
    $sql2 = "SELECT uid from user where username='$username'";
    $result2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $qid = $_SESSION["qid"];
    if($_POST["submit2"] == "post"){
        $uid = $row2["uid"];
        $comment = $_POST["comment"];
        $sql1 = "INSERT INTO practice_comments(uid,qid,comment_description) values ($uid,'$qid','$comment')";
        $result1 = mysqli_query($conn,$sql1);
        header("location:question.php?qid=".urlencode("$qid"));
    }
    }
    $qid4 = $_SESSION["qid"];
    $sql4 = "select u.username, p.time_of_post, p.comment_description from practice_comments p, user u where u.uid=p.uid and p.qid='$qid4'";
    $result4 = mysqli_query($conn,$sql4);
    echo "<div style='background-color:#fff0f5;border:2px solid grey;border-radius:10px;margin-left:90px;margin-right:85px;padding-left:85px;margin-top:10px;padding-right:35px;padding-top:-20%;'>";
    echo"<table style='margin-top:-5%'>
            <tr>
                <th>Username</th>
                <th>Comments</th>
                <th>Time Of Submission</th>
            </tr>";
			
    while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC)){
        $username1 = $row4["username"];
        $time = $row4["time_of_post"];
        $comment1 = $row4["comment_description"];
        echo"<tr><td>$username1</td>
                 <td>$comment1</td>
                 <td>$time</tr><br>
                ";
    }
	echo "</table></div>";
    
?>
    </body>
</html>