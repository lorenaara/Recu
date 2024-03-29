<?

class EjercicioDao extends FactoryBD implements DAO{

    public static function findAll(){
        $sql='select * from ejercicio';
        $datos= array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayEjercicio=array();
        while($obj=$devuelve->fetchObject()){
            $ejercicio=array("id_ejercicio"=>($obj->id_ejercicio), "activo"=>($obj->activo), "video"=>($obj->video)); 
            array_push($arrayEjercicio, $ejercicio);
        }
        return $arrayEjercicio;
    }

      public static function findById($id){
        $sql='select * from ejercicio where id_ejercicio=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $ejercicio=array("id_ejercicio"=>($obj->id_ejercicio), "activo"=>($obj->activo), "video"=>($obj->video)); 
             return $ejercicio;
        }
        return null;
    }
     public static function delete($id)
    {
        $sql= 'update ejercicio set activo= 0 where id_ejercicio =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

        public static function insert($objeto){
        $sql='insert into ejercicio values(?,1,?)';
        $datos=array(null, $objeto->video);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

      public static function update($objeto){
        $sql='update ejercicio set activo=?, video=? where id_ejercicio=?';
        $datos=array($objeto->activo, $objeto->video, $objeto->id_ejercicio);
         $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }
}