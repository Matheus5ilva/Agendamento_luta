<?php

namespace Sistema\Model;

use \Sistema\DB\Sql;
use \Sistema\Model;
use \Sistema\Model\Date;
use \Sistema\Mailer;

class Lesson extends Model
{

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_class");
	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_class_save(:idclass, :iduser, :name_class, :qtd)", array(
			":idclass" => $this->getid_class(),
			":iduser" => $this->getid_user(),
			":name_class" => $this->getname_class(),
			":qtd" => $this->getqtd()
		));

		$this->setData($results[0]);
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

		$sql->query("DELETE FROM tb_class WHERE id_class = :id_class", [
			':id_class' => $this->getid_class()
		]);
	}

	public function getDate($related = true)
	{

		$sql = new Sql();

		if ($related === true) {

			return $sql->select("
			SELECT a.id_date, a.date_class, a.hour_class, b.id_date_hour_class FROM tb_date_hour a 
			LEFT JOIN tb_date_hour_class b ON a.id_date = b.id_date
			WHERE a.date_class >= curdate() AND a.id_date IN(
					SELECT a.id_date
					FROM tb_date_hour a
					INNER JOIN tb_date_hour_class b ON a.id_date = b.id_date
					WHERE b.id_class = :id_class
				)GROUP BY id_date 
				ORDER BY date_class;
			", [
				':id_class' => $this->getid_class()
			]);
		} else {

			return $sql->select("
			SELECT a.id_date, a.date_class, a.hour_class, b.id_date_hour_class FROM tb_date_hour a 
			LEFT JOIN tb_date_hour_class b ON a.id_date = b.id_date
			WHERE a.date_class >= curdate() AND a.id_date NOT IN(
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

	public function addDate(Date $date)
	{
		$iduser = $_SESSION['User']['id_user'];

		$sql = new Sql();

		$sql->query("INSERT INTO tb_date_hour_class (id_date, id_class, id_user) VALUES(:id_date, :id_class,:id_user)", [
			':id_date' => $date->getid_date(),
			':id_class' => $this->getid_class(),
			':id_user' => $iduser
		]);
	}

	public function removeDate($iddate_hour)
	{

		$iduser = $_SESSION['User']['id_user'];

		$sql = new Sql();

		$sql->query("DELETE FROM tb_date_hour_class WHERE id_date_hour_class = :id_date_hour_class AND id_class = :id_class  AND id_user = :id_user", [
			":id_date_hour_class" => $iddate_hour,
			':id_class' => $this->getid_class(),
			':id_user' => $iduser
		]);
	}

	// public static function listLesson($iduser){

	// 	$sql = new Sql();

	// 	return $sql->select("SELECT * FROM tb_date_hour_class a 
	// 	INNER JOIN tb_date_hour b ON a.id_date = b.id_date
	// 	INNER JOIN tb_class c ON a.id_class = c.id_class
	// 	WHERE a.id_user = :iduser AND b.date_class = curdate()",[
	// 		":iduser" => $iduser
	// 	]);
	// }

	public static function listLesson($iduser){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_date_hour_class a 
		INNER JOIN tb_date_hour b ON a.id_date = b.id_date
		INNER JOIN tb_class c ON a.id_class = c.id_class
		WHERE a.id_user = :iduser AND b.date_class = curdate()",[
			":iduser" => $iduser
		]);
	}

	

	public static function listHour($iduser){

		$sql = new Sql();

		return $sql->select("SELECT a.id_date_hour_class, c.id_date,c.date_class, c.hour_class, b.id_check_in, b.id_user, b.id_class, d.name_user FROM tb_date_hour_class a 
		INNER JOIN tb_check_in b ON a.id_date_hour_class = b.id_date_hour_class
		INNER JOIN tb_date_hour c ON a.id_date = c.id_date
        INNER JOIN tb_user d ON b.id_user = d.id_user
		WHERE a.id_user = :iduser
        order by c.hour_class",[
			":iduser" => $iduser
		]);
		
	}

	// public static function listAluno($iduser, $hour, $idclass){

	// 	$sql = new Sql();

	// 	return $sql->select("SELECT a.id_check_in, a.id_user, a.id_date, b.date_class, b.hour_class, c.name_class, c.id_user, d.id_user, d.name_user FROM tb_check_in a 
	// 	INNER JOIN tb_date_hour b ON a.id_date = b.id_date
	// 	INNER JOIN tb_class c ON a.id_class = c.id_class
	// 	INNER JOIN tb_user d ON a.id_user = d.id_user
	// 	INNER JOIN tb_date_hour_class e ON a.id_date = e.id_date
	// 	WHERE b.date_class = curdate() AND b.hour_class = :hour AND c.id_class = :idclass and e.id_user = :iduser",[
	// 		":iduser" => $iduser,
	// 		":hour" => $hour,
	// 		":idclass" => $idclass
	// 	]);
	// }

}




?>
