<?php
if (!isset($LIB_USER)) {
$LIB_USER;


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

////////////////////////////// User Helpers //////////////////////////////

function UserExists($conn, int $id_user): bool {
	$sql = "SELECT id_user FROM Usuarios WHERE id_user = '". $id_user . "';";
	$user_result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($user_result) == 0)
		return false;
	else
		return true;
};


function UsernameExists($conn, string $username): bool {
	$sql = "SELECT username FROM Usuarios WHERE username = '". $username . "';";
	$username_result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($username_result) == 0)
		return false;
	else
		return true;
};


function EmailExists($conn, string $email_user): bool {
	$sql = "SELECT email_user FROM Usuarios WHERE username = '". $email_user . "';";
	$email_result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($email_result) == 0)
		return false;
	else
		return true;
};

function ValidateUserPassword($conn, int $id_user, string $password): bool {
	$sql = "SELECT id_user, senha_hash FROM Usuarios WHERE id_user = '"
		. $id_user . "';";
	$user_result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($user_result) == 0)
		return false;

	$row = mysqli_fetch_assoc($user_result);

	if (password_verify($password, $row["senha_hash"]))
		// echo "{\"result\": ':D'}";
		return true;
	else
		// echo "{\"result\": '>:('}";
		return false;


	return false;
};


function User_owns_Email($conn, int $id_user, string $email): bool {
	$sql = "SELECT id_user, email_user FROM `Usuarios` WHERE id_user = '"
		. $id_user . "';";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) == 0)
		// die("aaaaaaaaaaa");
		return false;

	$row = mysqli_fetch_assoc($result);

	if ($row["email_user"] == $email)
			return true;
	else
		return false;


	return false;
};


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

///////////////////////////// Derefence Users /////////////////////////////


function Drf_Email_to_User($conn, string $email): int {
	$sql = "SELECT id_user, email_user FROM `Usuarios`
		WHERE email_user = '" . $email . "';";
	$email_result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($email_result) == 0)
		return 0;

	$row = mysqli_fetch_assoc($email_result);

	return $row["id_user"];
};


function Drf_Username_to_User($conn, string $email): string {
	$sql = "SELECT id_user, username FROM `Usuarios`
		WHERE username = '" . $username . "';";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($email_result) == 0)
		return NULL;

	$row = mysqli_fetch_assoc($result);

	return $row["id_user"];
};



//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

/////////////////////////////// CRUD Users ///////////////////////////////

function CreateUser($conn, string $username, string $email, string $password): int {
	if (UsernameExists($username))
		return -4;

	if (EmailExists($email))
		return -5;

	$pass_hash = password_hash(
		$password, PASSWORD_ARGON2I,
		["memory_cost" => 64, "time_cost" => 40, "threads" => 2]);

	$sql =
	"INSERT INTO `Usuarios`
		(username, email_user, senha_hash) VALUES
		(\"". $username ."\", \"". $email ."\", \"". $pass_hash ."\";";

	if (! mysqli_query($conn, $sql))
		return -1;
	else
		return 0;
};


// Read placeholder


function UpdateUser($conn, int $id_user, string $username, string $email, string $password): int {
	if (! UserExists($username))
		return -3;

	if (! UsernameExists($username))
		return -4;

	if (! EmailExists($email))
		return -5;

	if (! ValidateUserPassword($id_user, $password))
		return -6;

	$pass_hash = password_hash(
		$password, PASSWORD_ARGON2I,
		["memory_cost" => 64, "time_cost" => 40, "threads" => 2]);

	$sql =
	"UPDATE `Usuarios` SET
		username = \"". $username ."\",
		email_user = \"". $email ."\",
		senha_hash = \"". $pass_hash ."\"
	WHERE id_user = \"". $id_user ."\";";

	if (! mysqli_query($conn, $sql))
		return -1;
	else
		return 0;

};


function DeleteUser($conn, int $id_user): int {
	if (! UserExists($username))
		return -4;

	if ($id_user == 0)
		return -1;
	else
		$sql =
		"DELETE FROM `Usuarios`
		WHERE id_user = \"". $id_user ."\";";

	if (! mysqli_query($conn, $sql))
		return -1;
	else
		return 0;

};


};

?>
