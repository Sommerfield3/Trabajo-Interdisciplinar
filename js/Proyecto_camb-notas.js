console.clear();

const isEmpty = (str) => str.trim() === '';


function agregar () {
	var nombrenota = document.getElementById('nombrenewnota');
	var notaSuperiornota = document.getElementById('notaSuperiornewnota');
	var porcentajenota = document.getElementById('porcentajenewnota');

	nombreVal = nombrenota.value;
	notaSuperiorVal = notaSuperiornota.value;
	porcentajeVal = porcentajenota.value;

	tablaEstudiantes = document.getElementById('tablaEstudiantes');

	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	} else {
		ajax = ActiveXObject("Microsoft.XMLHttpPRequest")
	}

	ajax.onreadystatechange = function() {
        if(ajax.readyState == 4 && ajax.status == 200) {
            contenido.innerHTML = ajax.responseText;
        } else {
            contenido.innerHTML = "<img width='50' height= '50' src='../resources/cargando.gif'>"
        }
    }

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const clase = urlParams.get('clase');

    ajax.open("POST", "../php/insertar_campo_nota.php?clase=" + clase);
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("nombre=" + nombreVal + "&notaSuperior=" + notaSuperiorVal + "&porcentaje=" + porcentajeVal);
}

function asignar() {
    btnAgregar = document.getElementById('btnAgregar');
    btnAgregar.addEventListener("click", agregar);
};

window.addEventListener("load", asignar);