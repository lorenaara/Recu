<?

class UsuarioController extends ControladorPadre{

    public function controlar(){
        $metodo = $_SERVER['REQUEST_METHOD'];
        switch ($metodo) {
            case 'GET':
                $this->buscar();
                break;
            
            default:
                # code...
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
                }
            }
        }
    }
}