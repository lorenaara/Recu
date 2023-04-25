<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre Rutina</th>
      <th scope="col">repetir</th>
      <th scope="col">Kg</th>
      <th scope="col">Video</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      unset($_SESSION['error']);
    }
    foreach ($contiene as $objetoContiene) {
    ?>
    <tr>
      <td><? echo $objetoContiene->nombre ?></td>
      <td><? echo $objetoContiene->repetir?></td>
      <td><? echo $objetoContiene->kg?></td>
      <?
        foreach ($ejercicio as $objetoEjercicio) {
    ?>
        <td><? echo $objetoEjercicio->video?></td>
    <?
        }
      ?>
      <td><button name="modificar">modificar</button></td>
     
    </tr>
    <?
    }
    ?>
    
  </tbody>
</table>
<p>¿Desea añadir uno nuevo?<button name="anadir">Añadir</button></p>