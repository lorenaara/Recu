<?

class Asiste{
    private $id_asiste;
    private $id_user;
    private $id_claseC;
    private $clasificacion;
    private $activo;

    public function __construct($id_asiste,$id_user, $id_claseC, $clasificacion, $activo)
    {
        $this->id_asiste=$id_asiste;
        $this->id_user=$id_user;
        $this->id_claseC=$id_claseC;
        $this->clasificacion=$clasificacion;
        $this->activo=$activo;
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