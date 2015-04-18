<?php
// lol 2
session_start();
// on appel le model et le controleur principal et on se connecte a la bdd
require('config/db_connect.php');
require('core/model.php');
require('core/controller.php');

define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])); // racine du site
define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME'])); // chemin physique du fichier (ex : c://wamp/www/....)
define('CTR_ROOT', $_SERVER["PHP_SELF"].'?'.Controller::getController().'/'); // chemin vers le controller (ex : index.php?p=controller)



$params = explode('/',$_GET['p']); // on recupere les infos dans la barre de navigation en séparant les paramètres
$controller = $params[0]; // le premier parametre est le controller
$action =isset($params[1]) ? $params[1] : 'index'; // le second parametre c'est l'action, si il n'y en a pas on prend l'index


if(empty($_GET['p'])){ // si pas de controler en parametre
	$controller = 'accueil'; // c'est la page d'accueil
	header("location:".WEBROOT.$controller);
}


if(file_exists(ROOT.'controllers/'.$controller.'.php')){ // si le fichier du controleur existe
	require(ROOT.'controllers/'.$controller.'.php'); // on recupere le controleur
	$controller = new $controller(); // on créer une instance de ce controleur
	if(method_exists($controller, $action)){ // si l'action existe dans ce controleur
		unset($params[0]); unset($params[1]); // on enleve les 2 premiers paramètres qui correspondent au controleur et a l'action
		call_user_func_array(array($controller, $action),$params);// on appelle l'action dans ce controller et tous les paramètre s'il y en a
	}
	else{
		$ctr=new Controller(); //sinon on utilise le controller générale
		$ctr->error404(); // on appel la fonction qui gère les erreurs 404
	}
}
else{
	$ctr=new Controller();
	$ctr->error404();
	}


?>
