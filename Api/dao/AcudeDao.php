<?

class AcudeDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from acude';
        $datos=array();
        $devuelve=parent:: ejecuta($sql, $datos);
        $arrayAcude=array();
        while($obj=$devuelve->fetchObject()){
            $acude= array("id_acude"=>($obj->id_acude), "id_user"=>($obj->id_user), "id_evento"=>($obj->id_evento), "activo"=>($obj->activo));
            array_push($arrayAcude, $acude);
        }
        return $arrayAcude;
    }

    public static function findById($id)
    {
        $sql='select * from acude where id_acude=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $acude= array("id_acude"=>($obj->id_acude), "id_user"=>($obj->id_user), "id_evento"=>($obj->id_evento), "activo"=>($obj->activo));
             return $acude;
        }
        return null;
    }

     public static function delete($id)
    {
        $sql ='update acude set activo= 0 where id_acude=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }
    
    public static function insert($objeto)
    {
        $sql= 'insert into acude values (?,?,?,1)';
        $datos=array(null, $objeto->id_user, $objeto->id_evento);
       
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function update($objeto)
    {
        $sql='update acude set id_user=?, id_evento=?, activo=?, where id_acude=?';
        $datos= array($objeto->id_user, $objeto->id_evento, $objeto->activo, $objeto->id_acude);
         $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUser($id_user){
        $sql= 'select * from acude where id_user=?';
        $datos=array($id_user);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $acude= array("id_acude"=>($obj->id_acude), "id_user"=>($obj->id_user), "id_evento"=>($obj->id_evento), "activo"=>($obj->activo));
             return $acude;
        }
        return null;
    }

    public static function findByEvento($id_evento){
         $sql= 'select * from acude where id_evento=?';
        $datos=array($id_evento);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $acude= array("id_acude"=>($obj->id_acude), "id_user"=>($obj->id_user), "id_evento"=>($obj->id_evento), "activo"=>($obj->activo));
             return $acude;
        }
        return null;
    }
}