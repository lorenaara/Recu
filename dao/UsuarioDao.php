<?php

class UsuarioDao extends FactoryBD implements DAO {

    public static function findAll()
    {
        $sql='select * from usuario';
        $datos= array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayUsuarios=array();
        while($obj= $devuelve->fetchObject()){
            $usuario= new Usuario($obj->id_user, $obj->activo, $obj->nombre, $obj->clave, $obj->f_nacimiento, $obj->email, $obj->id_rol);
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
            $usuario= new Usuario($obj->id_user, $obj->activo, $obj->nombre, $obj->clave, $obj->f_nacimiento, $obj->email, $obj->id_rol);
            return $usuario;
        }
        return null;
    }

    //la aplicacion no borrara si no que actualizara el campo activo a false 
    public static function delete($id)
    {
        $sql= 'update usuario set activo= false where id_user =?';
        $datos=array($id);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function insert($objeto)
    {
        $sql= 'insert into usuario values(null,?,?,?,?,?,?)';
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
        $sql= 'update usuario set activo=?, clave=?, f_nacimiento=?, email=?, id_rol=?, where id_user=?';
        $datos= array($objeto->activo, $objeto->clave, $objeto->f_nacimiento, $objeto->email, $objeto->id_rol, $objeto->id_user);
        $devuelve=parent::ejecuta($sql, $datos);
        if($devuelve->rowCount()==0){
            return false;
        }
        return true;
    }

    public static function findByUserPass($nombre, $clave){
        $sql ='select * from usuario where nombre=? and clave=?';
        $clave= hash('sha256', $clave);
        $datos= array($nombre, $clave);
        $devuelve=parent::ejecuta($sql, $datos);
        $obj=$devuelve->fetchObject();
        if($obj){
            $usuario= new Usuario($obj->id_user, $obj->activo, $obj->nombre, $obj->clave, $obj->f_nacimiento, $obj->email, $obj->id_rol);
            return $usuario;
        }
        return null;
    }
}
?>