
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">
<?php 
session_start();
if(isset($_SESSION['registrado'])){  ?>
    <div class="container">

      <form class="form-ingreso" onsubmit="AltaEmp();return false" enctype="multipart/form-data" id="formAltaEmp">
        <h2 class="form-ingreso-heading">ALTA DE EMPLEADO</h2>
        
        <label for="nombre"  class="sr-only">Nombre</label>
        <input type="text"   id="nombre" title="Se necesita un nombre" class="form-control" placeholder="Nombre del empleado" required="" autofocus="">
        
        <label for="turno"  class="sr-only">Turno</label>
        <input type="text"    id="turno" title="Turno que ocupara el empleado"  class="form-control" placeholder="Turno" required="" autofocus="">
        
        <label for="password" class="sr-only">Clave</label>
        <input type="text"  title="ultra secret"  id="password" class="form-control" placeholder="Password" required="" autofocus="">

        <label for="estado" class="sr-only">Estado</label>
        <input type="text"  title="Habilitado / Deshabilitado"  id="estado" class="form-control" placeholder="Estado" required="" autofocus="">
        
       
        
          <button  class="btn btn-lg btn-success btn-block" type="submit"><span class="glyphicon glyphicon-floppy-save">&nbsp;&nbsp;</span>Guardar </button>
      
      </form>

    </div> <!-- /container -->

  <?php }else{    echo"<h3>usted no esta logeado. </h3>";?>         
   
  <?php  }  ?>
    
  
