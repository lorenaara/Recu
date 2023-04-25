<?


if(isset($_REQUEST['modClase'])){
    $_SESSION['vista']=$vistas['modClase'];
    $clase = Curl::getid('clase',($_REQUEST['id_claseC']));
    $clase= json_decode($clase);
    if(isset($_REQUEST['enviar'])){
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
    $claseMod=Curl::put('clase', $arrayClase, $_REQUEST['id_claseC']);
}
}else{
    $clase=Curl::get('clase');
    $clase= json_decode($clase);
}