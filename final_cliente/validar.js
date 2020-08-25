$(document).ready(function() {
    var boton1 = document.getElementById("botonlogin");
	$('#pass2').keyup(function() {

		var pass1 = $('#pass').val();
		var pass2 = $('#pass2').val();
		if ( pass1 == pass2 ) {
            $('#error2').text("Las contraseñan coinciden").css("color","green");
            boton1.disabled = false;
        } else {
            $('#error2').text("Las contraseñas no coinciden").css("color","red");
            boton1.disabled = true;
        }
        if(pass2 ==""){
            $('#error2').text("No se puede dejar en blanco").css("color","red");
            boton1.disabled = true;
        }
	});
});