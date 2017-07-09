<script type="text/javascript" src="js/funcionesABM.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<?php 
session_start();
if(isset($_SESSION['registrado']))
{
	
	
	$arrayDeEmp=Usuario::TraerTodosLosusuarios();
	echo "<h2> Bienvenido: ". $_SESSION['registrado']."</h2>";

 ?>


<button onclick="FormAltaEmp()" class='btn btn-lg btn-success btn-block' > <span class='glyphicon glyphicon-floppy-save'>&nbsp;&nbsp;</span>ALTA DE NUEVOS EMPLEADOS </button>
<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Editar</th><th>Borrar</th><th>Nombre</th><th>Turno</th><th>Estado</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeEmp as $emp) {
	if($emp->tipo == "EMPLEADO")
	{
	echo"<tr>
			<td><a onclick='EditarEmp($emp->id_empleado)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
			<td><a onclick='BorrarEmp($emp->id_empleado)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
			<td>$emp->nombre</td>
			<td>$emp->turno</td>
			<td>$emp->estado</td>
			
		</tr>   ";

	}
}
		 ?>
	</tbody>
</table>

<?php 	}else	{
		echo "<h4 class='widgettitle'>No estas registrado</h4>";
	}

	 ?>