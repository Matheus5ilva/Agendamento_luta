<?php

namespace Sistema\Model;

use \Sistema\DB\Sql;
use \Sistema\Model;
use \Sistema\Mailer;

class User extends Model
{

	const SESSION = "User";
	const SECRET = "SistemaPhp7_Secret";
	const SECRET_IV = "SistemaPhp7_Secret_IV";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

	public static function getFromSession()
	{

		$user = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['id_user'] > 0) {

			$user->setData($_SESSION[User::SESSION]);
		}

		return $user;
	}

	public static function checkLogin($type_user = true)
	{

		if (
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["id_user"] > 0
		) {
			//Não está logado
			return false;
		} else {

			if ($type_user === true && (bool)$_SESSION[User::SESSION]['type_user'] === true) {

				return true;
			} else if ($type_user === false) {

				return true;
			} else {

				return false;
			}
		}
	}

	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_user WHERE email_user = :LOGIN", array(
			":LOGIN" => $login
		));

		if (count($results) === 0) {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}

		$data = $results[0];

		if (password_verify($password, $data["password_user"]) === true) {

			$user = new User();

			$data['name_user'] = utf8_encode($data['name_user']);

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;
		} else {
			throw new \Exception("Usuário inexistente ou senha inválida.");
		}
	}

	public function verifyEmail($email)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_user WHERE email_user = :email", [
			":email" => $email
		]);

		if (count($results) > 0) {
			return true;
		}
		return false;
	}

	public static function verifyLogin()
	{

		if (
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["id_user"] > 0
		) {
			header("Location: /login");
			exit;
		}
	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;
	}

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_user ORDER BY name_user");
	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_user_save(:name_user, :email_user, :password_user, :phone_user, :type_user)", array(
			":name_user" => utf8_decode($this->getname_user()),
			":email_user" => $this->getemail_user(),
			":password_user" => $this->getpassword_user(),
			":phone_user" => $this->getphone_user(),
			":type_user" => $this->gettype_user()
		));

		$this->setData($results[0]);
	}

	public function get($iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_user  WHERE id_user = :iduser", array(
			":iduser" => $iduser
		));

		$data = $results[0];

		$data['name_user'] = utf8_encode($data['name_user']);


		$this->setData($data);
	}

	public function update()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_userupdate_save(:id_user, :name_user, :email_user, :phone_user, :type_user)", array(
			":id_user" => $this->getid_user(),
			":name_user" => utf8_decode($this->getname_user()),
			":email_user" => $this->getemail_user(),
			":phone_user" => $this->getphone_user(),
			":type_user" => $this->gettype_user()
		));

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_user WHERE id_user = :id_user", array(
			":id_user" => $this->getid_user()
		));
	}

	public static function getForgot($email)
	{

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_user a 
			WHERE a.email_user = :email;
		", array(
			":email" => $email
		));

		if (count($results) === 0) {

			throw new \Exception("Não foi possível recuperar a senha.");
		} else {

			$data = $results[0];

			$results2 = $sql->select("CALL sp_userpasswordsrecoveries_create(:iduser, :desip)", array(
				":iduser" => $data['id_user'],
				":desip" => $_SERVER['REMOTE_ADDR']
			));

			if (count($results2) === 0) {

				throw new \Exception("Não foi possível recuperar a senha.");
			} else {

				$dataRecovery = $results2[0];



				$code = openssl_encrypt($dataRecovery['id_recovery'], 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

				$code = base64_encode($code);

				$link = "http://www.academia.com.br/forgot/reset?code=$code";



				$mailer = new Mailer($data['email_user'], $data['name_user'], "Redefinir senha da Maynart Sport Center", "forgot", array(
					"name" => $data['name_user'],
					"link" => $link
				));

				$mailer->send();

				return $link;
			}
		}
	}

	public static function validForgotDecrypt($code)
	{

		$code = base64_decode($code);

		$idrecovery = openssl_decrypt($code, 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_userpasswordsrecoveries a
			INNER JOIN tb_user b USING(id_user)
			WHERE
				a.id_recovery = :idrecovery
				AND
				a.dtrecovery IS NULL
				AND
				DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
			":idrecovery" => $idrecovery
		));

		if (count($results) === 0) {
			throw new \Exception("Não foi possível recuperar a senha.");
		} else {

			return $results[0];
		}
	}

	public static function setFogotUsed($idrecovery)
	{

		$sql = new Sql();

		$sql->query("UPDATE tb_userpasswordsrecoveries SET dtrecovery = NOW() WHERE id_recovery = :idrecovery", array(
			":idrecovery" => $idrecovery
		));
	}

	public function setPassword($password)
	{

		$sql = new Sql();

		$sql->query("UPDATE tb_user SET password_user = :password WHERE id_user = :iduser", array(
			":password" => $password,
			":iduser" => $this->getid_user()
		));
	}

	public static function pagamento($iduser, $idclass){

		$sql = new Sql();

		return $sql->select("SELECT a.pagamento FROM tb_pagamento a WHERE a.id_aluno = :iduser AND a.id_class = :idclass",[
			":iduser" => $iduser,
			":idclass" => $idclass
		]);
	}


	public static function setError($msg)
	{

		$_SESSION[User::ERROR] = $msg;
	}

	public static function getError()
	{

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		User::clearError();

		return $msg;
	}

	public static function clearError()
	{

		$_SESSION[User::ERROR] = NULL;
	}

	public static function setSuccess($msg)
	{

		$_SESSION[User::SUCCESS] = $msg;
	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		User::clearSuccess();

		return $msg;
	}

	public static function clearSuccess()
	{

		$_SESSION[User::SUCCESS] = NULL;
	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[User::ERROR_REGISTER] = $msg;
	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

		User::clearErrorRegister();

		return $msg;
	}

	public static function clearErrorRegister()
	{

		$_SESSION[User::ERROR_REGISTER] = NULL;
	}

	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin", [
			':deslogin' => $login
		]);

		return (count($results) > 0);
	}

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost' => 12
		]);
	}

	public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_users a 
			INNER JOIN tb_persons b USING(idperson) 
			ORDER BY b.desperson
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int)$resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];
	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_users a 
			INNER JOIN tb_persons b USING(idperson)
			WHERE b.desperson LIKE :search OR b.desemail = :search OR a.deslogin LIKE :search
			ORDER BY b.desperson
			LIMIT $start, $itemsPerPage;
		", [
			':search' => '%' . $search . '%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data' => $results,
			'total' => (int)$resultTotal[0]["nrtotal"],
			'pages' => ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];
	}
}
