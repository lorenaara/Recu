<?

class TipoClase{
    private $id_clase;
    private $nombre;
    private $descripcion;
    private $activo;

    public function __construct($id_clase, $nombre, $descripcion, $activo)
    {
        $this->id_clase=$id_clase;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;    
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