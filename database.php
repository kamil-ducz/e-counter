<?php
session_start();
		
class Database
{
	private $connection;
	
	function connect()
	{
		require_once('connect.php');	
		if (false == isset($this -> connection))
		{
			$this -> connection = mysqli_connect($host, $db_user, $db_password, $db_name);
			if (mysqli_connect_errno())
			{
				return false;
			}
		}
		return true;
	}
	
	function createDatabase()
	{
		$result = $this -> connect();
		if (true == $result)
		{		
			$query = "CREATE DATABASE IF NOT EXISTS ecounter_usersdatabase"; 
			mysqli_query($this -> connection, $query) ;
			mysqli_select_db($this->connection, "ecounter_usersdatabase");
			$query2="CREATE TABLE IF NOT EXISTS users
								(
									id int(10) NOT NULL auto_increment,                 
									name varchar (20) NOT NULL,
									surname varchar (20) NOT NULL,
									login varchar (20) NOT NULL,
									password varchar (255) NOT NULL,
									mail varchar (50),
									walletUSD int(10),
									walletEUR int(10),
									walletCHF int(10),
									walletRUB int(10),
									walletCZK int(10),
									walletGBP int(10),
									walletPLN int(10),
									PRIMARY KEY (id)
							   )";
			$query3="CREATE TABLE IF NOT EXISTS counter
								(
									counter_money int(10) DEFAULT 100000,
									PRIMARY KEY (counter_money)
								)";
			mysqli_query($this -> connection, $query2) ;
			mysqli_query($this -> connection, $query3) ;
			
			return true;
		}
		else
			return false;
	}
	
	function checkUser($login)
	{

		$query="SELECT * FROM users WHERE login='$login'";
		$result = mysqli_query($this -> connection, $query);

		if (mysqli_num_rows($result) == 0)
		{
			return true;
		}
		else
		{
			return false;			
		}	


	}
	
	function  registerUser ($name, $surname, $login, $password, $walletUSD, $walletEUR, $walletCHF, $walletRUB, $walletCZK, $walletGBP, $walletPLN)
	{
		$password = password_hash($password, PASSWORD_DEFAULT);

		$query = 'INSERT INTO users(name, surname, login, password, walletUSD, walletEUR, walletCHF, walletRUB, walletCZK, walletGBP, walletPLN) 
		VALUES ("'.$name.'", "'.$surname.'", "'.$login.'", "'.$password.'", "'.$walletUSD.'",
		 "'.$walletEUR.'", "'.$walletCHF.'", "'.$walletRUB.'", "'.$walletCZK.'", "'.$walletGBP.'",
		  "'.$walletPLN.'" )';
		$result = mysqli_query($this -> connection, $query);

		if (true == $result)
		{
			return true;	
		}
		else
		{
			return false;
		}

	}
	
	function loginCheck($login, $password)
	{
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");

		$query=sprintf("SELECT * FROM users WHERE login='%s'", 
		mysqli_real_escape_string($this -> connection, $login));
		$result=mysqli_query($this -> connection, $query);
		$row = $result -> fetch_assoc();//fetch row from query and store in array
		
		
		if(password_verify($password, $row['password']))
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	
	public function db_query($query) {

        $result = mysqli_query($this -> connection, $query);
		
        if($result == false) 
		{
            return false;
        }
        $row = $result -> fetch_assoc();

        return $row;
    }
	
	public function updateUser($login, $pass, $name, $surname) { //settings change

	   $result = $this -> connect();
	   $pass = password_hash($pass, PASSWORD_DEFAULT);

		if (true == $result)
		{		
			$query = "UPDATE users SET password='$pass', name='$name', surname='$surname' WHERE login='$login' "; 
			mysqli_select_db ($this -> connection, "ecounter_usersdatabase");
			$result = mysqli_query($this -> connection, $query) ;
			
			return true;
		}
		else
		{
			return false;			
		}

    }
	
	function closeConnection()
	{
		mysqli_close($this -> connection);
	}
}
?>