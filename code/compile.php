<?php include("confige.php"); session_start();?>
<html>
<head>
<link rel="stylesheet" href="profile.css" />
<style>
#userimg{
		width:45px;
		height:45px;
		border-radius:30px;
        margin-bottom:40px;
        margin-right:20px;
	}
</style>
</head>
<ul>
  <li><a class="active" href="profile.php">Profile</a></li>
  <li><a href="Allquestion.php">Gym</a></li>
  <li><a href="leaderboard.php">LeaderBoard</a></li>
  <li><a href="about.php">AboutUs</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
  <li style="float:right;font-size:20px;color:white;margin-top:40px;">
  <?php
  $compileflag = 0;
  $username = $_SESSION["username"];
  $sql = "select photo from user where username='$username'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $photo = $row["photo"];
  echo "<img src = '$photo' id='userimg' alt='user image' style='float:left;margin-bottom:5px'><div style='margin-top:2px;float:left;padding-left:8px;'> $username</div>";
  ?></li>
</ul>
<br>
   
<body>
<br>
<?php
    
    echo "<div style='font-size:20px;background-color:#fff0f5;border:2px solid grey;border-radius:10px;margin-left:90px;margin-right:85px;padding-left:85px;margin-top:10px;padding-right:35px;padding-top:-20%;'>";
    $username = $_SESSION["username"];
    $qid = $_SESSION["qid"];
    $target_dir = "";
    $result_1 = "correct";
    $correct_count = 0;
    $wrong_count = 0;
    $filename = $username . $qid . basename($_FILES["codefile"]["name"]);
    $target_file = $target_dir . $filename;
    $upload_ok = 1;
    $update = 0;
    $codeFileExtention = pathinfo($target_file,PATHINFO_EXTENSION);
    //echo "file extention is".$codeFileExtention;
    if (file_exists($target_file)){
        $update = 1;
        //echo "File already exists<br>";
        //$upload_ok = 0;
        $path = $_SERVER['DOCUMENT_ROOT']."/$filename";
        //echo $path;
        unlink($path);
    }
    if ($_FILES["codefile"]["size"]>50000){
        echo "Your file is too big<br>";
        $upload_ok = 0;
    }
    if($codeFileExtention != $_POST["com_language"]){
        echo "Your file type didn't match the selected compile language<br>";
        $upload_ok = 0;
    }
    if($upload_ok == 0)
        echo "Your file was not uploaded<br>";
    else{
        if (move_uploaded_file($_FILES["codefile"]["tmp_name"],$target_file)){
            echo "The file " . basename($_FILES["codefile"]["name"]) . " has been uploaded<br>";
        
        $compile = $filename;
        $path2 = $_SERVER['DOCUMENT_ROOT']."/Java/jdk1.8.0_144";
        //echo $path2."<br>";
        exec("$path2\bin\javac $compile 2>&1",$compile_msg,$error_in_compile);
        //var_dump($compile_msg);
        //var_dump($error_in_compile);
       /* $tfile = fopen("testcase.txt", "r") or die("Unable to open file");
        $tarray = array();
        while(!feof($tfile)) {
            $array_push($tarray, fgets($myfile));
        }
        var_dump($tarray);*/
        if(empty($compile_msg) == true){
            
			    $sql = "select inputfile_id from input_testcase where qid='$qid'";
				$result = mysqli_query($conn,$sql);
				
				$i = 1;
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $inputfile = $row['inputfile_id'] . ".txt";
                exec("$path2\bin\java Solution < $inputfile 2>&1",$runoutput,$runerror);
                //var_dump($runoutput);
                //var_dump($runerror);
            $user_output = $username . "_output$i.txt";
            $outputfile = fopen($user_output, "w") or die("Unable to open file");
            foreach($runoutput as $output){
                fwrite($outputfile,$output);
                }
            //var_dump($runoutput);
            unset($runoutput);
            //var_dump($runoutput);
            fclose($outputfile);
            $i = $i + 1;
            }
        }
        else {
            foreach($compile_msg as $compilation_error){
				echo $compilation_error."<br>";
				$compileflag = 1;
			}
        }
        //$path = $_SERVER['DOCUMENT_ROOT'].'/solution.java';
        //$path1 = $_SERVER['DOCUMENT_ROOT'].'/Solution.class';
        //echo $path."    ".$path1;
        $path3 = $_SERVER['DOCUMENT_ROOT'];
        $j =1;
		$sql2 = "select outputfile_id from output_testcase where qid='$qid'";
		$result2 = mysqli_query($conn,$sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
            $user_output = $username . "_output$j.txt";
            $outputfile = $row2["outputfile_id"] . ".txt";
            exec("FC $user_output $outputfile 2>&1",$filecheck);
            //echo $filecheck[1]."<br>";
            if($filecheck[1] == "FC: no differences encountered"){
                echo "testcase".$j." correct"."<br>";
                $correct_count++;
            }
            else{
                echo "testcase".$j." wrong"."<br>";
                $result_1 = "wrong";
                $wrong_count++;
            }
            unset($filecheck);
            $j = $j + 1;
        }
        $path1 = $_SERVER['DOCUMENT_ROOT']."/Solution.class";
        if($compileflag==0){
			unlink($path1);
		}
        }
        else{
            echo "Some error occurred";
        }
        if($update == 1 ){
            $sql6 = "select uid from user where username = '$username'";
            $result6 = mysqli_query($conn,$sql6);
            $row6 = mysqli_fetch_array($result6,MYSQLI_ASSOC);
            $uid = $row6["uid"];
            $sql4 = "update prac_solve set result = '$result_1' where uid = $uid and qid='$qid'";
			$result4 = mysqli_query($conn,$sql4);
        }
        else{
			$sql5 ="select uid from user where username = '$username'";
			$result5 = mysqli_query($conn,$sql5);
			
			$row5 = mysqli_fetch_array($result5,MYSQLI_ASSOC);
			$uid = $row5["uid"];
            $sql4 = "insert into prac_solve values ($uid,'$qid','$filename','$result_1')";
			$result4 = mysqli_query($conn,$sql4);
        if($result4 === true){
            echo "Solution saved";
        }
        else{
            echo "error " . $sql4 ."<br>" . $conn->error;
        }
			
        }
        $conn->close();
        /*var_dump($filecheck);
        foreach($filecheck as $check){
            echo $check;
        }*/
        //unlink($path);
        //unlink($path1);
        /*unlink("user_output1.txt");
        unlink("user_output2.txt");
        unlink("user_output3.txt");*/
        }
		echo "</div>";
?>
</body>
</html>