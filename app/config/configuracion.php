<?
define('URLAPI', 'http://192.168.2.209/Recu/Api/index.php/');
require './peticiones/curl.php';
$controller=array(
    'login'=>'./controller/loginController.php',
    'registro'=>'./controller/registroController.php',
    'home'=> './controller/homeController.php'
);

//vistas
$vistas =array(
    'home'=>'homeView.php',
    'login'=>'loginView.php',
    'registro'=>'registrarseView.php',
    'clase'=>'clasesView.php'
);