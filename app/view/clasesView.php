

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Sala</th>
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
    foreach ($clase as $objetoClase) {
    ?>
    <tr>
      <td><? echo $objetoClase->nombre ?></td>
      <td><? echo $objetoClase->sala?></td>
      <td><? echo $objetoClase->f_inicio?></td>
      <td><? echo $objetoClase->f_fin?></td>
      <td><form action="./index.php">
      <input type="hidden" name="id_claseC" value="<?echo $objetoClase->id_claseC?>">
      <button name="modClase">modificar</button>
      </form>
    </td>

     
    </tr>
    <?
    }
    ?>
    
  </tbody>
</table>
<p>¿Desea añadir uno nuevo?</p><form action="./index.php" method="post"><input type="submit" name="anadirClase" value="Añadir"></form>