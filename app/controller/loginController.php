<?

if(isset($_REQUEST['registro'])){
   $_SESSION['vista']=$vistas['registro'];
}else{
    if(isset($_REQUEST['enviar'])){
        $nombre= $_REQUEST['nombre'];
        $pass= $_REQUEST['pass'];
        if(empty($nombre)){
            $_SESSION['error']='Debe rellenar el nombre';
        }elseif(empty($pass)){
            $_SESSION['error']='Debe rellenar la contraseña';
        }else{
            $arrayUsuario=array(
                'nombre'=>$nombre,
                'clave'=>$pass
            );
            $usuario= Curl::getFiltro('usuario', $arrayUsuario);
            //si el usuari contiene datos 
           if($usuario!=null){
            //meter en la session los datos 
            $usuario=json_decode($usuario);
            $_SESSION['id_user']=$usuario->idUser;
            $_SESSION['nombre']=$nombre;
            $_SESSION['id_rol']=$usuario->id_rol;
            
           //controlador y vista de la pagina usuario
           }else{
            $_SESSION['error']='Error! Usuario o Contraseña incorrecto';
           }

           //si no usuari y clave mal, error y vuelta al login 
        }
    }
}