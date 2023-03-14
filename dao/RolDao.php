<?

class RolDao extends FactoryBD implements DAO{
    
    public static function findAll()
    {
        $sql= 'select * from rol';
        $datos=array();
        $devuelve =parent::ejecuta($sql,$datos);
        $arrayRol=array();
        while($obj=$devuelve->fetchObject()){
            $rol= new Rol($obj->id_rol, $obj->tipo);
            array_push($arrayRol, $rol);
        }
        return $arrayRol;
    }

    public static function findById($id)
    {
        $sql= 'select * from rol where id_rol=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $rol= new Rol($obj->id_rol, $obj->tipo);
            return $rol;
        }
        return null;
    }

    public static function delete($id){}
    public static function update($objeto){}
    public static function insert($objeto){}
}