console.clear();

const isEmpty = (str) => str.trim() === '';

function emailValid(em) {
    for (var i = 0; i < em.length; i++) {

        if (em[i] == '@') {

            for (var j = i+1; j < em.length; j++) {
                if (em[j] == '.') {
                    return true;
                }
            }
            return false;

        } else if (em[i] == '.') {

            for (var j = i+1; j < em.length; j++) {
                if (em[j] == '@') {
                    return true;
                }
            }
            return false;

        }
        if (i == em.length-2) {
            return false;
        }

    }
}

function agregar () {
	var dni = document.getElementById('dni');
	var nombre = document.getElementById('nombre');
	var apellidos = document.getElementById('apellido');
	var email = document.getElementById('email');
	var telefono = document.getElementById('telefono');

	dniVal = dni.value;
	nombreVal = nombre.value;
	apellidosVal = apellidos.value;
	emailVal = email.value;
	telefonoVal = telefono.value;

	tablaUsuarios = document.getElementById('tablaUsuarios');

	if ( isEmpty(dniVal) || isEmpty(nombreVal) || isEmpty(apellidosVal) || isEmpty(emailVal) || isEmpty(telefonoVal)) {
		alert( 'ERROR! Todos los campos son OBLIGATORIOS!' );
		return;
	}

	if (dniVal.length < 9) {
        alert('ERROR! El DNI ingresado no es válido');
        return;
    }

	if (nombreVal.length < 3) {
        alert('ERROR! El nombre ingresado no es válido');
        return;
    }

    if (apellidoVal.length < 3) {
        alert('ERROR! El apellido ingresado no es válido');
        return;
    }

    if (telefonoVal.length < 9) {
    	alert('ERROR! El telefono ingresado no es válido');
    	return;
    }

    if (emailValid(emailVal) == false) {
        alert('ERROR! El email ingresado no es válido');
        return;
    }
};

function asignar() {
	btnTomarAssist = document.getElementById('btnTomarAssist');
	btnTomarAssist.addEventListener("click", agregar);
};

window.addEventListener("load", asignar);