const isEmpty = (str) => str.trim() === '';

function acceder() {
	var usua = document.getElementById('usuario');
	var clav = document.getElementById('clave');

	usuaVal = usua.value;
	clavVal = clav.value;

	if (isEmpty(usuaVal) || isEmpty(clavVal)) {
		alert('Todos los campos son obligatorios');
		return;
	}

	var contenido = document.getElementById("mensaje");

    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    } else {
        ajax = new ActiveXObject("Microsoft.XMLHTTP")
    }

    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            if(ajax.responseText.trim() == "OK") {
            	window.location.href = "../php/Portada.php";
            } else {
            	contenido.innerHTML = ajax.responseText;
            }
        }
    }

    ajax.open("POST", "../php/validar_login.php");
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("usuario=" + usuaVal + "&clave=" + clavVal);
};

function asignar() {
    btnAcceder = document.getElementById('btnAcceder');
    btnAcceder.addEventListener("click", acceder);
};

window.addEventListener("load",asignar);