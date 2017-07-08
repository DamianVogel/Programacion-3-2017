


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

function GuardarCD()
{

	//alert("estoy en ajax de guardarCD");
	
	
	var inputFileImage = document.getElementById("foto");
	var file = inputFileImage.files[0];
	var datosDelForm = new FormData("formcd");
	//console.info(file);

	
	var titulo=$("#titulo").val();
	var id=$("#idCD").val();
	var cantante=$("#cantante").val();
	var anio=$("#anio").val();

	datosDelForm.append("foto",file);
	datosDelForm.append("titulo",titulo);
	datosDelForm.append("id",id);
	datosDelForm.append("cantante",cantante);
	datosDelForm.append("anio",anio);		
		
		

	var funcionAjax=$.ajax({
		url:"http://localhost/Programacion-3-2017/PracticaParcial/cd",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){
		alert("Agregado correctamente");
		
		//$("#informe").html("cantidad de agregados "+ respuesta);	
		
		$("#cantante").val("");
		$("#titulo").val("");
		$("#anio").val("");
		$("#foto").val("");
		//console.log("guardar cd");

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