<?php 

use \Sistema\Page;
use \Sistema\Model\User;

$app->get("/users/:iduser/password", function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new Page();

	$page->setTpl("users-password", [
		"user"=>$user->getValues(),
		"msgError"=>User::getError(),
		"msgSuccess"=>User::getSuccess()
	]);

});

$app->post("/users/:iduser/password", function($iduser){

    User::verifyLogin();

	if (!isset($_POST['password_user']) || $_POST['password_user']==='') {

		User::setError("Preencha a nova senha.");
		header("Location: /users/$iduser/password");
		exit;

	}

	if (!isset($_POST['password_user-confirm']) || $_POST['password_user-confirm']==='') {

		User::setError("Preencha a confirmação da nova senha.");
		header("Location: /users/$iduser/password");
		exit;

	}

	if ($_POST['password_user'] !== $_POST['password_user-confirm']) {

		User::setError("Confirme corretamente as senhas.");
		header("Location: /users/$iduser/password");
		exit;

	}

	$user = new User();

	$user->get((int)$iduser);

	$_POST['password_user'] = password_hash($_POST["password_user"], PASSWORD_DEFAULT, [
        "cost" => 12
      ]);
	User::setSuccess("Senha alterada com sucesso.");

	header("Location: /users/$iduser/password");
	exit;

});

$app->get("/users/create", function() {

	$page = new Page();

	$page->setTpl("users-create",[
		"msgError"=>User::getError()
	]);

});

$app->get("/users/:iduser/delete", function($iduser) {

	User::verifyLogin();	

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /users");
	exit;

});

$app->get("/users/:iduser", function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new Page();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));

});

$app->post("/users/create", function() {

	if(User::verifyEmail($_POST['email_user']) == true){
        User::setError("E-mail já cadastrado.");
		header('Location: /users/create');
		exit;
    }
	$user = new User();

	$_POST['password_user'] = password_hash($_POST["password_user"], PASSWORD_DEFAULT, [
        "cost" => 12
      ]);

	$user->setData($_POST);

	
    $user->save();
    
    User::login($_POST['email_user'], $_POST['password_user']);

	header("Location: /");
	exit;

});

$app->post("/users/:iduser", function($iduser) {

    User::verifyLogin();
    
	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();	

	header("Location: /");
	exit;

});
