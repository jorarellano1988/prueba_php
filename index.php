<?php



include("./includes/config.php");

if ($_POST["f_accion"]=="GUARDAR")
{
	// echo "aca";
	echo $_POST["nombre"];
	echo "<br>";
	echo $_POST["alias"];
	echo "<br>";
	echo $_POST["rut"];
	echo "<br>";
	echo $_POST["email"];
	echo "<br>";
	echo $_POST["region"];
	echo "<br>";
	echo $_POST["comuna"];
	echo "<br>";
	echo $_POST["candidato"];
	echo "<br>";
	// echo $_POST["type"];
	if(isset($_POST['type'])){
		if(in_array('Web', $_POST['type'])){
			echo "Web was checked!";
		}
		if(in_array('TV', $_POST['type'])){
			echo "TV was checked!";
		}
		if(in_array('Redes Sociales', $_POST['type'])){
			echo "Redes Sociales was checked!";
		}
		if(in_array('Amigo', $_POST['type'])){
			echo "Amigo was checked!";
		}
		
	}
	
}

?>

<html>
<head>
<script src="jquery-1.11.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

</head>
	<body>



		<table>

		<script type="text/javascript">

			function ValidaCandidato(str) {

				console.log(str.value);
				
			}

			function contarNumeros( str ) {	
			var acu = 0,
				withoutSpaces = str.replace( /\s/g, '' ).length;

			Array.prototype.forEach.call( str, function( val ) {
				acu += ( val.charCodeAt( 0 ) > 47 ) && ( val.charCodeAt( 0 ) < 58 ) ? 1 : 0;
			} );

			return acu;

			}

			function contarLetras( str ) {
			var acu = 0,
				withoutSpaces = str.replace( /\s/g, '' ).length;

			Array.prototype.forEach.call( str, function( val ) {
				acu += ( val.charCodeAt( 0 ) > 47 ) && ( val.charCodeAt( 0 ) < 58 ) ? 1 : 0;
			} );

			return withoutSpaces - acu;

			}

			function ValidarNumeroYLetra(str)
			{
				var cantidad_num=contarNumeros(str.value);
				var cantidad_letras=contarLetras(str.value);

				if(str.value.length < 5 )
				{
					// alert("Favor ingresar Alias con un minimo de 5 caracteres");
					str.setCustomValidity("Favor ingresar Alias con un minimo de 5 caracteres");
					return false;
					// event.preventDefault();
				}

				if(cantidad_num ==0 || cantidad_letras==0)
				{
			
					str.setCustomValidity("Campo Alias debe contener caracteres y numeros");
					return false;
					// event.preventDefault();
				}

				str.setCustomValidity('');
			}


			function ValidaRut(rut) {

				// console.log("rut",rut);
			// Despejar Puntos
			var valor = rut.value.replace('.','');
			// Despejar Guión
			valor = valor.replace('-','');

			// Aislar Cuerpo y Dígito Verificador
			cuerpo = valor.slice(0,-1);
			dv = valor.slice(-1).toUpperCase();

			// Formatear RUN
			rut.value = cuerpo + '-'+ dv

			// Si no cumple con el mínimo ej. (n.nnn.nnn)
			if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}

			// Calcular Dígito Verificador
			suma = 0;
			multiplo = 2;

			// Para cada dígito del Cuerpo
			for(i=1;i<=cuerpo.length;i++) {

				// Obtener su Producto con el Múltiplo Correspondiente
				index = multiplo * valor.charAt(cuerpo.length - i);
				console.log("index",index);
				// Sumar al Contador General
				suma = suma + index;

				// Consolidar Múltiplo dentro del rango [2,7]
				if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

				}

				console.log("suma",valor);

				// Calcular Dígito Verificador en base al Módulo 11
				dvEsperado = 11 - (suma % 11);

				// Casos Especiales (0 y K)
				dv = (dv == 'K')?10:dv;
				dv = (dv == 0)?11:dv;

				// Validar que el Cuerpo coincide con su Dígito Verificador
				if(dvEsperado != dv) 
				{ 
					rut.setCustomValidity("RUT Inválido");
					return false;
				}

				// Si todo sale bien, eliminar errores (decretar que es válido)
				rut.setCustomValidity('');
			}
	
	

		function valideKey(evt){
			
			// code is the decimal ASCII representation of the pressed key.
			var code = (evt.which) ? evt.which : evt.keyCode;
			// console.log(code);
			if(code==8) { // backspace.
			  return true;
			} else if(code>=48 && code<=57 || code==107 || code==45) { // is a number.
			  return true;
			}
			// else if(code=75 )
			// {
			// 	return true;
			// }
			else{ // other keys.
			  return false;
			}
		}
		</script>

		<form name="votar" id="votar" method="post">
		<input type="hidden" name="f_accion" value="GUARDAR">

			<th>Formulario De Votacion</th>
			<tr>
				<td>Nombre y Apellido</td>
				<td><input type="text" id="nombre" name="nombre" style="width:200px" autocomplete="off"
				required /></td>
			</tr>

			<tr>
				<td>Alias</td>
				<td><input type="text" id="alias" name="alias" style="width:200px" autocomplete="off"
				required 
				oninput="ValidarNumeroYLetra(this)" 
				/></td>
			</tr>

			<tr>
				<td>RUT</td>
				<td><input type="text" id="rut" name="rut" style="width:200px" placeholder="11111111-1" 
				autocomplete="off" required="" 
				oninput="ValidaRut(this)" onkeypress="return valideKey(event);" 
				
				/></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><input type="email" id="email" name="email" style="width:200px" autocomplete="off"
				required /></td>
			</tr>

			<tr>
				<td>Region</td>
				<td><select id="region" name="region" style="width:200px" required>
						<option value="">Seleccione Region:</option>
						
							<?php

							$sql="
							SELECT regi_id,regi_nombre FROM region						 
						 	 "; 

							$cad=mysqli_query($conn,$sql) or die(mysqli_error($conn));

							while ($xDato = mysqli_fetch_array($cad))
							{
								echo '<option value="'.$xDato["regi_id"].'">'.$xDato["regi_nombre"].'</option>';
							}

							?>

						?> 
					</select>
				</td>
			</tr>

			<tr>
				<td>Comuna</td>
				<td><select id="comuna" name="comuna" style="width:200px" required>
						<option value="">Seleccione Comuna:</option>
						
					</select>
				</td>
			</tr>

			<tr>
				<td>Candidato</td>
				<td><select id="candidato" name="candidato" style="width:200px" required>
						<option value="">Seleccione Candidato:</option>
						
					</select>
				</td>
			</tr>

			<tr>
				<td>Como se entero de Nosotros</td>
					<td>
					<div class="form-group options">
						<input type="checkbox" name="type[]" value="Web"   /> Web
						<input type="checkbox" name="type[]" value="TV"   /> TV
						<input type="checkbox" name="type[]" value="Redes Sociales"   /> Redes Sociales
						<input type="checkbox" name="type[]" value="Amigo"  />Amigo						
					</div>  
				
				</td>
			</tr>

			<tr>
				<td><button type="submit" class="votar_accion" name="votar" id="votar">Votar</button></td>
			</tr>


		</table>
		</form>
		
		<script>
		$(document).ready(function(){

			$(function() {
			var checkboxes = $("input[name='type[]']");
			checkboxes.on("change", function(e) 
			{
				// console.log("h", $(this.form).serialize())
				// console.log(checkboxes.filter(":checked"));

				checkboxes[0].setCustomValidity(checkboxes.filter(":checked").length>=2 ? '' : 'Favor seleccionar minimo 2 Opciones')
				}).change()
			})


			$.ajax({			
									
			type: "POST",						
			dataType: "json",						
			url: "ajax/carga_candidato.php",
			})
			.done(function( data, textStatus, jqXHR ) {

				// console.log(data);

				$.each(data,function(key, registro) {
	
					$("#candidato").append('<option value='+registro.cli_id+'>'+registro.nombre+'</option>');
				}); 

			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
				if ( console && console.log ) {
					console.log( "La solicitud a fallado: " +  textStatus);
				}
			});


			

			
			$('input[name="alias"]').bind('keypress', function(e) {
			var keyCode = (e.which) ? e.which : event.keyCode
			// console.log("keycode",keyCode);
			return !(keyCode > 31 && (keyCode < 48 || keyCode > 90) && (keyCode < 97 || keyCode > 122));
			});


			$(document).on('change', '#region', function() {

				var region_id=$('select[id=region]').val();
				$("#comuna").empty();
				$("#comuna").append('<option value="">Seleccione Comuna:</option>');

				console.log(region_id);

						$.ajax({
						
						data: {region_id : region_id},						
						type: "POST",						
						dataType: "json",						
						url: "ajax/comunas.php",
					})
					.done(function( data, textStatus, jqXHR ) {

						console.log(data);

						$.each(data,function(key, registro) {
							// console.log(registro.comu_id);
							// console.log(registro.comu_nombre);
							$("#comuna").append('<option value='+registro.comu_id+'>'+registro.comu_nombre+'</option>');
						}); 

					})
					.fail(function( jqXHR, textStatus, errorThrown ) {
						if ( console && console.log ) {
							console.log( "La solicitud a fallado: " +  textStatus);
						}
					});
			});

			
			

			// 	var nombre=$("#nombre").val();
			// 	var alias=$("#alias").val();
			// 	var rut=$("#rut").val();

			// 	// if(nombre== "")
			// 	// {
			// 	// 	alert("Favor ingresar nombre");
			// 	// 	event.preventDefault();
			// 	// }

			// 	console.log("numero",contarNumeros(alias));
			// 	console.log("letras",contarLetras(alias));
			// 	console.log("rut",Fn.validaRut(rut));

			// 	if(Fn.validaRut(rut)==false)
			// 	{
			// 		alert("Favor ingresar Rut Valido");
			// 		event.preventDefault();
			// 	}

			// 	if(alias.length < 5 )
			// 	{
			// 		alert("Favor ingresar Alias con un minimo de 5 caracteres");
			// 		event.preventDefault();
			// 	}

			// 	if(contarNumeros(alias)==0 || contarLetras(alias)==0)
			// 	{
			// 		alert("Campo Alias debe contener caracteres y numeros");
			// 		event.preventDefault();
			// 	}

				
			// 	// console.log("nombre",nombre)
			// 	event.preventDefault();

			// });


		});
		</script>
	</body>
</html>
