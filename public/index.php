<?php 
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/ClassObjectCreateController.php";
require_once "../controllers/TypeObjectCreateController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$title ="";
$template = "";

$contex = [];

$pdo = new PDO("mysql:host=localhost;dbname=team_f;charset=utf8", "root", "");


$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/heroes_tf/(?P<id>\d+)", ObjectController::class);
$router->add("/search", SearchController::class);
$router->add("/create", ClassObjectCreateController::class);
$router->add("/create_type", TypeObjectCreateController::class);

$router->get_or_default(Controller404::class);



