<?php

namespace Sistema\Model;

use \Sistema\DB\Sql;
use \Sistema\Model;
use \Sistema\Model\Date;
use \Sistema\Mailer;

class Quedas extends Model
{
    
    public static function list($iduser){
        $sql = new Sql();

		return $sql->select("SELECT * FROM tb_check_in a 
        INNER JOIN tb_date_hour b ON a.id_date = b.id_date
        INNER JOIN tb_class c ON c.id_class = a.id_class WHERE a.id_user = :iduser",[
            ":iduser" => $iduser
        ]);
	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_checkin_save(:iduser, :idclass, :iddate)", array(
			":iduser" => $this->getid_user(),
			":idclass" => $this->getid_class(),
			":iddate" => $this->getid_date()
        ));

		$this->setData($results[0]);
    }
    
    public function qtdCheckin($iddate){
        
        $sql = new Sql();
        
        return $sql->select("select COUNT(*) from tb_check_in WHERE id_date = :iddate", array(
			":iddate" => $iddate
		));

    }

	public function get($idclass)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_class WHERE id_class = :idclass", [
			':idclass' => $idclass
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_check_in WHERE id_check_in = :id_check_in", [
			':id_check_in' => $this->getid_check_in()
		]);
	}

	public function getDate($related = true)
	{

		$sql = new Sql();

		if ($related === true) {

			return $sql->select("
				SELECT * FROM tb_date_hour WHERE date_class >= curdate() AND id_date IN(
					SELECT a.id_date
					FROM tb_date_hour a
					INNER JOIN tb_date_hour_class b ON a.id_date = b.id_date
					WHERE b.id_class = :id_class
				) ORDER BY date_class;
			", [
				':id_class' => $this->getid_class()
			]);
		} else {

			return $sql->select("
				SELECT * FROM tb_date_hour WHERE date_class >= curdate() AND id_date NOT IN(
					SELECT a.id_date
					FROM tb_date_hour a
					INNER JOIN tb_date_hour_class b ON a.id_date = b.id_date
					WHERE b.id_class = :id_class
				) ORDER BY date_class;
			", [
				':id_class' => $this->getid_class()
			]);
		}
	}

	public static function qtdLutas($iduser){

		$sql = new Sql();

		return $sql->select("SELECT SUM(qtd_lutas) as qtd_lutas FROM tb_check_in where id_user = :iduser",[
			":iduser" => $iduser
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


}
