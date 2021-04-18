<?php

use \Sistema\Page;
use \Sistema\Model\User;

$app->get('/checkin', function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("index");
});

$app->get('/login', function () {

	$page = new Page(
		[
			"header" => false,
			"footer" => false
		]
	);

	$page->setTpl("login", [
        'error' => User::getError()
    ]);
});

$app->post('/login', function() {
	try {
        User::login($_POST["email_user"], $_POST["password_user"]);
    } catch (Exception $e) {
        User::setError($e->getMessage());
	}
	
	header("Location: /");
	exit;

});

$app->get('/logout', function() {

	User::logout();

	header("Location: /login");
	exit;

});

$app->get("/forgot", function() {

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});

$app->post("/forgot", function(){

	$user = User::getForgot($_POST["email"]);

	header("Location: /forgot/sent");
	exit;

});

$app->get("/forgot/sent", function(){

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});


$app->get("/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setFogotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");

});
