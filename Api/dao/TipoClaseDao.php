<?

class TipoClaseDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql ='select * from tipoClase';
        $datos=array();
        $devuelve =parent::ejecuta($sql,$datos);
        $arrayTipoClase=array();
        while($obj=$devuelve->fetchObject()){
            $tipoClase= array("id_clase"=>($obj->id_clase), "nombre"=>($obj->nombre), "descripcion"=>($obj->descripcion), "activo"=>($obj->activo));
            array_push($arrayTipoClase, $tipoClase);
        }
        return $arrayTipoClase;
    }

    public static function findById($id)
    {
        $sql= 'select * from tipoClase where id_clase=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $tipoClase= array("id_clase"=>($obj->id_clase), "nombre"=>($obj->nombre), "descripcion"=>($obj->descripcion), "activo"=>($obj->activo));
            return $tipoClase;
        }
        return null;
    }

    public static function delete($id)
    {
        $sql= 'update tipoClase set activo= 0 where id_clase =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into tipoClase values(?,?,?,1)';
        $datos=array(null,$objeto->nombre, $objeto->descripcion);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function update($objeto)
    {
        $sql='update tipoClase set nombre=?, descripcion=?, activo=? where id_clase=?';
        $datos= array($objeto->nombre, $objeto->descripcion, $objeto->activo, $objeto->id_clase);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

}