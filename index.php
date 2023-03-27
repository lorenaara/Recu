<? 
require './cofig/configuracion';

$recursos = controladorPadre::recurso();

if($recursos){
    switch ($recursos[1]) {
        case 'usuario':
            $userC = new UsuarioController();
            $userC->controlar();
            break;   
        case 'rol':
            $rolC = new RolController();
                 
        default:
            controladorPadre::respuesta('',  array('HTTP/1.1 400 No ha utilizado un recurso correcto'));
            break;
    }
}