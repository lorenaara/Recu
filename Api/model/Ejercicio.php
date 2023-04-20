<?
class Ejercicio{
    private $id_ejercicio;
    private $activo;
    private $video;

    public function __construct($id_ejercicio, $activo, $video){
        $this->id_ejercicio=$id_ejercicio;
        $this->activo=$activo;
        $this->video=$video;
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