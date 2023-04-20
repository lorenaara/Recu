<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
        <div id="iconos">
            <form action="./index.php" method="post">
            <button name="home"><img  src="./webroot/img/house.svg" alt="usuario" class="icono"></button>
            
            <button name="login"><img  src="./webroot/img/icons8-usuario-de-género-neutro-32.png" alt="usuario" class="icono"></button>
        </form>
        </div>
    </header>
    <nav>
        <form action="./index.php" method="post">
            <button name="clase">Clase</button>
            <button name="evento">Eventos</button>
            <button name="rutina">Rutina</button>
            <button name="ejercicio">Ejercicio</button>
        </form>
    </nav>
<main>
    <? require $_SESSION['vista']; ?>
</main>
</body>