
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">
<?php 
session_start();
if(isset($_SESSION['registrado'])){  ?>
    <div class="container">

      <form class="form-ingreso" onsubmit="UpdateCD();return false" enctype="multipart/form-data" id="formcd">
        <h2 class="form-ingreso-heading">MODIFICACION</h2>
        <label for="cantante" value="natalia" class="sr-only">Cantante</label>
        <input type="text"  minlength="6"  id="cantante"  title="Se necesita un nombre de cantante" class="form-control" placeholder="Cantante" required="" autofocus="">
        <label for="titulo" value="un titulo" class="sr-only">Titulo</label>
        <input type="text"  minlength="6"  id="titulo" title="Se necesita un titulo del disco"  class="form-control" placeholder="Titulo" required="" autofocus="">
        <label for="anio" class="sr-only">Año</label>
        <input type="number" value=2000  min="1900" title="Un año entre 1900 y hoy"  max="2099" id="anio" class="form-control" placeholder="año" required="" autofocus="">
       <input readonly   type="hidden"    id="idCD" class="form-control" >
       <input type="file" id="foto" name="foto" >
        <button  class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-floppy-save">&nbsp;&nbsp;</span>Modificar </button>
      
      </form>

    </div> <!-- /container -->

  <?php }else{    echo"<h3>usted no esta logeado. </h3>";?>         
   
  <?php  }  ?>
    