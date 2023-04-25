<?
define('URLAPI', 'http://192.168.2.209/Recu/Api/index.php/');
require './peticiones/curl.php';
$controller=array(
    'login'=>'./controller/loginController.php',
    'registro'=>'./controller/registroController.php',
    'home'=> './controller/homeController.php',
    'clase'=> './controller/clasesController.php',
    'evento'=>'./controller/eventoController.php',
    'rutina'=>'./controller/rutinaController.php',
    'ejercicio'=>'./controller/ejercicioController.php'
);

//vistas
$vistas =array(
    'home'=>'homeView.php',
    'login'=>'loginView.php',
    'registro'=>'registrarseView.php',
    'clase'=>'clasesView.php',
    'evento'=>'eventosView.php',
    'rutina'=>'rutinaView.php',
    'ejercicio'=>'ejercicioView.php',
    'modClase'=> 'modClase.php'
);