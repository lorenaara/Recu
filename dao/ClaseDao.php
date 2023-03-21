<?

class ClaseDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from clase';
        $datos=array();
        $devuelve =parent::ejecuta($sql,$datos);
        $arrayClase= array();
        while($obj=$devuelve->fetchObject()){
            $clase= new Clase($obj->id_claseC, $obj->activo, $obj->sala, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->id_clase, $obj->id_user);
            array_push($arrayClase, $clase);
        }
        return $arrayClase;
    }

    public static function findById($id)
    {
        $sql= 'select * from clase where id_claseC=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $clase= new Clase($obj->id_claseC, $obj->activo, $obj->sala, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->id_clase, $obj->id_user);
            return $clase;
        }
        return null;
    }
   
    public static function delete($id)
    {
        $sql= 'update clase set activo= false where id_claseC =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into usuario values(null,?,?,?,?,?,?,?,?)';
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
        $sql= 'update clase set activo=?, sala=?, f_inicio=?, f_fin=?, plazas=?, plazas_ocupadas=?, id_clase=?, id_user=?, where id_claseC=?';
        $datos=array($objeto->activo, $objeto->sala, $objeto->f_inicio, $objeto->f_fin, $objeto->plazas, $objeto->plazas_ocupadas, $objeto->id_clase, $objeto->id_user,$objeto->id_claseC);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }
}