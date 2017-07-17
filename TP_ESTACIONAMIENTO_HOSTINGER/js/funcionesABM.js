


function BorrarEmp(idParametro)
{
	alert("Estoy en Borrar Emp y quiero borrar el emp "+idParametro);

		var funcionAjax=$.ajax({
		url:"http://damianvogel.esy.es/borrarEmp",
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
	
	var aux = "http://damianvogel.esy.es/modEmp/"
	
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
		url:"http://damianvogel.esy.es/altaEmp",
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
		url:"http://damianvogel.esy.es/update",
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


//VEHICULOS


//DV
function IngVehBD()
{

	var datosDelForm = new FormData("formIngVeh");
	//console.info(file);

	

	var patente=$("#patente").val();
	var color=$("#color").val();
	var marca=$("#marca").val();
	
	datosDelForm.append("patente",patente);
	datosDelForm.append("color",color);
	datosDelForm.append("marca",marca);		
	
	d = Date().split(" ");
 	var hora = d[4]	
	datosDelForm.append("hora",hora);

	var funcionAjax=$.ajax({
		url:"http://damianvogel.esy.es/IngVehBD",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){
		
		alert(respuesta);
		
		$("#patente").val("");
		$("#color").val("");
		$("#marca").val("");
		
		
		
		

	},function(error){

			$("#informe").html(error.responseText);
			console.info("error", error);

	});
	
}


