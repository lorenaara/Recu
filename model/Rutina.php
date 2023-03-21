<?

class Rutina{
    private $id_rutina;
    private $activo;
    private $descripcion;
    private $nombre;
    private $f_inicio,
    private $f_fin;
    private $id_user;

    public function __construct($id_rutina, $activo, $descripcion, $nombre, $f_inicio, $f_fin, $id_user){
        $this->id_rutina=$id_rutina;
        $this->activo=$activo;
        $this->descripcion=$descripcion,
        $this->nombre=$nombre;
        $this->f_inicio=$f_inicio;
        $this->f_fin=$f_fin;
        $this->id_user=$id_user;
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