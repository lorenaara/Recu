<?
require_once './config/conexion.php';

Class FactoryBD{
    public static function ejecuta($sql,$datos){
        try{
            $con = new PDO("mysql:host=".HOST.";dbname=".BBDD,USER,PASS);


            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $preparada = $con->prepare($sql);
            $preparada->execute($datos);       
        }catch(Exception $e){
            
            $preparada = null;
            echo $e;//podemos lanzar aqui un throw por si se cae 
            
            if($e->getCode()==2002 || $e->getCode()==1049){
                //no se puede conectar a la bd
                ControladorPadre::respuesta('',array('HTTP/1.1 500 Error Servidor'));
            }else{
                ControladorPadre::respuesta('',
                array('HTTP/1.1 400 Parametros mal escriptos'.$e->getMessage()));
            }
        }finally{
            unset($con);
            return $preparada;
        }
    }
}
