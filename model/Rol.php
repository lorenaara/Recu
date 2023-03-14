<?
class Rol{
    private $id_rol;
    private $tipo;

    public function __construct($id_rol, $tipo)
    {
        $this->id_rol=$id_rol;
        $this->tipo= $tipo;
    }

    public function __get($get)
    {
        if(property_exists(__CLASS__, $get))
            return $this->$get;
        return null;
    }
    public function __set($name, $value)
    {
        if(property_exists(__CLASS__, $name))
        $this->$name=$value;
    }
}