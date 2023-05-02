<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gimnasio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
        <div id="iconos">
            <form action="./index.php" method="post">
        <?
        if(isset($_SESSION['nombre'])){
        ?>
         <button name="logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg></button>
        <?
        }else{
        ?>

        <button name="login"><img  src="./webroot/img/icons8-usuario-de-género-neutro-32.png" alt="usuario" class="icono"></button>
<?
        }
        ?>
        <button name="home"><img  src="./webroot/img/house.svg" alt="usuario" class="icono"></button>
            
        </form>
        </div>
    </header>
    <?
        if(isset($_SESSION['nombre'])){
        ?>
    <nav>
        <form action="./index.php" method="post">
            <button name="clase">Clase</button>
            <button name="evento">Eventos</button>
            <button name="rutina">Rutina</button>
            <button name="ejercicio">Ejercicio</button>
        </form>
    </nav>
    <?
        }
    ?>
<main>
    <? require $_SESSION['vista']; ?>
</main>
</body>

