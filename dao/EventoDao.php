<?

class EventoDao extends FactoryBD implements DAO{

    public static function findAll()
    {
        $sql='select * from evento';
        $datos=array();
        $devuelve=parent::ejecuta($sql, $datos);
        $arrayEvento=array();
        while($obj=$devuelve->fetchObject()){
            
        }
    }
}