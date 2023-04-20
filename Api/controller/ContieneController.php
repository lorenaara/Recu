<?php

class ContieneController extends ControladorPadre{
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
                $lista=ContieneDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_rutina']) && count($_GET)==1){
                    $contiene= ContieneDao::findByRutina($_GET['id_rutina']);
                    $data=json_encode($contiene);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['id_ejercicio']) && count($_GET)==1){
                    $contiene=ContieneDao::findByEjercicio($_GET['id_ejercicio']);
                    $data=json_encode($contiene);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }elseif(count($recurso)==3){
            $contiene=ContieneDao:: findById($recurso[2]);
            $data = json_encode($contiene);
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
        if(isset($dato['repetir']) && isset($dato['kg']) && isset($dato['activo']) && isset($dato['id_rutina']) && isset($dato['id_ejercicio'])){
            $contiene= new Contiene(null, $dato['repetir'], $dato['kg'], $dato['activo'], $dato['id_rutina'], $dato['id_ejercicio']);
            if(ContieneDao::insert($contiene)){
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
            if(isset($dato['repetir']) && isset($dato['kg']) && isset($dato['activo']) && isset($dato['id_rutina']) && isset($dato['id_ejercicio'])){
                $contiene= new Contiene(null, $dato['repetir'], $dato['kg'], $dato['activo'], $dato['id_rutina'], $dato['id_ejercicio']);
                $contiene->id_contiene=$recurso[2];
                if(ContieneDao::update($contiene)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Contiene/id')
            );
        }
    }

    public function borrar(){
        $recurso=self::recurso();
        if(count($recurso)==3){
            if(ContieneDao::delete($recurso[2])){
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
                array('HTTP/1.1 400 El recurso esta mal formado Contiene/id')
            );
        }
    }
}