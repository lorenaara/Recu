<?

class Contiene{
    private $id_contiene
    private $repetir;
    private $kg;
    private $activo;
    private $id_rutina;
    private $id_ejercicio,

    public function __construct($id_contiene, $repetir, $kg, $activo ,$id_rutina, $id_ejercicio){
        $this->id_contiene=$id_contiene;
        $this->repetir=$repetir,
        $this->kg=$kg;
        $this->activo=$activo;
        $this->id_rutina=$id_rutina;
        $this->id_ejercicio=$id_ejercicio,
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