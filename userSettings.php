<?php 
   session_start();		//open session and access all session variables 
   
   if((!isset($_SESSION['login'])) || (!isset($_SESSION['password'])))	//if not logged immediatly go to index.php 

   { 
   
   	header("Location: index.php"); 

   	exit(); 
   } 
   
   ?> 
   
<!DOCTYPE HTML> 
<html lang="pl">
   <head>
      <meta charset="utf8" />
      <meta httpequiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1" />
      <title>Personal Settings</title>
      <link rel="stylesheet" href="css/userSettingsStyle.css" type="text/css">
	  <link rel="stylesheet" href="css/fontello.css" type="text/css">
      <script type="text/javascript" src="script.js"></script> 
   </head>
   <body>
      Modify your data: 
      <p>
      <p> 
      <form action="updateUserData.php" method="post"> 
         Login: <input type="text" name="login"  value="<?php echo $_SESSION['login']?>" disabled="disabled" /> <br />
		 
         New password:<input type="password" name="password" id="password" minlength="4"  maxlength="20" required  value="<?php echo $_SESSION['password']?>" /> <br />
		 <input type="checkbox" onclick="unhidePassword()">Show password <br />
		 
         Name:<input type="text" name="userName" minlength="3" maxlength="20" value="<?php echo $_SESSION['name']?>" /> <br />
		 
         Surname:<input type="text" name="userSurname" minlength="3" maxlength="20" value="<?php echo $_SESSION['surname']?>"  /> <br />
		 
         My E-Mail:<input type="email" name="mail" value="<?php echo $_SESSION['mail']?>"  /> <br /><br />
		 
         <a href="index.php" class="icon-power"></a> 
         <input type="submit" value="Save changes" /> 
      </form>
   </body>
</html>