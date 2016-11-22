<?php 

require_once 'Function.php';

$func = new Functions();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$data = json_decode(file_get_contents('php://input'));
	if(isset($data -> operation)){

		if($data->operation == 'getAll'){
			$result = $func -> getAll();
			echo $result;
		}else if($data->operation == 'getAccounts'){
			$category = $data->data->name_category;
			$result = $func -> getAccounts($category);
			echo $result;
		}else if($data->operation == 'getPassword'){
			$idAccount = $data->data->id_account;
			//echo $idAccount;
			$result = $func -> getPassword($idAccount);
			echo $result;
		}else if($data->operation == "createCategory"){
			$new_category = $data->data->new_category;
			$result = $func -> createCategory($new_category);
			echo $result;
		}else if($data->operation == "createAccount"){
			$new_account = $data->data->new_account;
			$id_category = $data->data->id_category;
			$result = $func -> createAccount($new_account , $id_category);
			 echo $result;
		}else if($data->operation == "updateAccount"){
			$id_account = $data->data->id_account;
			$new_account = $data->data->new_account;
			$result = $func -> updateAccount($id_account , $new_account);
			echo $result;
		}else if($data->operation == "deleteAccount"){
			$id_account = $data->data->id_account;
			$result = $func -> deleteAccount($id_account);
			echo $result;
		}else if($data->operation == "updateCategory"){
			$id_category = $data->data->id_category;
			$new_category = $data->data->new_category;
			$result = $func -> updateCategory($id_category , $new_category);
			echo $result;
		}else if($data->operation == "deleteCategory"){
			$id_category = $data->data->id_category;
			$result = $func->deleteCategory($id_category);
			echo $result;
		}
		// $operation = $data -> operation;
		// echo $func -> registerUser($name , $email , $password);
	}

}else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	//echo "webservice";	

	function Encrypt($password, $data)
	{

	    $salt = substr(md5(mt_rand(), true), 8);
	    $key = md5($password . $salt, true);
	    $iv  = md5($key . $password . $salt, true);
	    $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

	    return base64_encode('Salted__' . $salt . $ct);
	}

	echo(Encrypt('mypassword' , 'mydata'));


	function Decrypt($password, $data)
	{

	    $data = base64_decode($data);
	    $salt = substr($data, 8, 8);
	    $ct   = substr($data, 16);

	    $key = md5($password . $salt, true);
	    $iv  = md5($key . $password . $salt, true);

	    $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

	    return $pt;
	}

	echo ('</br>');
	echo(Decrypt('mypassword' , 'U2FsdGVkX1/a0n55TssEk7zUK6pX78BuaUIg1qYrbwY='));
}
	
?>