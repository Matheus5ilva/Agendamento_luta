<?php

use Sistema\Model\Date;
use \Sistema\Page;
use \Sistema\Model\User;
use \Sistema\Model\Lesson;


$app->get("/class", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("classes", array(
		"class" => Lesson::listAll()
	));
});

$app->get("/class/create", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("classes-create");
});

$app->post("/class/create", function () {

	User::verifyLogin();

	$class = new Lesson();

	$class->setData($_POST);

	$class->save();

	header('Location: /class');
	exit;
});

$app->get("/class/:idclass/delete", function ($idclass) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$class->delete();

	header("Location: /class");
	exit;
});

$app->get("/class/:idclass/", function ($idclass) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$page = new Page();

	$page->setTpl("classes-update", array(
		"class" => $class->getValues()
	));
});

$app->post("/class/:idclass", function ($idclass) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$class->setData($_POST);

	$class->save();

	header("Location: /class");
	exit;
});

// DATA - TIME

$app->get("/date", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("date-hour", array(
		"date" => Date::listAll()
	));
});

$app->get("/date/create", function () {

	User::verifyLogin();

	$page = new Page();

	$page->setTpl("date-create", [
		'error' => Date::getError()
	]);
});

$app->post("/date/create", function () {

	User::verifyLogin();

	if ($_POST['date_class'] < date('Y-m-d')) {

		Date::setError("Data inserida já passou.");
		header("Location: /date/create");
		exit;
	}
	$date = new Date();

	$date->setData($_POST);

	$date->save();

	header('Location: /date');
	exit;
});

$app->get("/date/:iddate/delete", function ($iddate) {

	User::verifyLogin();

	$date = new Date();

	$date->get((int)$iddate);

	$date->delete();

	header("Location: /date");
	exit;
});

// CLASS / TIME

$app->get("/class/:idclass/date", function ($idclass) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$page = new Page();

	$page->setTpl("class-datetime", [
		'class' => $class->getValues(),
		'dateRelated' => $class->getDate(),
		'dateNotRelated' => $class->getDate(false)
	]);
});

$app->get("/class/:idclass/date/:iddate/add", function ($idclass, $iddate) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$date = new Date();

	$date->get((int)$iddate);

	$class->addDate($date);

	header("Location: /class/" . $idclass . "/date");
	exit;
});

$app->get("/class/:idclass/date/:iddate/remove", function ($idclass, $iddate) {

	User::verifyLogin();

	$class = new Lesson();

	$class->get((int)$idclass);

	$class->removeDate($iddate);

	header("Location: /class/" . $idclass . "/date");
	exit;
});
