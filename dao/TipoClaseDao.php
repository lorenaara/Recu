<?

class TipoClaseDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql ='select * from tipoClase';
        $datos=array();
        $devuelve =parent::ejecuta($sql,$datos);
        $arrayTipoClase=array();
        while($obj=$devuelve->fetchObject()){
            $tipoClase= new TipoClase($obj->id_clase, $obj->nombre, $obj->id_descripcion, $obj->activo);
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
            $tipoClase= new TipoClase($obj->id_clase, $obj->nombre, $obj->id_descripcion, $obj->activo);
            return $tipoClase;
        }
        return null;
    }

    public static function delete($id)
    {
        $sql= 'update tipoClase set activo= false where id_clase =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into usuario values(null,?,?,?)';
        $objeto=(array)$objeto;
        $datos=array();
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
        $sql='update tipoClase set nombre=?, descripcion=?, activo=?, where id_clase=?';
        $datos= array($objeto->nombre, $objeto->id_descripcion, $objeto->activo, $objeto->id_clase);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

}