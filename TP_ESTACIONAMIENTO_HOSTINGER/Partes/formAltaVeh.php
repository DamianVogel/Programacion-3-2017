
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">
<?php 
session_start();
if(isset($_SESSION['registrado'])){  ?>
    <div class="container">

        
      <form class="form-ingreso" onsubmit="IngVehBD();return false" enctype="multipart/form-data" id="formIngVeh">
        <button onclick="FormSalidaVeh()" class='btn btn-lg btn-success btn-block' > <span class='glyphicon'></span>VEHICULOS ESTACIONADOS</button>
        <h2 class="form-ingreso-heading">ALTA DE VEHICULO</h2>
        
        <label for="patente"  class="sr-only">Patente</label>
        <input type="text"   id="patente" title="Patente que ingresa" class="form-control" placeholder="Patente que ingresa" required="" autofocus="">
        
        <label for="color"  class="sr-only">Color</label>
        <input type="text"    id="color" title="El color del vehiculo"  class="form-control" placeholder="Color del vehiculo" required="" autofocus="">
        
        <label for="marca" class="sr-only">Marca</label>
        <input type="text"  title="Marca del vehiculo"  id="marca" class="form-control" placeholder="Marca" required="" autofocus="">

        
          <button  class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-floppy-save">&nbsp;&nbsp;</span>Guardar </button>
      
      </form>

    </div> <!-- /container -->

  <?php }else{    echo"<h3>usted no esta logeado. </h3>";?>         
   
  <?php  }  ?>
    
  
