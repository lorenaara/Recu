<?
class Usuario{

    private $id_user;
    private $activo;
    private $nombre;
    private $clave;
    private $f_nacimiento;
    private $email;
    private $id_rol;

    public function __construct($id_user, $activo, $nombre, $clave, $f_nacimiento, $email, $id_rol)
    {
        $this->id_user=$id_user;
        $this->activo= $activo;
        $this->nombre=$nombre;
        $this->clave=$clave;
        $this->f_nacimiento=$f_nacimiento;
        $this->email=$email;
        $this->id_rol=$id_rol;
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