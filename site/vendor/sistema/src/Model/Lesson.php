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

	public static function list($idclass){
		
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_class WHERE id_class = :idclass",[
			":idclass" => $idclass
		]);
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

	public static function dateLesson($idclass){
		$sql = new Sql();

		return $sql->select("Select * from tb_date_hour a INNER JOIN tb_date_hour_class b ON a.id_date = b.id_date 
		INNER JOIN tb_class c ON b.id_class = c.id_class
        INNER JOIN tb_user d ON b.id_user = d.id_user
		WHERE c.id_class = :idclass AND date_class >= curdate()", [
			':idclass' => $idclass
		]);
	}

	// public static function dateLesson($idclass){
	// 	$sql = new Sql();

	// 	return $sql->select("Select * from tb_date_hour a INNER JOIN tb_date_hour_class b ON a.id_date = b.id_date 
	// 	INNER JOIN tb_class c ON b.id_class = c.id_class
    //     INNER JOIN tb_user d ON b.id_user = d.id_user
	// 	WHERE c.id_class = :idclass", [
	// 		':idclass' => $idclass
	// 	]);
	// }

}

?>
