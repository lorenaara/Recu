<?

class AcudeDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from acude';
        $datos=array();
        $devuelve=parent:: ejecuta($sql, $datos);
        $arrayAcude=array();
        while($obj=$devuelve->fetchObject()){
            $acude= new Acude($obj->id_acude, $obj->id_user, $obj->id_evento, $obj->activo);
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
             $acude= new Acude($obj->id_acude, $obj->id_user, $obj->id_evento, $obj->activo);
             return $acude;
        }
        return null;
    }

     public static function delete($id)
    {
        $sql ='update acude set activo= false where id_acude=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }
    
    public static function insert($objeto)
    {
        $sql= 'insert into acude values (null,?,?,?)';
        foreach($objeto as $att){
            array_push($datos, $att);
        }
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
               $acude= new Acude($obj->id_acude, $obj->id_user, $obj->id_evento, $obj->activo);
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
               $acude= new Acude($obj->id_acude, $obj->id_user, $obj->id_evento, $obj->activo);
             return $acude;
        }
        return null;
    }
}