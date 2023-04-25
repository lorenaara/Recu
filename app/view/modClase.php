<?
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

?>

<form action="./index.php" method="post">

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Sala</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Fin</th>
      <th scope="col">Plazas</th>
    </tr>
  </thead>
  <tbody>
   
 

    <tr>
      <td><input type="text" name="nombre" readonly value="<? echo $clase->nombre?>"></td>
      <td><input type="text" name="sala" value="<? echo $clase->sala?>"></td>
      <td><input type="datetime" name="f_inicio"  value="<? echo $clase->f_inicio?>"></td>
      <td><input type="datetime" name="f_fin"  value="<? echo $clase->f_fin?>"></td>
      <td><input type="number" name="plazas"  value="<? echo $clase->plazas?>"></td>
      <td><input type="submit" name="enviar"  value="Enviar"></td>
    </tr>
    
   
    
  </tbody>
</table>
</form>