<?php

class UsuarioDao extends FactoryBD implements DAO {

    public static function findAll()
    {
        $sql='select * from usuario';
        $datos= array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayUsuarios=array();
        while($obj= $devuelve->fetchObject()){
            $usuario=array("idUser" => ($obj->id_user), "activo"=>($obj->activo), "nombre"=>($obj->nombre), "clave"=>( $obj->clave), "f_nacimiento"=>($obj->f_nacimiento), "email"=>($obj->email), "id_rol"=>($obj->id_rol));
            array_push($arrayUsuarios, $usuario);
        }
        return $arrayUsuarios;
    }

    public static function findById($id)
    {
        $sql='select * from usuario where id_user=?';
        $datos= array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj= $devuelve->fetchObject();
        if($obj){
            $usuario=array("idUser" => ($obj->id_user), "activo"=>($obj->activo), "nombre"=>($obj->nombre), "clave"=>( $obj->clave), "f_nacimiento"=>($obj->f_nacimiento), "email"=>($obj->email), "id_rol"=>($obj->id_rol));
            return $usuario;
        }
        return null;
    }

    //la aplicacion no borrara si no que actualizara el campo activo a false 
    public static function delete($id)
    {
        $sql= 'update usuario set activo=0 where id_user =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into usuario values(?,1,?,?,?,?,3)';
        
        $datos=array(null,$objeto->nombre, $objeto->clave, $objeto->f_nacimiento, $objeto->email);
        
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function update($objeto)
    {
        $sql= 'update usuario set activo=?, clave=?, f_nacimiento=?, email=?, id_rol=? where id_user=?';
        $datos= array($objeto->activo, $objeto->clave, $objeto->f_nacimiento, $objeto->email, $objeto->id_rol, $objeto->id_user);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUserPass($nombre, $clave){
        $sql ='select * from usuario where nombre=? and clave=? and activo=true';
       // $clave= hash('sha256', $clave);
        $datos= array($nombre, $clave);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $usuario=array("idUser" => ($obj->id_user), "activo"=>($obj->activo), "nombre"=>($obj->nombre), "clave"=>( $obj->clave), "f_nacimiento"=>($obj->f_nacimiento), "email"=>($obj->email), "id_rol"=>($obj->id_rol));
            return $usuario;
        }
        return null;
    }

    public static function findByRol($id_rol){
        $sql='select * from usuario where id_rol=?';
        $datos= array($id_rol);
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayUsuarios=array();
        while($obj= $devuelve->fetchObject()){
            $usuario=array("idUser" => ($obj->id_user), "activo"=>($obj->activo), "nombre"=>($obj->nombre), "clave"=>( $obj->clave), "f_nacimiento"=>($obj->f_nacimiento), "email"=>($obj->email), "id_rol"=>($obj->id_rol));
            array_push($arrayUsuarios, $usuario);
        }
        return $arrayUsuarios;
    }
}
?>