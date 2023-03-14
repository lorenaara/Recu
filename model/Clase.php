<?

class Clase{
    private $id_claseC;
    private $activo;
    private $sala;
    private $f_inicio;
    private $f_fin;
    private $plazas;
    private $plazas_ocupadas;
    private $id_clase;
    private $id_user;

    public function __construct($id_claseC, $activo, $sala, $f_inicio, $f_fin, $plazas, $plazas_ocupadas, $id_clase, $id_user)
    {
        $this->id_claseC=$id_claseC;
        $this->activo=$activo;
        $this->sala=$sala;
        $this->f_inicio=$f_inicio;
        $this->f_fin=$f_fin;
        $this->plazas=$plazas;
        $this->plazas_ocupadas=$plazas_ocupadas;
        $this->id_clase=$id_clase;
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