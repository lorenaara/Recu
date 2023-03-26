<?

class ContieneDao extends FactoryBD implements DAO{

    public static function findAll(){
        $sql='select * from contiene';
        $datos=array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayContiene=array();
         while($obj=$devuelve->fetchObject()){
            $contiene= new Contiene ($obj->id_contiene, $obj->repetir, $obj->activo, $obj->id_rutina, $obj->id_ejercicio);
            array_push($arrayContiene, $contiene);
         }
         return $arrayContiene;
    }

    public static function findById($id){
        $sql='select * from contiene where id_contiene=?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $contiene= new Contiene ($obj->id_contiene, $obj->repetir, $obj->activo, $obj->id_rutina, $obj->id_ejercicio);
            return $contiene;
        }
        return null;
    }

    public static function delete($id)
    {
        $sql= 'update contiene set activo= false where id_contiene =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto){
        $sql='insert into contiene values(null,?,?,?,?,?)';
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

    public static function update($objeto){
        $sql='update contiene set repetir=?, kg=?, activo=?, id_rutina=?, id_ejercicio=?, where id_contiene=?';
        $datos= array($objeto->repetir, $objeto->kg, $objeto->id_rutina, $objeto->id_ejercicio, $objeto->id_contiene);
         $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByRutina($id_rutina){
        $sql='select * from contiene where id_rutina=?';
        $datos=array($id_rutina);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $contiene= new Contiene ($obj->id_contiene, $obj->repetir, $obj->activo, $obj->id_rutina, $obj->id_ejercicio);
            return $contiene;
        }
        return null;
    }

    public static function findByEjercicio($id_ejercicio){
        $sql='select * from contiene where id_ejercicio=?';
        $datos=array($id_ejercicio);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $contiene= new Contiene ($obj->id_contiene, $obj->repetir, $obj->activo, $obj->id_rutina, $obj->id_ejercicio);
            return $contiene;
        }
        return null;
    }
}