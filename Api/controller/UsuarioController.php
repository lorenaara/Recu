<?

class UsuarioController extends ControladorPadre{

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
                $lista=UsuarioDao::findAll();
                $data =json_encode($lista);
                self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
            }else{
                if(isset($_GET['nombre']) && isset($_GET['clave']) && count($_GET)==2){
                    $usuario=UsuarioDao::findByUserPass($_GET['nombre'], $_GET['clave']);
                    $data=json_encode($usuario);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }elseif(isset($_GET['id_rol']) && count($_GET)==2){
                    $usuario=UsuarioDao::findByRol($_GET['id_rol']);
                    $data=json_encode($usuario);
                    self::respuesta($data,  array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
            }
        }elseif(count($recurso)==3){
            $usuario = UsuarioDao::findById($recurso[2]);
            $data = json_encode($usuario);
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
        if( isset($dato['nombre']) && isset($dato['clave']) && isset($dato['f_nacimiento']) && isset($dato['email'])){
            $usuario = new Usuario(null,$dato['activo'], $dato['nombre'], $dato['clave'], $dato['f_nacimiento'], $dato['email'], $dato['id_rol']);
            if(UsuarioDao::insert($usuario)){
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
            if(isset($dato['activo']) && isset($dato['nombre']) && isset($dato['clave']) && isset($dato['f_nacimiento']) && isset($dato['email']) && isset($dato['id_rol'])){
                $usuario = new Usuario(null,$dato['activo'], $dato['nombre'], $dato['clave'], $dato['f_nacimiento'], $dato['email'], $dato['id_rol']);
                $usuario->id_user=$recurso[2];
                if(UsuarioDao::update($usuario)){
                    self::respuesta(
                        '',
                        array('Content-Type: application/json', 'HTTP/1.1 201 Modificado')
                    );
                }
            }
        }else{
            self::respuesta(
                '',
                array('HTTP/1.1 400 El recurso esta mal formado Usuario/id')
            );
        }
    }

    public function borrar(){
        $recurso=self::recurso();
        if(count($recurso)==3){
            if(UsuarioDao::delete($recurso[2])){
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