<?

class EventoDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from evento';
        $datos=array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayEvento=array();
        while($obj=$devuelve->fetchObject()){
            $evento= new Evento($obj->id_evento, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->nombre, $obj->descripcion, $obj->activo, $obj->id_user);
            array_push($arrayEvento, $evento);
        }
        return $arrayEvento;
    }

    public static function findById($id){
        $sql='select * from evento where id_evento=?';
        $datos=array($id);
        $devuelve =parent::ejecuta($sql,$datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $evento= new Evento($obj->id_evento, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->nombre, $obj->descripcion, $obj->activo, $obj->id_user);
            return $evento;
        }
        return null;
    }
 public static function delete($id)
    {
        $sql= 'update evento set activo= false where id_evento =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto){
        $sql='insert into evento values(null,?,?,?,?,?,?,?,?)';
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
        $sql='update evento set f_inicio=?,f_fin=?, plazas=?, plazas_ocupadas=?, nombre=?, descripcion=?, activo=?, id_user=? where id_evento=?';
        $datos=array($objeto->f_inicio, $objeto->f_fin, $objeto->plazas, $objeto->plazas_ocupadas, $objeto->nombre, $objeto->descripcion, $objeto->activo, $objeto->id_user, $objeto->id_evento);
         $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUser($id_user){
        $sql='select * from evento where id_user=?';
        $datos=array($id_user);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $evento= new Evento($obj->id_evento, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->nombre, $obj->descripcion, $obj->activo, $obj->id_user);
            return $evento;
        }
        return null;
    }

    public static function findByNombre($nombre){
        $sql='select * from evento where nombre=?';
        $datos=array($nombre);
        $devuelve=parent::ejecuta($sql,$datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $evento= new Evento($obj->id_evento, $obj->f_inicio, $obj->f_fin, $obj->plazas, $obj->plazas_ocupadas, $obj->nombre, $obj->descripcion, $obj->activo, $obj->id_user);
            return $evento;
        }
        return null;
    }

}