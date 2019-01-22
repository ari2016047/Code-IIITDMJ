<?php
    include("confige.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        
        $sql = "select username from signup where username='$username' or email='$email'";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        
        if($count == 0){
            $sql1 = "insert into signup values ('$username','$email','$password')";
            $result = mysqli_query($conn,$sql1);
            if($result === true){
                $_SESSION['username'] = $username;
                header("location: profile.php");
            }
            else{
                echo "error " . $sql1 . $conn->error;
            }
        }
        else{
            echo "This username or email already exists please choose another";
        }
    }
?>
<html>
<head>
<title>
Getting Started
</title>
<style>
	
	body{
		margin:0;
		padding:0;
		opacity:1.0;
	}
	#body{
		margin-top:-40%;
		margin-left:70%;
		opacity:1.0;
		color:white;
		font-size:150%;
		border:5px double white;
		padding:10px;
		width:25%;
		height:60%;
		display:inline-block;
		
	}
	tr,td{
		padding:12px;
	}
	
	.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #2b60de;
  border: none;
  color: white;
  font-size: 17px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  height:50px;
  text-align: center;
  margin-top:20px;
 
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
	</style>
</head>
<body>
	<img src="signup.jpeg" style="" width="100%" height="100%">
	<div id="body" align="center">
	
    
      <form action="" method="post" style="">
        
          <h2>Sign Up</h2>
          <table style="color:white;"><tr>
             <td> <label>
                Email
              </label></td>
              <td><input type="mail" name="email" style="height:30px;border:1px solid grey;border-radius:5px;"/></td></tr>
            <tr><td>			  
			 <label>
			 Username
            </label></td>
			<td>
            <input type="text" name="username" style="height:30px;border:1px solid grey;border-radius:5px;"/> 
          </td></tr>
		  <tr><td>
            <label>
              Password
            </label></td>
            <td><input type="password" name="password" style="height:30px;border:1px solid grey;border-radius:5px;"/> </td>
          </tr></table>
          
        <button type="submit" class="button"><span>Get Started</span></button>
          
      </form>
		  
   

</div>
</body>
</head>
</html>