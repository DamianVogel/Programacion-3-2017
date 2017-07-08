<?php 
session_start();
if(isset($_SESSION['registrado']))
{
	
	
	$arrayDeEmp=Usuario::TraerTodosLosusuarios();
	echo "<h2> Bienvenido: ". $_SESSION['registrado']."</h2>";

 ?>


<table class="table"  style=" background-color: beige;">
	<thead>
		<tr>
			<th>Editar</th><th>Borrar</th><th>cantante</th><th>disco</th><th>año</th>
		</tr>
	</thead>
	<tbody>

		<?php 

foreach ($arrayDeEmp as $emp) {
	echo"<tr>
			<td><a onclick='EditarCD($emp->id_empleado)' class='btn btn-warning'> <span class='glyphicon glyphicon-pencil'>&nbsp;</span>Editar</a></td>
			<td><a onclick='BorrarCD($emp->id_empleado)' class='btn btn-danger'>   <span class='glyphicon glyphicon-trash'>&nbsp;</span>  Borrar</a></td>
			<td>$emp->nombre</td>
			<td>$emp->tipo</td>
			<td>$emp->estado</td>
			
		</tr>   ";
}
		 ?>
	</tbody>
</table>

<?php 	}else	{
		echo "<h4 class='widgettitle'>No estas registrado</h4>";
	}

	 ?>