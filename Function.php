<?php

require_once 'DBOperation.php';

class Functions{
	private $db;

	public function __construct(){
		$this -> db = new DBOperation();
	}

	public function createAccount($data , $category){
		$db = $this -> db;
		//check name category
		$notExist = $db -> checkNotExistAccount($data->nameAccount);
		if($notExist){
			$result = $db -> insertDataAccount($data , $category);
			if($result){
				$response["result"] = "Success";
				$response["message"] = "Inserted Successfully";
			}else{
				$response["result"] = "fail";
				$response["message"] = "Database Error";
			}
			return json_encode($response);
		}else{
			$response["result"] = "fail";
			$response["message"] = "name account already exist";
			return json_encode($response);
		}	
	}

	public function createCategory($name){
		$db = $this -> db;

		//check name category
		$notExist = $db -> checkNotExistCategory($name);
		if($notExist){
			$result = $db -> insertDataCategory($name);
			if($result){
				$response["result"] = "Success";
				$response["message"] = "Inserted Successfully";
			}else{
				$response["result"] = "fail";
				$response["message"] = "Database Error";
			}
			return json_encode($response);
		}else{
			$response["result"] = "fail";
			$response["message"] = "name category already exist";
			return json_encode($response);
		}

	}

	public function registerUser($name , $email , $password){
		$db = $this-> db;

		if($name !== '' && $email !== '' && $password !== ''){
			$result = $db -> insertData($name ,$email , $password);

			if($result){
				$reponse["result"] = 'success';
				$respone["messsage"] = "Inserted Successfully";
				return json_encode($response);
			}else{

			}

		}else{
			$reponse["result"] = 'fail parameters';
			$respone["messsage"] = "Inserted fail parameters";
			return json_encode($response);
		}
	}

	public function getAll(){
		$db = $this-> db;
		$response["data"] = $db -> getAllCategories();		
		return json_encode($response);
	}

	public function getAccounts($category){
		$db = $this-> db;
		$data = $db -> getAccounts($category);
		if($data !== ""){
			$response["data"] = $data;
		}else{
			$response["result"] = "no data";
			$response["message"] = "dont have accounts";
		}
		return json_encode($response);
	}



	public function getPassword($idAccount){
		$db = $this -> db;
		if($idAccount !== ''){
			$response["data"] = $db -> getPassword($idAccount);
			return json_encode($response);
		}else{
			$reponse["result"] = 'fail parameters';
			$respone["messsage"] = "Inserted fail parameters";
			return json_encode($response);
		}
	}



	public function updateAccount($idAccount , $data){
		$db = $this->db;
		//check exist id
		$result = $db -> updateDataAccount($data , $idAccount);
		if($result){
			$response["result"] = "Success";
			$response["message"] = "Inserted Successfully";
		}else{
			$response["result"] = "fail";
			$response["message"] = "Database Error";
		}
		return json_encode($response);		
	}

	public function deleteAccount($idAccount){
		$db = $this->db;

		$result = $db -> deleteDataAccount($idAccount);
		if($result){
			$response["result"] = "Success";
			$response["message"] = "Delete Successfully";
		}else{
			$response["result"] = "fail";
			$response["message"] = "Database Error";
		}
		return json_encode($response);
	}

	public function updateCategory($idCategory , $data){
		$db = $this ->db;

		$result = $db->updateDataCategory($data , $idCategory);
		if($result){
			$response["result"] = "Success";
			$response["message"] = "Update Category Successfully";
		}else{
			$response["result"] = "fail";
			$response["message"] = "Database Error";
		}
		return json_encode($response);	
	}

	public function deleteCategory($idCategory){
		$db = $this->db;

		$result = $db -> deleteDataCategory($idCategory);
		if($result){
			$response["result"] = "Success";
			$response["message"] = "Delete Category Successfully";
		}else{
			$response["result"] = "fail";
			$response["message"] = "Database Error";
		}
		return json_encode($response);
	}
}
	
?>