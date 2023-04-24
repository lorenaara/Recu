

<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./webroot/img/uno.jpg" alt="Los Angeles" class="d-block" style="width:100%; height:600px">
    </div>
    <div class="carousel-item">
      <img src="./webroot/img/tres.jpg" alt="Chicago" class="d-block" style="width:100%; height:600px">
    </div>
    <div class="carousel-item">
      <img src="./webroot/img/dos.jpg" alt="New York" class="d-block" style="width:100%; height:600px">
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<?
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}

foreach ($evento as $objetoEvento) {?>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><? echo $objetoEvento->nombre ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><b>Plazas: </b><? echo $objetoEvento->plazas ?></h6>
    <p class="card-text"><? echo $objetoEvento->descripcion?></p>
    <p class="card-text"><b>Fecha inicio</b> <? echo $objetoEvento->f_inicio?></p>
    <p class="card-text"><b>Fecha fin</b> <? echo $objetoEvento->f_fin?></p>
  </div>
  <?
}
?>


</div>