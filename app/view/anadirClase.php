<?
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

?>

<form action="./index.php" method="post">
    <label for="nombre">Nombre</label>
    <select>
        <option value="selecciona">...</option>
       <?
       foreach($clase as $objetoClase){
    ?>
    <option value="<? echo $objetoClase->id_clase?>"><? echo $objetoClase->nombre?></option>
    <?
       }
       ?>
    </select>
    <label for="sala">Sala</label>
    <input type="number" name="sala" id="sala" >
    <label for="f_inicio">Fecha Inicio</label>
    <input type="date" name="f_inicio" id="f_inicio">
    <label for="f_fin">Fecha Fin</label>
    <input type="date" name="f_fin" id="f_fin">
    <label for="plazas">Plazas</label>
    <input type="number" name="plazas" id="plazas">
    <label for="nombreUser">Nombre</label>
    <select>
    <option value="selecciona">...</option>
       <?
       foreach($user as $objetoUser){
    ?>
    <option value="<? $objetoUser->nombre?>"><? echo $objetoUser->nombre?></option>
    <?
       }
       ?>
    </select>
    <input type="submit" value="Enviar" name="enviar">
   
</form>