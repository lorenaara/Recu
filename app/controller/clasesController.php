<?


if(isset($_REQUEST['modClase'])){
    $_SESSION['vista']=$vistas['modClase'];
    $clase = Curl::getid('clase',($_REQUEST['id_claseC']));
    $clase= json_decode($clase);
}elseif(isset($_REQUEST['enviarM'])){
    $arrayClase= array(
        'id_claseC'=>$_REQUEST['id_claseC'],
        'activo'=>1,
        'sala'=>$_REQUEST['sala'],
        'f_inicio'=>$_REQUEST['f_inicio'],
        'f_fin'=>$_REQUEST['plazas'],
        'plazas_ocupadas'=>$clase->plazas_ocupadas,
        'id_clase'=>$clase->id_clase,
        'id_user'=>$clase->id_user
    );
    //getid
    //mod
    $claseMod=Curl::put('clase', $arrayClase, $_REQUEST['id_claseC']);
    
}elseif(isset($_REQUEST['anadirClase'])){
    $clase=Curl::get('tipoClase');
    $clase=json_decode($clase);
    $user=Curl::getMonitor('usuario');
    $user=json_decode($user);
    if(!is_array($user))
    $user=array($user);
    $_SESSION['vista']=$vistas['anadirClase'];
    if(isset($_REQUEST['enviar'])){
        $arrayUsuario= array(
            'activo'=>1,
            'sala'=>$_REQUEST['sala'],
            'f_inicio'=>$_REQUEST['f_inicio'],
            'f_fin'=>$_REQUEST['plazas'],
            'plazas_ocupadas'=>0,
            'id_clase'=>$clase->id_clase,
            'id_user'=>$user->id_user
        );
        $clase=Curl::post('clase', $arrayClase);
        $_SESSION['vista']=$vistas['clase'];
    }
}
else{
    $clase=Curl::get('clase');
    $clase= json_decode($clase);
}