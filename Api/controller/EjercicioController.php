<?php

class EjercicioController extends ControladorPadre{
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
        $parametro =$this->parametros();

        $recurso=self::recurso();
        if(count($recurso)==2){
            if(!$parametro){
                $lista=EjercicioDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }
        }else if(count($recurso)==3){
            $ejercicio = EjercicioDao::findById($recurso[2]);
            $data = json_encode($ejercicio);
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
        if(isset($dato['activo']) && isset($dato['video'])){
            $ejercicio= new Ejercicio(null, $dato['activo'], $dato['video']);
            if(EjercicioDao::insert($ejercicio)){
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
            if(isset($dato['activo']) && isset($dato['video'])){
                $ejercicio= new Ejercicio(null, $dato['activo'], $dato['video']);
                $ejercicio->id_ejercicio=$recurso[2];
                if(EjercicioDao:: update($ejercicio)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Ejercicio/id')
            );
        }
    }

    public function borrar(){
        $recurso=self::recurso();
        if(count($recurso)==3){
            if(EjercicioDao::delete($recurso[2])){
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
                array('HTTP/1.1 400 El recurso esta mal formado Ejercicio/id')
            );
        }
    }

}