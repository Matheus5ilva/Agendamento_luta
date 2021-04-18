<?php

use Sistema\Model\User;
use \Sistema\Page;

$app->get('/', function() {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("index");

});

$app->get('/login', function() {

	$page = new Page();

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

	$page = new Page();

	$page->setTpl("forgot");	

});

$app->post("/forgot", function(){

	$user = User::getForgot($_POST["email_user"]);

	header("Location: /forgot/sent");
	exit;

});

$app->get("/forgot/sent", function(){

	$page = new Page();

	$page->setTpl("forgot-sent");	

});


$app->get("/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new Page();

	$page->setTpl("forgot-reset", array(
		"name"=>$user["name_user"],
		"code"=>$_GET["code"]
	));

});

$app->post("/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	


	User::setFogotUsed($forgot["id_recovery"]);

	$user = new User();

	$user->get($forgot["id_user"]);

	$password = $_POST['password_user'] = password_hash($_POST["password_user"], PASSWORD_DEFAULT, [
        "cost" => 12
      ]);

	$user->setPassword($password);

	$page = new Page();

	$page->setTpl("forgot-reset-success");

});
