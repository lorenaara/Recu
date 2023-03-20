<?

class AsisteDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from asiste;';
        $datos=array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayAsiste=array();
        while($obj=$devuelve->fetchObject()){
            $asiste=new Asiste($obj->id_asiste,$obj->id_user, $obj->id_claseC, $obj->clasificacion,$obj->activo);
            array_push($arrayAsiste, $asiste);
        }
        return $arrayAsiste;
    }

    public static function findById($id)
    {
        $sql = 'select * from asiste where id_asiste=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $asiste=new Asiste($obj->id_asiste,$obj->id_user, $obj->id_claseC, $obj->clasificacion, $obj->activo);
            return $asiste;
        }
        return null;
    }

    public static function delete($id)
    {
        $sql ='update asiste set activo= false where id_asiste=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into asiste values (null,?,?,?,?)';
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
        $sql= 'update asiste set id_user=?, id_claseC=?, clasificacion=?, activo=?, where id_asiste=?';
        $datos= array($objeto->id_asiste,$objeto->id_user, $objeto->id_claseC, $objeto->clasificacion,$objeto->activo);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUser($id_user){
        $sql='select * from asiste where id_user=?';
        $datos=array($id_user);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $asiste=new Asiste($obj->id_asiste,$obj->id_user, $obj->id_claseC, $obj->clasificacion,$obj->activo);
            return $asiste;
        }
        return null;
    }

    public static function findByClase($id_claseC){
        $sql='select * from asiste where id_claseC=?';
        $datos=array($id_claseC);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $asiste=new Asiste($obj->id_asiste,$obj->id_user, $obj->id_claseC, $obj->clasificacion,$obj->activo);
            return $asiste;
        }
        return null;
    }
}