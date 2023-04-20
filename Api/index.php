<? 
require './config/configuracion.php';

$recursos = controladorPadre::recurso();

if($recursos){
    switch ($recursos[1]) {
        case 'usuario':
            $userC = new UsuarioController();
            $userC->controlar();
            break;   
        case 'rol':
            $rolC = new RolController();
            $rolC->controlar();
            break;
        case 'tipoClase':
            $tipoClaseC = new TipoClaseController();
            $tipoClaseC->controlar();
            break;
        case 'asiste':
            $asisteC = new AsisteController();
            $asisteC->controlar();
            break;
        case 'acude':
            $acudeC= new AcudeController();
            $acudeC->controlar();
            break;
        case 'evento':
            $eventoC= new EventoController();
            $eventoC->controlar();
            break;
        case 'rutina':
            $rutinaC = new RutinaController();
            $rutinaC->controlar();
            break;
        case 'contiene':
            $contieneC = new ContieneController();
            $contieneC->controlar();
            break;
        case 'ejercicio':
            $ejercicioC = new EjercicioController();
            $ejercicioC->controlar();
            break;    
        case 'clase':
            $claseC= new ClaseController();
            $claseC->controlar();
            break;
        default:
            controladorPadre::respuesta('',  array('HTTP/1.1 400 No ha utilizado un recurso correcto'));
            break;
    }
}