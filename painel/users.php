<?php

use \Sistema\Page;
use \Sistema\Model\User;

$app->get("/users/:iduser/password", function ($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new Page();

	$page->setTpl("users-password", [
		"user" => $user->getValues(),
		"msgError" => User::getError(),
		"msgSuccess" => User::getSuccess()
	]);
});

$app->post("/users/:iduser/password", function ($iduser) {

	User::verifyLogin();

	if (!isset($_POST['password_user']) || $_POST['password_user'] === '') {

		User::setError("Preencha a nova senha.");
		header("Location: /users/$iduser/password");
		exit;
	}

	if (!isset($_POST['password_user-confirm']) || $_POST['password_user-confirm'] === '') {

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

	$user->setPassword(User::getPasswordHash($_POST['password_user']));

	User::setSuccess("Senha alterada com sucesso.");

	header("Location: /users/$iduser/password");
	exit;
});


$app->get("/users", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("users", array(
		"users" => User::listAll()
	));
});

$app->get("/users/create", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("users-create");
});

$app->get("/users/:iduser/delete", function ($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /users");
	exit;
});

$app->get("/users/:iduser", function ($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new Page();

	$page->setTpl("users-update", array(
		"user" => $user->getValues()
	));
});

$app->post("/users/create", function () {

	User::verifyLogin();

	$user = new User();

	$_POST["type_user"] = (isset($_POST["type_user"])) ? 1 : 0;

	$_POST['password_user'] = password_hash($_POST["password_user"], PASSWORD_DEFAULT, [
		"cost" => 12
	]);

	$user->setData($_POST);

	$user->save();

	header("Location: /users");
	exit;
});

$app->post("/users/:iduser", function ($iduser) {

	User::verifyLogin();

	$user = new User();

	$_POST["type_user"] = (isset($_POST["type_user"])) ? 1 : 0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /users");
	exit;
});





$app->get("/users/:iduser/payment", function ($iduser) {

	User::verifyLogin();

	$professor = $_SESSION['User']['name_user'];
	$idprofessor = $_SESSION['User']['id_user'];

	$user = new User();

	$user->get((int)$iduser);

	$page = new Page();

	$page->setTpl("users-payment", [
		"professor" => $professor,
		"idprofessor" => $idprofessor,
		"aulas" => User::getLessonPayment($idprofessor),
		"user" => $user->getValues(),
		"msgError" => User::getError(),
		"msgSuccess" => User::getSuccess()
	]);
});

$app->post("/users/:iduser/payment", function ($iduser) {

	User::verifyLogin();

	if (!isset($_POST['id_class']) || $_POST['id_class'] === '') {

		User::setError("Escolha uma aula.");
		header("Location: /users/$iduser/payment");
		exit;
	}

	$user = new User();

	$user->get((int)$iduser);

	$_POST["pagamento"] = (isset($_POST["pagamento"])) ? 1 : 0;

	$user->devendoPagamento($_POST['id_user'], $_POST['id_class'], $_POST['pagamento']);

	if ($_POST['pagamento'] == 1) {
		User::setSuccess("Aluno foi adicionado como inadimplente.");
	}if($_POST['pagamento'] == 0){
		User::setSuccess("Aluno foi retirado da inadimplência.");
	}

	header("Location: /users/$iduser/payment");
	exit;
});
