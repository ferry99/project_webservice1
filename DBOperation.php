<?php
class DBOperation{
	private $host = '127.0.0.1';
	private $user = 'root';
	private $db = 'webservice1';
	private $pass = 'root';
	private $conn;


	public function __construct(){

		$this -> conn = new mysqli($this -> host ,$this ->user ,$this ->pass,$this ->db);

		if ($this -> conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
	}

	public function checkNotExistCategory($name){
		$conn = $this -> conn;

		$sql = 'SELECT COUNT(*) AS count FROM category WHERE name_category = "'.$name.'"';
		$result = $conn->query($sql);

		$counter = mysqli_fetch_assoc($result);
		
		if($counter['count'] == 0){
			return true;
		}else{
			return false;
		}
	}

	public function checkNotExistAccount($name){
		$conn = $this -> conn;
		$sql = 'SELECT COUNT(*) AS count FROM accounts WHERE name_account = "'.$name.'"';
		$result = $conn->query($sql);

		$counter = mysqli_fetch_assoc($result);
		
		if($counter['count'] == 0){
			return true;
		}else{
			return false;
		}
	}

	public function insertDataAccount($data , $category){
		$conn = $this -> conn;
		$name = $data -> nameAccount;
		$username = $data -> username;
		$password = $data -> password;
		$email = $data -> email;
		$reset_key = $data -> resetkey;
		$note = $data -> note;
		$website = $data -> website;

		$sql = 'INSERT INTO accounts(id_category  , name_account , username , password, email , reset_key , note , website) 
					VALUES ('.$category.'  , "'.$name.'" , "'.$username.'" , "'.$password.'" ,"'.$email.'" ,"'.$reset_key.'" ,"'.$note.'" , "'.$website.'") ';	
		if($conn->query($sql) == TRUE){
			return true;
		}else{
			 echo "fail when inserted";
			echo die(mysql_error());
			return false;
		}
	}

	public function insertDataCategory($name){
		$conn = $this -> conn;
		$sql = 'INSERT INTO category(name_category) VALUES ("'.$name.'") ';	
		if($conn->query($sql) == TRUE){
			return true;
		}else{
			echo "fail when inserted";
			return false;
		}
	}

	public function getAllCategories(){
		$conn = $this -> conn;

		$sql = 'SELECT * FROM category ORDER BY name_category ';
		$result = $conn->query($sql); 
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return "";
		}
	}

	public function getAccounts($category){
		$conn = $this -> conn;

		$sql = 'SELECT id_account,name_account,username,reset_key,email FROM accounts WHERE id_category = '.$category.' ';
		$result = $conn->query($sql); 
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return "";
		}
	}

	public function getPassword($idAccount){
		$conn = $this -> conn;

		$sql = 'SELECT * FROM accounts WHERE id_account = '.$idAccount.' ';
		$result = $conn->query($sql); 
		//get single result

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			echo "error select";
			die(mysql_error());
		}
	}


	public function updateDataAccount($data , $id_account){
		$conn = $this -> conn;

		$username = $data -> username;
		$password = $data -> password;
		$email = $data -> email;
		$reset_key = $data -> resetkey;
		$note = $data -> note;
		$website = $data -> website;

		$sql = 'UPDATE accounts 
					SET username = "'.$username.'" , password = "'.$password.'" , email = "'.$email.'", reset_key = "'.$reset_key.'" ,note = "'.$note.'" , website = "'.$website.'"
					WHERE id_account = '.$id_account.'';
		$result = $conn->query($sql);
		if($result == TRUE){
			return true;
		}else{
			return false;
		}
	}


	public function deleteDataAccount($id_account){
		$conn = $this -> conn;

		$sql = 'DELETE FROM accounts WHERE id_account = "'.$id_account.'" ';
		$result = $conn -> query($sql);
		if($result == TRUE){
			return true;
		}else{
			return false;
		}
	}

	public function updateDataCategory($data , $id_category){
		$conn = $this -> conn;
		$new_name_cat = $data->name_category;

		$sql = 'UPDATE category
					SET name_category = "'.$new_name_cat.'" 
					WHERE id_category = '.$id_category.'';
		$result = $conn -> query($sql);
		if($result == TRUE){
			return true;
		}else{
			return false;
		}
	}


	public function deleteDataCategory($id_category){
		$conn = $this -> conn;

		$sql = 'DELETE FROM category WHERE id_category = '.$id_category.' ';
		$result = $conn -> query($sql);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}
}

?>