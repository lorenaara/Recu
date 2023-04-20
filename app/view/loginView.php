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
    <input type="submit" value="Enviar" name="enviar">
    <div>
        <p>¿No tienes cuenta?</p><input type="submit" name="registro" value="Registrarse">
    </div>
</form>


