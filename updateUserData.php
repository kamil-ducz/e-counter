<?php
	session_start();
	
	if (false == isset($_SESSION['login']))
	{
		header("Location:index.php");
		exit;
	}
	
	require_once('database.php');
	
	$_SESSION['password2']  = $_POST['password2'];
	$_SESSION['name']  = $_POST['userName'];
	$_SESSION['surname']  = $_POST['userSurname'];

	$db = new Database();
	$result = $db ->updateUser($_SESSION['login'], $_SESSION['password2'], $_SESSION['name'], $_SESSION['surname']);
	if (true == $result)
	{
		$_SESSION['error'] = '<span style="color:yellow"><br />Zapisano nowe dane, dziękujemy!';
		header("Location:userSettings.php");
	}
	else
	{
		$_SESSION['error'] = '<span style="color:red"><br />Nie można było zaktualizować danych. Skontaktuj się z administratorem aplikacji.';
		header("Location:userSettings.php");

	}
	//header("Location:index.php");
	
	
?>

</body>

</html>