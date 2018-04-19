
$("#listado_usuarios").ready(function(){

	datos_aenviar = {
		"tipo_query": "1"
	}

	url = 'action_test';
	tipo = 'POST';

	enviando_conajax(datos_aenviar, url, tipo);

});

function buscar_usuario(){
	busqueda = document.getElementById("text_search"); //input text de la búsqueda
	filtro_may = busqueda.value.toUpperCase();
	tabla_comuna = document.getElementById("listado_usuarios"); //tabla donde están los usuarios.
	element_tr = tabla_comuna.getElementsByTagName("tr");

	select = document.getElementById('select_filter'); //select de la búsqueda

	if(select.value == "0"){ return; } //si no selecciona opción, nos salimos de la función.
	if(select.value == "1"){ n = 0; } //buscamos por Nombre.
	if(select.value == "2"){ n = 1; } //buscamos por Apellido.
	if(select.value == "3"){ n = 2; } //buscamos por Fono.

	//console.log(element_tr.length);

	for(i = 1; i < element_tr.length; i++){
		element_td = element_tr[i].getElementsByTagName("td")[n];

		if(element_td){
			if(element_td.innerHTML.toUpperCase().indexOf(filtro_may) > -1){
				element_tr[i].style.display = "";
			}else{
				element_tr[i].style.display = "none";				
			}
		}
	}	
}

$("#create_user").click(function(){
	var nombre = $("#user_name_crea").val();
	var apellido = $("#user_ape_crea").val();
	var fono = $("#user_fono_crea").val();

	datos_aenviar = {
		"tipo_query" : "3",
		//rescato los valores
		"name_user" :  nombre,
		"apellido_user" : apellido,
		"fono_user" : fono
	}

	url = "action_test";
	tipo = "POST";

	enviando_conajax(datos_aenviar, url, tipo);

});

function modif_user(id_usuario){

	//realizamos la consulta para poder colocar los datos por el id de usuario.
	datos_aenviar ={
		"tipo_query": "2",
		"id_usuario": id_usuario
	}

	url = "action_test";
	tipo = "POST";

	enviando_conajax(datos_aenviar, url, tipo);

	$("#mod_user").click(function(){
		var nombre = $("#user_name_modif").val();
		var apellido = $("#user_ape_modif").val();
		var fono = $("#user_fono_modif").val();

		datos_aenviar = {
			"tipo_query" : "4",
			"id_usuario" : id_usuario,
			//rescato los valores
			"name_user" :  nombre,
			"apellido_user" : apellido,
			"fono_user" : fono
		}

		url = "action_test";
		tipo = "POST";

		enviando_conajax(datos_aenviar, url, tipo);
			
	});

}



function elim_user(id_usuario){
	
	//cuando el boton "Deshabilitar" sea presionado, ejecutará una acción
	$("#desh_user").click(function(){

		datos_aenviar = {
			"tipo_query" : "5",
			"id_usuario" : id_usuario
		}

		url = "action_test";
		tipo = "POST";

		enviando_conajax(datos_aenviar, url, tipo);

	});

}


function enviando_conajax(datos_aenviar, url, tipo){
	
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: datos_aenviar,
		url: url,
		type: tipo,
		success: function(resp){
			//con un switch case comprobamos el tipo de consulta que se está haciendo y lo que se quiere hacer en cada caso.
			switch (datos_aenviar.tipo_query){
				case "1":
				//listado de usuarios
				obj = JSON.parse(resp);
				cont = obj.cantidad_usuarios;
				for(i = 0; i < cont; i++){
					//boton modificar
					boton_mod = "<button type='submit' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modificar_usuario' onclick='modif_user("+obj.usuarios[i].id+");'><i class='fas fa-edit'></i></button>";
					//boton eliminar
					boton_eli = "<button type='submit' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deshabilitar_usuario' onclick='elim_user("+obj.usuarios[i].id+");'><i class='fas fa-times'></i></button>";
					//elementos agregados
					$("#listado_usuarios").append("<tr align='center'><td>"+obj.usuarios[i].nombre+"</td><td>"+obj.usuarios[i].apellido+"</td><td>"+obj.usuarios[i].fono+"</td><td>"+boton_mod+boton_eli+"</td></tr>");
				}

				break;

				case "2":
				//consulta de usuario por id
				obj = JSON.parse(resp);
				$("#user_name_modif").val(obj.datos_user[0].nombre);
				$("#user_ape_modif").val(obj.datos_user[0].apellido);
				$("#user_fono_modif").val(obj.datos_user[0].fono);

				break;

				case "3":
				//ingresar usuario
				if(resp > "1"){
					$("#create_user").css({"display":"none"});
					$("#exit_create_user").css({"display":"none"});
					$("#alert_ucrea").css({"display":"block"});
				}

				setTimeout(function(){
						location.reload();
					}, 2000);	

				break;

				case "4":
				//modificando usuario
				if(resp == "1"){
					$("#mod_user").css({"display":"none"});
					$("#exit_mod_user").css({"display":"none"});
					$("#alert_umod").css({"display":"block"});
				}

				setTimeout(function(){
						location.reload();
					}, 2000);

				break;

				case "5":
				//deshabilitar usuario
				if(resp == "1"){
					$("#desh_user").css({"display":"none"});
					$("#exit_desh_user").css({"display":"none"});
					$("#alert_udesh").css({"display":"block"});
				}

				setTimeout(function(){
						location.reload();
					}, 2000);

				break;
			}
		},
		error: function(resp){
			console.log("Detalle del error en la conexion: "+resp);
		},
	});

}
