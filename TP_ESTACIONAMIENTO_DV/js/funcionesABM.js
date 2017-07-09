


function BorrarEmp(idParametro)
{
	alert("Estoy en Borrar Emp y quiero borrar el emp "+idParametro);

		var funcionAjax=$.ajax({
		url:"http://localhost/Programacion-3-2017/TP_ESTACIONAMIENTO_DV/borrarEmp",
		type:"delete",
		data:{
			//queHacer:"BorrarCD",
			id:idParametro	
		}
	});
	funcionAjax.done(function(retorno){
		GestionEmp();
		$("#informe").html("cantidad de eliminados "+ retorno);	
		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
}

function EditarEmp(idParametro)
{
	
	var aux = "http://localhost/Programacion-3-2017/TP_ESTACIONAMIENTO_DV/modEmp/"
	
	var destino = aux.concat(idParametro);	

	var funcionAjax=$.ajax({
		url:destino,
		type:"post",
		data:{
			//queHacer:"TraerCD",
			id:idParametro	
		}
	});
	funcionAjax.done(function(retorno){
		
		$("#principal").html(retorno);
		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
	
	


}

function AltaEmp()
{

	alert("estoy en el alta de empleado");
	
	var datosDelForm = new FormData("formAltaEmp");
	//console.info(file);

	
	var nombre=$("#nombre").val();
	var turno=$("#turno").val();
	var password=$("#password").val();
	var estado=$("#estado").val();

	
	datosDelForm.append("nombre",nombre);
	datosDelForm.append("turno",turno);
	datosDelForm.append("estado",estado);		
	datosDelForm.append("password",password);		
		

	var funcionAjax=$.ajax({
		url:"http://localhost/Programacion-3-2017/TP_ESTACIONAMIENTO_DV/altaEmp",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){
		alert("Agregado correctamente");
		GestionEmp();
		
		
		

	},function(error){

			$("#informe").html(error.responseText);
			console.info("error", error);

	});
	
}

function UpdateEmp()
{

		
	var datosDelForm = new FormData("formEmp");
		
	var nombre=$("#nombre").val();
	var id=$("#idEmp").val();
	var turno=$("#turno").val();
	var estado=$("#estado").val();


	datosDelForm.append("nombre",nombre);
	datosDelForm.append("id",id);
	datosDelForm.append("turno",turno);
	datosDelForm.append("estado",estado);		
		

	var funcionAjax=$.ajax({
		url:"http://localhost/Programacion-3-2017/TP_ESTACIONAMIENTO_DV/update",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){

		alert("Modificado correctamente");
		GestionEmp();
		$("#informe").html(respuesta);	
		

	},function(error){

			$("#informe").html(error.responseText);
			console.info("error", error);

	});
	
}