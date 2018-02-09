<?php
/*
LoginWrapper uses mySQL

1. See if user is logged in
	a. If logged in, continue
	b. If not logged in, go to 2
2. Redirect to login
*/


class DBOptions{
	public $server = "localhost:3306";
	public $username = "root";
	public $password = "root";
	public $database = "users";
	public $charset = "utf8";
	public $usertable = "user_table";
	
	
	public function __construct($options = array()){
		foreach($options as $key => $val) {
			if(isset($this->{$key})) {
				$this->{$key} = $val;
			}
		}
	}
	
}

class LoginOptions{
	public $sessionID = "user_session";
	public $sessionVariableUsername = "userName";
	public $sessionVariablePasskey = "userKey";
	public $secure = true;
	public $redirect = false;
	public $redirectURL = "";
	
	public function __construct($options = array()){
		foreach($options as $key => $val) {
			if(isset($this->{$key})) {
				if($key == "redirectURL"){
					$this->redirect = true;
				}
				$this->{$key} = $val;
			}
		}
	}
}

class LoginWrapper{
	//Connection Information
	private $conn;
	private $loggedin;
	private $loginOptions;
	private $databaseOptions;

	
	public function __construct($databaseOptions , $loginOptions){
		$this->loginOptions = $loginOptions;
		$this->databaseOptions = $databaseOptions;
		try{
			//Establish connection
			$this->conn = $this->connectToDB($databaseOptions);
		} catch(Exception $e){
			//Create DB
			$this->constructDatabase($this->connectToServer($databaseOptions) , $databaseOptions);
			$this->conn = $this->connectToDB($databaseOptions);
		} 
		$this->startSession($loginOptions , $databaseOptions);
		$this->loggedin = $this->verifySession($loginOptions , $databaseOptions);
		
		if($loginOptions->redirect && !$this->loggedin){
			header('Location: '.$loginOptions->redirectURL);
		}
		
	}
	
	public function registerUser($username , $name , $email , $password){
		//See if user exists
		$query = "SELECT password FROM ".$this->databaseOptions->usertable." WHERE username = :user LIMIT 1";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":user" => $username));
		if($statement->rowCount() == 1){
			return "Username exists";
		}
		
		$query = "INSERT INTO ".$this->databaseOptions->usertable." (username , name , email , password) VALUES (:u , :n , :e , :p)";
		$statement = $this->conn->prepare($query);
		$password = password_hash($password , PASSWORD_BCRYPT);
		$statement->execute(array(":u" => $username , ":n" => $name , ":e" => $email , ":p" => $password ));
		
		return true;
	}
	
	public function getUserData($username){
		//See if user exists
		$query = "SELECT username , name , email FROM ".$this->databaseOptions->usertable." WHERE username = :user LIMIT 1";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":user" => $username));
		if($statement->rowCount() == 1){
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	
	public function checkIfUserIdentifierExists($identifier){
		$query = "SELECT username , email FROM ".$this->databaseOptions->usertable." WHERE username = :u OR email = :i";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":u" => $identifier , ":i" => $identifier));
		return $statement->rowCount() == 1;
	}
	
	public function getUserFromIdentifier($identifier){
		$query = "SELECT username , email FROM ".$this->databaseOptions->usertable." WHERE username = :u OR email = :i";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":u" => $identifier , ":i" => $identifier));
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
	
	
	public function logout(){
		if(isset($_SESSION[$this->loginOptions->sessionVariableUsername] , $_SESSION[$this->loginOptions->sessionVariablePasskey])){
			$_SESSION = array();
			session_destroy();
			return true;
		}
		return false;
	}
	
	public function login($username , $password){
		$query = "SELECT password FROM ".$this->databaseOptions->usertable." WHERE username = :user LIMIT 1";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":user" => $username));
		if($statement->rowCount() != 1){
			//echo("No such user for log in.");
			return false;
		}
		$userdbpass = $statement->fetch(PDO::FETCH_ASSOC)["password"];
		if(password_verify($password , $userdbpass)){
			$_SESSION[$this->loginOptions->sessionVariableUsername] = $username;
			$_SESSION[$this->loginOptions->sessionVariablePasskey] = hash('sha512' , $userdbpass.$_SERVER['HTTP_USER_AGENT']);
			return true;
		}
		return false;
	}
	
	
	
	public function isLoggedIn(){
		return $this->loggedin;
	}
	
	public function verifySession($logopt , $dbopt){
		/*
		Returns false if not currently logged in.
		Return true if logged in and credentials are valid. 
		*/
		if(!isset($_SESSION[$logopt->sessionVariableUsername] , $_SESSION[$logopt->sessionVariablePasskey])){
			//echo("Session not set");
			return false;
		}
		$suser = $_SESSION[$logopt->sessionVariableUsername];
		$spass = $_SESSION[$logopt->sessionVariablePasskey];
		
		//$query = "SELECT password FROM ".$dbopt->usertable."WHERE username = :user";
		$query = "SELECT password FROM ".$this->databaseOptions->usertable." WHERE username = :u LIMIT 1";
		$statement = $this->conn->prepare($query);
		$statement->execute(array(":u" => $suser));
		if($statement->rowCount() != 1){
			//echo("No such user");
			return false;
		}
		$userdbpass = $statement->fetch(PDO::FETCH_ASSOC)["password"];
		return(hash_equals($spass, hash('sha512', $userdbpass . $_SERVER['HTTP_USER_AGENT'])));
	}
	
	public function startSession($logopt){
		//session_name($logopt->sessionID);
		if (ini_set('session.use_only_cookies', 1) === FALSE) {
			header("Location: ../error.php?err=Could not initiate a safe session (ini_set)"); //TODO
			exit();
		}
		//$cookieParams = session_get_cookie_params();
		//session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], true, true);
		session_start();
		//session_regenerate_id(true);
	}
	
	
	public function constructDatabase($connection , $dbopt){
		$statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS '.$dbopt->database);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE DATABASE query failed.");
		}
		
		$query = "CREATE TABLE ".$dbopt->database.".".$dbopt->usertable." (
				username VARCHAR(50) NOT NULL PRIMARY KEY,
				name VARCHAR(60) NOT NULL,
				email VARCHAR(50) NOT NULL,
				password CHAR(128) NOT NULL
			)";
		$statement = $connection->prepare($query);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE TABLE query failed.");
		}
	}
	
	public function connectToServer($dbopt){
		$dsn = "mysql:host=".$dbopt->server.";charset=".$dbopt->charset;
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
		];
		return(new PDO($dsn, $dbopt->username, $dbopt->password, $opt));
	}
	
	public function connectToDB($dbopt){
		$dsn = "mysql:host=".$dbopt->server.";dbname=".$dbopt->database.";charset=".$dbopt->charset;
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
		];
		return(new PDO($dsn, $dbopt->username, $dbopt->password, $opt));
	}
	
	public function setDBConnection($connection){
		if(get_class($connection) != "PDO"){
			throw new Exception("setDBConnection Error: Argument connection is not a valid PDO object!");
		}
		$this->conn = $connection;
	}
	
	
}


//$dbopt = new DBOptions();
//$loginopt = new LoginOptions();
//$sv = new LoginWrapper($dbopt , $loginopt);

?>