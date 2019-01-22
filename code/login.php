<?php
    include("confige.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
        $sql = "select username from signup where username = '$username' and password = '$password'";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        
        $count = mysqli_num_rows($result);
        
        if($count == 1){
            $_SESSION['username'] = $username;
            
            header("location: profile.php");
        }
        else{
            echo "Your Username or Password is invalid";
        }
    }
?>
<html>
    <head>
        <title> Log In </title>
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
		color:black;
		font-size:150%;
		border:5px double white;
		padding:10px;
		width:25%;
		height:60%;
		display:inline-block;
		
	}
	tr,td{
		padding:12px;
		padding-left:1px;
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
   margin-left:40px;
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
}</style>
    </head>
    <body>
          <img src="login.jpeg" style="" width="100%" height="100%">
		  <div id="body" align="center">
            <form action="" method="post">
              <h2 style="color:white">Log In</h2>
			  <table>
			  <tr><td>
               <label>
                  Username
               </label></td><td>
                <input type="text" name="username" style="height:30px;border:1px solid grey;border-radius:5px;"/>
                </td><tr><td>
                 <label>
                  Password
                </label></td><td>
                <input type="password" name="password" style="height:30px;border:1px solid grey;border-radius:5px;"/>
               </td></tr></table>
              <button type="submit" class="button"><span>Log In</span></button>
            </form>
            </div>
</body>
</html>