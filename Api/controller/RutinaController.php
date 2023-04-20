<?php
class RutinaController extends ControladorPadre{
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
                $lista=RutinaDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['id_user']) && count($_GET)==1){
                    $rutina=RutinaDao::findByUser($_GET['id_user']);
                    $data=json_encode($rutina);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['nombre'])&& count($_GET)==1){
                    $rutina=RutinaDao::findByNombre($_GET['nombre']);
                    $data=json_encode($rutina);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }elseif(count($recurso)==3){
            $rutina=RutinaDao:: findById($recurso[2]);
            $data = json_encode($rutina);
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
        if(isset($dato['activo']) && isset($dato['descripcion']) && isset($dato['nombre']) && isset($dato['f_inicio']) && isset($dato['f_fin']) && isset($dato['id_user'])){
            $rutina= new Rutina(null, $dato['activo'], $dato['descripcion'], $dato['nombre'], $dato['f_inicio'], $dato['f_fin'], $dato['id_user']);
            if(RutinaDao::insert($rutina)){
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
            if(isset($dato['activo']) && isset($dato['descripcion']) && isset($dato['nombre']) && isset($dato['f_inicio']) && isset($dato['f_fin']) && isset($dato['id_user'])){
                $rutina= new Rutina(null, $dato['activo'], $dato['descripcion'], $dato['nombre'], $dato['f_inicio'], $dato['f_fin'], $dato['id_user']);
                $rutina->id_rutina=$recurso[2];
                if(RutinaDao::update($rutina)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Rutina/id')
            );
        }
    }

    public function borrar(){
        $recurso=self::recurso();
        if(count($recurso)==3){
            if(RutinaDao::delete($recurso[2])){
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
                array('HTTP/1.1 400 El recurso esta mal formado Rutina/id')
            );
        }
    }
}