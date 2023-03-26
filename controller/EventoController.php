<?php

class EventoController extends ControladorPadre{
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
                $lista=EventoDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_user']) && count($_GET)==2){
                    $evento=EventoDao::findByUser($_GET['id_user']);
                    $data=json_encode($evento);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['nombre'])&& count($_GET)==2){
                    $evento=EventoDao::findByNombre($_GET['nombre']);
                    $data=json_encode($evento);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }else{
                self::respuesta('',  array('HTTP/1.1 400 No se ha utilizado un filtro correcto'));
            }
            if(count($recurso)==3){
                $evento=EventoDao:: findById($recurso[2]);
                $data = json_encode($evento);
                self::respuesta(
                    $data,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            }
        }

        public function insertar(){
            $body= file_get_contents('php://input');
            $dato=json_decode($body, true);
            if(isset($dato['f_fin']) && isset($dato['f_inicio']) && isset($dato['plazas']) && isset($dato['plazas_ocupadas']) && isset($dato['nombre']) && isset($dato['descripcion']) && isset($dato['activo']) &&isset($dato['id_user'])){
                $evento = new Evento(null, $dato['f_inicio'], $dato['f_fin'], $dato['plazas'], $dato['plazas_ocupadas'], $dato['nombre'], $dato['descripcion'], $dato['activo'], $dato['id_user']);
                if(EventoDao::insert($evento)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
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
            if(isset($dato['f_fin']) && isset($dato['f_inicio']) && isset($dato['plazas']) && isset($dato['plazas_ocupadas']) && isset($dato['nombre']) && isset($dato['descripcion']) && isset($dato['activo']) &&isset($dato['id_user'])){
                $evento = new Evento(null, $dato['f_inicio'], $dato['f_fin'], $dato['plazas'], $dato['plazas_ocupadas'], $dato['nombre'], $dato['descripcion'], $dato['activo'], $dato['id_user']);
                $evento->id=$recurso[2];
                if(EventoDao::update($evento)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Evento/id')
            );
        }
        }

        public function borrar(){
            $recurso=self::recurso();
            if(count($recurso)==3){
                if(EventoDao::delete($recurso[2])){
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
                    array('HTTP/1.1 400 El recurso esta mal formado Evento/id')
                );
            }
        }

    }
