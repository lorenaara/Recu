<?

require './config/configuracion.php';



session_start();

//si es la primera vez no hay nada en session
//home
if(!isset($_SESSION['vista'])){
    $_SESSION['vista']=$vistas['home'];
    //homeController
    require $_SESSION['controller'];
}else{
    //si vas a login
    if(isset($_REQUEST['login'])){
        $_SESSION['controller']=$controller['login'];
        $_SESSION['vista']=$vistas['login'];
        //si le das a home
    }elseif(isset($_REQUEST['home'])){
        $_SESSION['vista']=$vistas['home'];
    }elseif(isset($_REQUEST['registro'])){
        $_SESSION['controller']=$controller['registro'];
        $_SESSION['vista']=$vistas['registro'];
    }
    require $_SESSION['controller'];
}
//si no te lleva a la pagina de la session
require './view/layout.php';