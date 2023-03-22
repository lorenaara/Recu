<?php

class RolController extends ControladorPadre{
    
    public function controlar(){
        $metodo= $_SERVER['REQUEST_METHOD'];
        switch($metodo){
          case 'GET':
                $this->buscar();
                break;
          /*  case 'POST':
                $this->insertar();
                break;
            case 'PUT':
                $this->modificar();
                break;
            case 'DELETE':
                $this->borrar();
                break;*/
            default:
            ControladorPadre::respuesta('', array('HTTP/1.1 400 No se ha utilizado el metodo correcto'));
                break;   
        }
    }

    public function buscar(){
        $parametro=$this->parametros();
        $recurso = self::recurso();
        if(count($recurso)==2){
            if(!$parametro){
                $lista=RolDao::findAll();
                $data=json_encode($lista);
                 self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }
        }else{
             self::respuesta('',  array('HTTP/1.1 400 No se ha utilizado un filtro correcto'));
        }
        if(count($recurso)==3){
            $rol=RolDao::findById($recurso[2]);
             $data = json_encode($concierto);
            self::respuesta(
                $data,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }
    }

   /* public function insertar(){
         $body= file_get_contents('php://input');
        $dato=json_decode($body, true);
        if(isset($dato['tipo'])){
            $rol= new ROl($dato['tipo']);
            if(RolDao::insert($rol)){
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
    }*/


}