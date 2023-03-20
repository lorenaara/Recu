<?

class Evento{
    private $id_evento;
    private $f_fin;
    private $f_inicio;
    private $plazas;
    private $plazas_ocupadas;
    private $nombre;
    private $descripcion;
    private $activo;
    private $id_user;

    public function __construct($id_evento, $f_fin, $f_inicio, $plazas, $plazas_ocupadas, $nombre,$descripcion, $activo, $id_user)
    {
        $this->id_evento=$id_evento;
        $this->f_fin=$f_fin;
        $this->f_inicio=$f_inicio;
        $this->plazas=$plazas;
        $this->plazas_ocupadas=$plazas_ocupadas;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->activo=$activo;
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