<?

class ClaseDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from clase join tipoClase using(id_clase)';
        $datos=array();
        $devuelve =parent::ejecuta($sql,$datos);
        $arrayClase= array();
        while($obj=$devuelve->fetchObject()){
            $clase= array("id_claseC"=>($obj->id_claseC), "activo"=>($obj->activo), "sala"=>($obj->sala), "f_inicio"=>($obj->f_inicio), "f_fin"=>( $obj->f_fin), "plazas"=>($obj->plazas), "plazas_ocupadas"=>($obj->plazas_ocupadas), "id_clase"=>($obj->id_clase), "id_user"=>($obj->id_user), "nombre"=>($obj->nombre));
            array_push($arrayClase, $clase);
        }
        return $arrayClase;
    }

    public static function findById($id)
    {
        $sql= 'select * from clase join tipoClase using(id_clase) where id_claseC=? ';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $clase= array("id_claseC"=>($obj->id_claseC), "activo"=>($obj->activo), "sala"=>($obj->sala), "f_inicio"=>($obj->f_inicio), "f_fin"=>( $obj->f_fin), "plazas"=>($obj->plazas), "plazas_ocupadas"=>($obj->plazas_ocupadas), "id_clase"=>($obj->id_clase), "id_user"=>($obj->id_user), "nombre"=>($obj->nombre));
            return $clase;
        }
        return null;
    }
   
    public static function delete($id)
    {
        $sql= 'update clase set activo= 0 where id_claseC =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into clase values(?,1,?,?,?,?,?,?,?)';
        $datos=array(null, $objeto->sala, $objeto->f_inicio, $objeto->f_fin, $objeto->plazas, $objeto->plazas_ocupadas, $objeto->id_claseC, $objeto->id_user);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }
    public static function update($objeto)
    {
        $sql= 'update clase set activo=?, sala=?, f_inicio=?, f_fin=?, plazas=?, plazas_ocupadas=?, id_clase=?, id_user=? where id_claseC=?';
        $datos=array($objeto->activo, $objeto->sala, $objeto->f_inicio, $objeto->f_fin, $objeto->plazas, $objeto->plazas_ocupadas, $objeto->id_clase, $objeto->id_user,$objeto->id_claseC);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public function findByClas($id_clase){
        $sql= 'select * from clase where id_clase=?';
        $datos=array($id_clase);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $clase= array("id_claseC"=>($obj->id_claseC), "activo"=>($obj->activo), "sala"=>($obj->sala), "f_inicio"=>($obj->f_inicio), "f_fin"=>( $obj->f_fin), "plazas"=>($obj->plazas), "plazas_ocupadas"=>($obj->plazas_ocupadas), "id_clase"=>($obj->id_clase), "id_user"=>($obj->id_user));
            return $clase;
        }
        return null;
    }

    public function findByUser($id_user){
        $sql= 'select * from clase where id_user=?';
        $datos=array($id_user);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $clase= array("id_claseC"=>($obj->id_claseC), "activo"=>($obj->activo), "sala"=>($obj->sala), "f_inicio"=>($obj->f_inicio), "f_fin"=>( $obj->f_fin), "plazas"=>($obj->plazas), "plazas_ocupadas"=>($obj->plazas_ocupadas), "id_clase"=>($obj->id_clase), "id_user"=>($obj->id_user));
            return $clase;
        }
        return null;
    }
}