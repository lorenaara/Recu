<?
class Curl
{
    public static function get($recurso)
    {
        $ch = curl_init();
        $url = URLAPI . $recurso;
        curl_setopt($ch, CURLOPT_URL, $url);
        //que retorne algo
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);
        curl_close($ch);
        return $resultado;
    }


    public static function getid($recurso, $id)
    {
        $ch = curl_init();
        $url = URLAPI . $recurso . '/'. $id;
        curl_setopt($ch, CURLOPT_URL, $url);
        //que retorne algo
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);
        curl_close($ch);
        return $resultado;
    }
    public static function getFiltro($recurso, $array)
    {
        $ch = curl_init();

        $url = URLAPI . $recurso . '?';
        foreach ($array as $key => $value) {
            $url .= $key . '=' . $value;
            if (array_key_last($array) != $key) {
                $url .= '&';
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        //que retorne algo
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($ch);
        curl_close($ch);
        if (str_contains($resultado, 'null'))
            $resultado = null;
        return $resultado;
    }

    public static function post($recurso, $array){
        $ch = curl_init();
        $url = URLAPI . $recurso;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 'POST');
        $array=json_encode($array);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        //otra opcion sera curl_setopt_array, en el que se agregan todas las propiedades anteriores mediante un array asociativo
        $resultado = curl_exec($ch);
        curl_close($ch);
        if (str_contains($resultado, 'null'))
            $resultado = null;
        return $resultado;
    }

    public static function put($recurso, $array, $id){
        $ch = curl_init();
        $url = URLAPI . $recurso.'/'. $id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        $array=json_encode($array);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        //otra opcion sera curl_setopt_array, en el que se agregan todas las propiedades anteriores mediante un array asociativo
        $resultado = curl_exec($ch);
        curl_close($ch);
        if (str_contains($resultado, 'null'))
            $resultado = null;
        return $resultado;
    }
}

