<?
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

?>

<form action="./index.php" method="post">
    <label for="nombre">Usuario</label>
    <input type="text" name="nombre" id="nombre">
    <br><label for="pass">Clave</label>
    <input type="password" name="pass" id="pass" >
    <label for="fecha">Fecha Nacimiento</label>
    <input type="date" name="fecha" id="fecha">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <input type="submit" value="Enviar" name="enviar">
   
</form>