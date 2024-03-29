<?

class RutinaDao extends FactoryBD implements DAO{

    public static function findAll(){
        $sql='select * from rutina';
        $datos=array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayRutina=array();
        while($obj=$devuelve->fetchObject()){
            $rutina= array("id_rutina"=>($obj->id_rutina), "activo"=>($obj->activo), "descripcion"=>($obj->descripcion), "nombre"=>($obj->nombre), "f_inicio"=>($obj->f_inicio), "f_fin"=>($obj->f_fin), "id_user"=>$obj->id_user);
            array_push($arrayRutina, $rutina);
        }
        return $arrayRutina;
    }

    public static function findById($id){
        $sql='select * from rutina where id_rutina=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $rutina= array("id_rutina"=>($obj->id_rutina), "activo"=>($obj->activo), "descripcion"=>($obj->descripcion), "nombre"=>($obj->nombre), "f_inicio"=>($obj->f_inicio), "f_fin"=>($obj->f_fin), "id_user"=>$obj->id_user);
            return $rutina;
        }
        return null;
    }

    public static function delete($id)
    {
        $sql= 'update rutina set activo= 0 where id_rutina =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto){
        $sql='insert into rutina values (?,1,?,?,?,?,?)';
        $datos=array(null, $objeto->descripcion, $objeto->nombre, $objeto->f_inicio, $objeto->f_fin, $objeto->id_user);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function update($objeto){
        $sql='update rutina set activo=?, descripcion=?, nombre=?, f_inicio=?, f_fin=?, id_user=? where id_rutina=?';
        $datos=array($objeto->activo, $objeto->descripcion, $objeto->nombre, $objeto->f_inicio, $objeto->f_fin, $objeto->id_user, $objeto->id_rutina);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUser($id_user){
        $sql='select * from rutina where id_user=?';
        $datos=array($id_user);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $rutina= array("id_rutina"=>($obj->id_rutina), "activo"=>($obj->activo), "descripcion"=>($obj->descripcion), "nombre"=>($obj->nombre), "f_inicio"=>($obj->f_inicio), "f_fin"=>($obj->f_fin), "id_user"=>$obj->id_user);
            return $rutina;
        }
        return null;
    }
    public static function findByNombre($nombre){
        $sql='select * from rutina where nombre=?';
        $datos=array($nombre);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $rutina= array("id_rutina"=>($obj->id_rutina), "activo"=>($obj->activo), "descripcion"=>($obj->descripcion), "nombre"=>($obj->nombre), "f_inicio"=>($obj->f_inicio), "f_fin"=>($obj->f_fin), "id_user"=>$obj->id_user);
            return $rutina;
        }
        return null;
    }
}