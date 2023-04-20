<?php

class AsisteController extends ControladorPadre{
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
                $lista=AsisteDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_claseC']) &&count($_GET)==1){
                    $asiste= AsisteDao::findByClase($_GET['id_claseC']);
                    $data=json_encode($asiste);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['id_user']) && count($_GET)==1){
                    $asiste=AsisteDao::findByUser($_GET['id_user']);
                    $data=json_encode($asiste);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }elseif(count($recurso)==3){
            $asiste=AsisteDao:: findById($recurso[2]);
            $data = json_encode($asiste);
            self::respuesta(
                $data,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }
        else{
            self::respuesta('',  array('HTTP/1.1 400 No se ha utilizado un filtro correcto'));
        }
    }

    public function insertar(){
        $body= file_get_contents('php://input');
        $dato=json_decode($body, true);
        if(isset($dato['id_user'])&& isset($dato['id_claseC'])&& isset($dato['clasificacion'])&&isset($dato['activo'])){
            $asiste=new Asiste(null, $dato['id_user'], $dato['id_claseC'], $dato['clasificacion'], $dato['activo']);
            if(AsisteDao::insert($asiste)){
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
            if(isset($dato['id_user'])&& isset($dato['id_claseC'])&& isset($dato['clasificacion'])&&isset($dato['activo'])){
                $asiste=new Asiste(null, $dato['id_user'], $dato['id_claseC'], $dato['clasificacion'], $dato['activo']);
                $asiste->id=$recurso[2];
                if(AsisteDao::update($asiste)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
        }
    }else{
        self::respuesta(
            '',
            array('HTTP/1.1 400 El recurso esta mal formado Asiste/id')
        );
    }
}

public function borrar(){
    $recurso=self::recurso();
    if(count($recurso)==3){
        if(AsisteDao::delete($recurso[2])){
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