
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/ingreso.css" rel="stylesheet">

 
<?php 
 
session_start();
if(!isset($_SESSION['registrado'])){  ?>
    
    
    
    <div id="formLogin" class="container">

      <form  class="form-ingreso " onsubmit="validarLogin();return false;">
        <!--Gracias a los script que estan en el html index.html llega al validarLogin que esta en funcionesAjax -->
        <h2 class="form-ingreso-heading">Ingrese sus datos</h2>
        <label for="correo" class="sr-only">Nombre</label>
        <input type="text" id="nombre" class="form-control" placeholder="Nombre" required="" autofocus="" value="<?php  if(isset($_COOKIE["registro"])){echo $_COOKIE["registro"];}?>">
        <label for="clave" class="sr-only">Clave</label>
        <input type="password" id="clave" minlength="4" class="form-control" placeholder="Clave" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="recordarme" checked> Recordame
          </label>
          <br>
          Ejemplo:
          mail: LEANDRO
          password: 1234
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      
      </form>



    </div> <!-- /container -->

  <?php }else if($_SESSION['registrado']->tipo == "ADMIN")
  
        {    echo"<h3>Bienvenido '".$_SESSION['registrado']->nombre."' </h3>";?>         

			  
        <button onclick="GestionEmp()" class="btn btn-lg btn-danger btn-block" type="button">Gestion Empleados<br> 
        <button onclick="deslogear()" class="btn btn-lg btn-danger btn-block" type="button">Reportes<br>
			  <button onclick="deslogear()" class="btn btn-lg btn-danger btn-block" type="button"><span class="glyphicon glyphicon-off">&nbsp;</span>Deslogearme</button>
	

			<form id="searchform">
			<input type="search" id="usuario" readonly placeholder="Sin Usuario"> 
  
  
 
 
  <?php  }else{ 
    
              echo"<h3>A laburar '".$_SESSION['registrado']->nombre."'  </h3>";?>         

			  
        <button onclick="FormIngVeh()" class="btn btn-lg btn-danger btn-block" type="button">Ingreso Vehiculos<br> 
        <button onclick="FormSalidaVeh()" class="btn btn-lg btn-danger btn-block" type="button">Salida Vehiculos<br>
			  <button onclick="deslogear()" class="btn btn-lg btn-danger btn-block" type="button"><span class="glyphicon glyphicon-off">&nbsp;</span>Deslogearme</button>
	

			<form id="searchform">
			<input type="search" id="usuario" readonly placeholder="Sin Usuario"> 
  




  
 <?php  }  ?>