<?

require './config/configuracion.php';



session_start();

//si es la primera vez no hay nada en session
//home
if(!isset($_SESSION['vista'])){
    $_SESSION['controller']=$controller['home'];
    $_SESSION['vista']=$vistas['home'];
}else{
    //si vas a login
    if(isset($_REQUEST['login'])){
        $_SESSION['controller']=$controller['login'];
        $_SESSION['vista']=$vistas['login'];
        //si le das a home
    }elseif(isset($_REQUEST['home'])){
        $_SESSION['controller']=$controller['home'];
        $_SESSION['vista']=$vistas['home'];
    }elseif(isset($_REQUEST['registro'])){
        $_SESSION['controller']=$controller['registro'];
        $_SESSION['vista']=$vistas['registro'];
    }elseif(isset($_REQUEST['clase'])){
        $_SESSION['vista']=$vistas['clase'];
    }
}
require $_SESSION['controller'];
//si no te lleva a la pagina de la session
require './view/layout.php';