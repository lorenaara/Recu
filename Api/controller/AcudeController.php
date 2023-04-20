<?php

class AcudeController extends ControladorPadre{
     public function controlar(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        switch ($metodo) {
            case 'GET':
                $this->buscar();
                break;
            case 'POST':
                $this->insertar();
                break;
            case 'PUT':
                $this->modificar();
                break;
            case 'DELETE':
                $this->borrar();
                break;
            default:
            ControladorPadre::respuesta('', array('HTTP/1.1 400 No se ha utilizado el metodo correcto'));
                break;
        }
    }

    public function buscar(){
        $parametro=$this->parametros();
        $recurso=self::recurso();
        if(count($recurso)==2){
            if(!$parametro){
                $lista=AcudeDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_evento']) &&count($_GET)==1){
                    $acude= AcudeDao::findByEvento($_GET['id_evento']);
                    $data=json_encode($acude);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['id_user']) && count($_GET)==1){
                    $acude=AcudeDao::findByUser($_GET['id_user']);
                    $data=json_encode($acude);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }elseif(count($recurso)==3){
            $acude=AcudeDao:: findById($recurso[2]);
            $data = json_encode($acude);
            self::respuesta(
                $data,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }else{
            self::respuesta('',  array('HTTP/1.1 400 No se ha utilizado un filtro correcto'));
        }
    }

    public function insertar(){
        $body= file_get_contents('php://input');
        $dato=json_decode($body, true);
        if(isset($dato['id_user'])&& isset($dato['id_evento'])&&isset($dato['activo'])){
            $acude=new Acude(null, $dato['id_user'], $dato['id_evento'], $dato['activo']);
            if(AcudeDao::insert($acude)){
                self::respuesta(
                    '',
                    array('Content-Type: application/json', 'HTTP/1.1 201 INSERTADO')
                );
            }else{
                self::respuesta(
                    '',
                    array('HTTP/1.1 400 Json no tiene el formato correcto')
                );
            }
        }
    }

    public function modificar(){
        $recurso = self::recurso();
        $body= file_get_contents('php://input');
        $dato=json_decode($body, true);
        if(count($recurso)==3){
            if(isset($dato['id_user'])&& isset($dato['id_evento'])&&isset($dato['activo'])){
                $acude=new Acude(null, $dato['id_user'], $dato['id_evento'], $dato['activo']);
                $acude->id=$recurso[2];
                if(AcudeDao::update($acude)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
        }
    }else{
        self::respuesta(
            '',
            array('HTTP/1.1 400 El recurso esta mal formado Acude/id')
        );
    }
}

public function borrar(){
    $recurso=self::recurso();
    if(count($recurso)==3){
        if(AcudeDao::delete($recurso[2])){
            self::respuesta(
                '',
                array('Content-Type: application/json', 'HTTP/1.1 204 Borrado')
            ); 
        }else{
            self::respuesta(
                '',
                array('Content-Type: application/json', 'HTTP/1.1 204 No se ha borrado ninguno')               
             );
        }
    }else{
        self::respuesta(
            '',
            array('HTTP/1.1 400 El recurso esta mal formado Usuario/id')
        );
    }
}
}