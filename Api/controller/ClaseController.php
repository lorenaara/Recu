<?php

class ClaseController extends ControladorPadre{
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
                $lista=ClaseDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_clase']) &&count($_GET)==1){
                    $clase= ClaseDao::findByClas($_GET['id_clase']);
                    $data=json_encode($clase);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['id_user']) && count($_GET)==1){
                    $clase=ClaseDao::findByUse($_GET['id_user']);
                    $data=json_encode($clase);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }else if(count($recurso)==3){
            $clase=ClaseDao:: findById($recurso[2]);
            $data = json_encode($clase);
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
        if(isset($dato['activo']) && isset($dato['sala']) && isset($dato['f_inicio']) && isset($dato['f_fin']) && isset($dato['plazas']) && isset($dato['plazas_ocupadas']) && isset($dato['id_clase']) && isset($dato['id_user'])){
            $clase= new Clase(null, $dato['activo'], $dato['sala'], $dato['f_inicio'], $dato['f_fin'], $dato['plazas'], $dato['plazas_ocupadas'], $dato['id_clase'], $dato['id_user']);
            if(ClaseDao::insert($clase)){
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
            if(isset($dato['activo']) && isset($dato['sala']) && isset($dato['f_inicio']) && isset($dato['f_fin']) && isset($dato['plazas']) && isset($dato['plazas_ocupadas']) && isset($dato['id_clase']) && isset($dato['id_user'])){
                $clase= new Clase(null, $dato['activo'], $dato['sala'], $dato['f_inicio'], $dato['f_fin'], $dato['plazas'], $dato['plazas_ocupadas'], $dato['id_clase'], $dato['id_user']);
                $clase->id_claseC=$recurso[2];
                if(ClaseDao::update($clase)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Clase/id')
            );
        }
    }

    public function borrar(){
        $recurso=self::recurso();
        if(count($recurso)==3){
            if(ClaseDao::delete($recurso[2])){
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