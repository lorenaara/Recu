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
        $_SESSION['controller']=$controller['clase'];
        $_SESSION['vista']=$vistas['clase'];
    }elseif(isset($_REQUEST['logout'])){
        session_destroy();
    }elseif(isset($_REQUEST['evento'])){
        $_SESSION['controller']=$controller['evento'];
        $_SESSION['vista']=$vistas['evento'];
    }elseif(isset($_REQUEST['rutina'])){
        $_SESSION['controller']=$controller['rutina'];
        $_SESSION['vista']=$vistas['rutina'];
    }elseif(isset($_REQUEST['ejercicio'])){
        $_SESSION['controller']=$controller['ejercicio'];
        $_SESSION['vista']=$vistas['ejercicio'];
    }elseif(isset($_REQUEST['modClase'])){
        $_SESSION['controller']=$controller['clase'];
        $_SESSION['vista']=$vistas['modClase'];
    }
}
require $_SESSION['controller'];
//si no te lleva a la pagina de la session
require './view/layout.php';