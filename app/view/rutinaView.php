<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Fin</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
    foreach ($rutina as $objetoRutina) {
    ?>
    <tr>
      <td><? echo $objetoRutina->nombre ?></td>
      <td><? echo $objetoRutina->descripcion?></td>
      <td><? echo $objetoRutina->f_inicio?></td>
      <td><? echo $objetoRutina->f_fin?></td>
      <td><button name="modificar">modificar</button></td>
     
    </tr>
    <?
    }
    ?>
    
  </tbody>
</table>
<p>¿Desea añadir uno nuevo?<button name="anadir">Añadir</button></p>