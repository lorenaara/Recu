<?

class Acude{
    private $id_acude;
    private $id_user;
    private $id_evento;
    private $activo;
   

    public function __construct($id_acude,$id_user, $id_evento, $activo)
    {
        $this->id_acude=$id_acude;
        $this->id_user=$id_user;
        $this->id_evento=$id_evento;
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