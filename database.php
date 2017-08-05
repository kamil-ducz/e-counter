<?php

		session_start();
		
class Database			// here we have class Database with most of methods
{
	private $connection;
	
	
	function connect()		// used every time to connect with mysql
	{
		require_once('connect.php');	//we need this file and we're configuring everything(host,user,pass etc.) in it
		if (false == isset($this -> connection))		// when there is no connection...
		{
			$this -> connection = mysqli_connect($host, $db_user, $db_password);		//asign effect of connection to var connection
			
			if (mysqli_connect_errno())		// when there's error in connection this if happens and function returns false
			{
				return false;
			}
		}
		  
		return true;		// happens when connection is on
	}
	
	function createDatabase()		//this need to go for the first time to create userdatabase
	{
		$result = $this -> connect();
		
		if (true == $result)
		{		
			$query = "CREATE DATABASE IF NOT EXISTS usersdatabase"; 
			mysqli_query($this -> connection, $query) ;
			mysqli_select_db($this->connection, "usersdatabase");
			//creating table for userdatabase if there isn't one
			$query2="CREATE TABLE IF NOT EXISTS users(

							   id int(10) NOT NULL auto_increment,                 
							   name varchar (20) NOT NULL,
							   surname varchar (20) NOT NULL,
							   login varchar (20) NOT NULL,
							   password varchar (20) NOT NULL,
							   mail varchar (20),
							   
							   walletUSD int(10),
							   walletEUR int(10),
							   walletCHF int(10),
							   walletRUB int(10),
							   walletCZK int(10),
							   walletGBP int(10),
							   walletPLN int(10),
							   
							   PRIMARY KEY (id)
															)";
							   
			//create table where counter bureau money is 
			$query3="CREATE TABLE IF NOT EXISTS counter(
			
							   counter_money int(10) DEFAULT 100000,
							   PRIMARY KEY (counter_money)
																				)";

			mysqli_query($this -> connection, $query2) ;		// execute queries db and table
			mysqli_query($this -> connection, $query3) ;
			
			return true;
		}
		else
			return false;
	}
	
	function checkUser($login)		// used when user's logging and during registration
	{
		$query="SELECT * FROM users WHERE login='$login'";
		$result = mysqli_query($this -> connection, $query);
		
		
		// Mysql_num_row is counting table row
		
		if (1 == mysqli_num_rows($result))		// number of rows has to be exactly 1 (only 1 user can have 1 login)
		{
			return false;		// there is such user, so false
		}
		
		return true;		// check ok, login free
	}
	
	function  registerUser ($name, $surname, $login, $password, $mail, $walletUSD, $walletEUR, $walletCHF, $walletRUB, $walletCZK, $walletGBP, $walletPLN)
	{
		$connection = mysqli_connect($host, $db_user, $db_password);
		//put new user to database and SQL INJECTION protection thanks to mysqli_real_escape_string, sprintf func helps to organize code
		$query = sprintf("INSERT INTO users(name, surname, login, password, mail, walletUSD, walletEUR, walletCHF, walletRUB, walletCZK, walletGBP, walletPLN) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", mysqli_real_escape_string($connection, $name), mysqli_real_escape_string($connection, $surname), mysqli_real_escape_string($connection, $login), mysqli_real_escape_string($connection, $password), mysqli_real_escape_string($connection, $mail), mysqli_real_escape_string($connection, $walletUSD), mysqli_real_escape_string($connection, $walletEUR), mysqli_real_escape_string($connection, $walletCHF), mysqli_real_escape_string($connection, $walletRUB), mysqli_real_escape_string($connection, $walletCZK), mysqli_real_escape_string($connection, $walletGBP) ,mysqli_real_escape_string($connection, $walletPLN));
		$result = mysqli_query($this -> connection, $query);
			
		if (true == $result)		//success 
		{
			return true;	
		}
		else
		{
			return false;		// unable to execute query
		}

	}
	
	function loginCheck($login, $password)
	{
		
		$connection =  mysqli_connect($host, $db_user, $db_password);		// set connection to variable
		
		// use mysqli_real_escape string for SQL INJECTION protection 
		$query=sprintf("SELECT * FROM Users WHERE login='%s' and password='%s'", mysqli_real_escape_string($connection, $login), mysqli_real_escape_string($connection, $password));
		$result=mysqli_query($this -> connection, $query);

		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);
		// If result matched $username and $password, table row must be 1 row
		if ($count ==1 ) {
			//echo "Success! $count";
			return true;
		} else {
			//echo 'Wrong username or password';
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
	
	public function updateUser($pass, $name, $surname, $mail, $login ) { //settings change

       $result = $this -> connect();
		if (true == $result)
		{		
			$query = "UPDATE users SET password='$pass', name='$name', surname='$surname', mail='$mail' WHERE login='$login' "; 
			mysqli_select_db ($this -> connection, "usersdatabase");
			$result = mysqli_query($this -> connection, $query) ;
			
			return $result;
		}
		
		return false;
    }
	
	
	function closeConnection()
	{
		mysqli_close($this -> connection);
	}
}
?>