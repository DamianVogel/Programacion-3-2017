<script type="text/javascript" src="js/funcionesABM.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<?php 
session_start();
if(isset($_SESSION['registrado']) && $_SESSION['registrado']->tipo=="EMPLEADO")
{
	
	
	$arrayDeVehiculos=Vehiculo::TraerTodosLosVehiculos();
	echo "<h2> Bienvenido: ". $_SESSION['registrado']->nombre."</h2>";

 ?>


<button onclick="FormIngVeh()" class='btn btn-lg btn-success btn-block' > <span class='glyphicon glyphicon-floppy-save'>&nbsp;&nbsp;</span>INGRESAR NUEVA PATENTE </button>
<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Salida</th><th>Patente</th><th>Color</th><th>Marca</th>
		</tr>
	</thead>
	<tbody>

		<?php 

//var_dump($arrayDeVehiculos);
foreach ($arrayDeVehiculos as $veh) {
	
  

    
    if($veh->ESTADO == 1)
	{
	  echo"<tr>
			<td><a onclick='EditarEmp($veh->ID_VEHICULO)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Salida</a></td>
			
			<td>$veh->PATENTE</td>
			<td>$veh->COLOR</td>
			<td>$veh->MARCA</td>
			
		</tr>   ";



	}
}
		 ?>
	</tbody>
</table>

<?php 	}else	{
		echo "<h4 class='widgettitle'>No estas registrado como EMPLEADO</h4>";
	}

	 ?>