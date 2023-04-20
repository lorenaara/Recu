<?
if(isset($_REQUEST['enviar'])){
    $nombre= $_REQUEST['nombre'];
    $pass= $_REQUEST['pass'];
    $fecha=$_REQUEST['fecha'];
    $email=$_REQUEST['email'];
    if(empty($nombre)){
        $_SESSION['error']='Debe rellenar el nombre';
    }elseif(empty($pass)){
        $_SESSION['error']='Debe rellenar la contraseña';
    }elseif(empty($fecha)){
        $_SESSION['error']='Debe rellenar la fecha';
    }elseif(empty($email)){
        $_SESSION['error']='Debe rellenar el email';
    }else{
        $arrayUsuario=array(
            'nombre'=>$nombre,
            'clave'=>$pass,
            'f_nacimiento'=>$fecha,
            'email'=>$email
        );
        $usuario=Curl::post('usuario', $arrayUsuario);
       
    }

}