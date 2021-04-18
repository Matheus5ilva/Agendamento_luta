<?php

namespace Sistema\Model;

use \Sistema\DB\Sql;
use \Sistema\Model;
use \Sistema\Mailer;

class Date extends Model
{

	
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

	public static function listAll()
	{
		$sql = new Sql();

		return $sql->select("select * from tb_date_hour t
		where t.date_class >= curdate();");
		
	}

	public function save()
	{
		$sql = new Sql();

		$results = $sql->select("CALL sp_date_save(:date_class, :hour_class)", array(
			":date_class" =>$this->getdate_class(),
			":hour_class" => $this->gethour_class()
		));

		$this->setData($results[0]);
	}

	public static function setDate($iddate){
		if($iddate < date('%Y/%m/%d')){
			throw new \Exception("Essa data já passou.");
		}
		return false;
	}

	public function get($iddate)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_date_hour WHERE id_date = :iddate", [
			':iddate' => $iddate
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_date_hour WHERE id_date = :id_date", [
			':id_date' => $this->getid_date()
		]);
	}

	public static function setError($msg)
	{

		$_SESSION[Date::ERROR] = $msg;
	}

	public static function getError()
	{

		$msg = (isset($_SESSION[Date::ERROR]) && $_SESSION[Date::ERROR]) ? $_SESSION[Date::ERROR] : '';

		Date::clearError();

		return $msg;
	}

	public static function clearError()
	{

		$_SESSION[Date::ERROR] = NULL;
	}

	public static function setSuccess($msg)
	{

		$_SESSION[Date::SUCCESS] = $msg;
	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Date::SUCCESS]) && $_SESSION[Date::SUCCESS]) ? $_SESSION[Date::SUCCESS] : '';

		Date::clearSuccess();

		return $msg;
	}

	public static function clearSuccess()
	{

		$_SESSION[Date::SUCCESS] = NULL;
	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Date::ERROR_REGISTER] = $msg;
	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Date::ERROR_REGISTER]) && $_SESSION[Date::ERROR_REGISTER]) ? $_SESSION[Date::ERROR_REGISTER] : '';

		Date::clearErrorRegister();

		return $msg;
	}

	public static function clearErrorRegister()
	{

		$_SESSION[Date::ERROR_REGISTER] = NULL;
	}
}
