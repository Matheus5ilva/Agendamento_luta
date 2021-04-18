<?php

use Sistema\DB\Sql;
use Sistema\Model\Checkin;
use Sistema\Model\Lesson;
use Sistema\Model\Quedas;
use Sistema\Model\User;
use \Sistema\Page;

$app->get('/checkin', function () {

    User::verifyLogin();

    $page = new Page();

    $page->setTpl("checkin", [
        "class" => Lesson::listAll()
    ]);
});

$app->post('/checkin/:iduser', function ($iduser) {

    User::verifyLogin();

    $idclass = $_POST['id_class'];

    header('Location: /checkin/' . $iduser . '/' . $idclass . '/');
    exit;
});

$app->get("/checkin/:idcheckin/delete", function($idcheckin) {

	User::verifyLogin();	

    $iduser = $_SESSION['User']['id_user'];

	$checkin = new Checkin();

	$checkin->get((int)$idcheckin);

	$checkin->delete();

	header("Location: /list-lesson/$iduser");
	exit;

});


$app->get('/checkin/:iduser/:idclass/', function ($iduser, $idclass) {

    User::verifyLogin();
  
    $user = new User();

    $user->get((int)$iduser);

    $class = new Lesson();

    $class->get((int)$idclass);

    $page = new Page();

    $page->setTpl("checkin-create", [
        "class" => Lesson::list($idclass),
        "date" => Lesson::dateLesson($idclass),
        "lession" => $idclass,
        "msgError"=>Checkin::getError()
    ]);
});

$app->post('/checkin/:iduser/:idclass', function ($iduser, $idclass) {

    User::verifyLogin();
 
    $sql = new Sql();

    $iddate = $sql->select("SELECT id_date FROM tb_date_hour_class WHERE id_date_hour_class = :iddate",[
        ":iddate" => $_POST['id_date_hour_class']
    ]);

    if(User::pagamento($iduser, $idclass)[0]['pagamento'] == '1'){
        Checkin::setError("Você esta inadimplente com o professor.");
		header('Location: /checkin/'.$iduser.'/'.$idclass);
		exit;
    }

    if(Checkin::qtdCheckin($iddate[0]['id_date'])["0"]["COUNT(*)"] >= Checkin::qtd($idclass)[0]['qtd']){
        Checkin::setError("Aula com número de alunos completa.");
		header('Location: /checkin/'.$iduser.'/'.$idclass);
		exit;
    }
    
    $checkin = new CheckIn();

    $checkin->setData($_POST);

    $checkin->save();
    
    header('Location: /');
    exit;
});

$app->get('/list-lesson/:iduser', function($iduser){

    User::verifyLogin();

    $page = new Page();

    $page->setTpl("list-checkin", [
        "class" => Checkin::listUser($iduser)
    ]);

});

$app->get('/quedas/:iduser', function($iduser){

    User::verifyLogin();

    $page = new Page();

    $page->setTpl("quedas", [
        "class" => Checkin::listQuedas($iduser),
        "total" => Quedas::qtdLutas($iduser)[0]['qtd_lutas']
    ]);

});

$app->get('/quedas/:iduser/:idcheckin/create', function($iduser, $idcheckin){

    User::verifyLogin();

    $page = new Page();

    $page->setTpl("lutas-create",[
        "checkin" => Checkin::list($idcheckin)
    ]);

});

$app->post('/quedas/:iduser/:idcheckin/create', function($iduser, $idcheckin){

    User::verifyLogin();

    $checkin = new Checkin();

    $checkin->setData($_POST);

    $checkin->saveLuta();

	header("Location: /");
	exit;

});