/* Boton que lleva al informe */
const btn = document.getElementById("btnInforme")
btn.addEventListener("click",e=>{
    /* Se obtiene la clase */
    let clase = btn.classList[0].slice(1,-1),

    /* Se obtienen las tablas de asistencia, cursos y calificaciones */
    tablaAsistencia = recibirDatos(clase,"getTablaAsistencia"),
    tablaCurso = recibirDatos(clase,"getTablaCurso"),
    tablaCalificaciones = recibirDatos(clase,"getTablaCalificaciones");
    tablaDatos = recibirDatos(clase,"getTablaDatos");    
    
    /* Se envian los datos obtenidos */
    enviarDatos(tablaAsistencia,tablaCurso,tablaCalificaciones,tablaDatos)
})  

/* Función para enviar datos */
async function enviarDatos(tablaAsistencia,tablaCurso,tablaCalificaciones,tablaDatos){    

    let param1 = await getAbandonos(tablaAsistencia),
    param2 = await getAsistenciaPorClase(tablaAsistencia),
    param3 = await getNumeroClases(tablaCurso),
    param4 = await getAprobados(tablaCalificaciones),
    param5 = await getDatosCalificaciones(tablaCalificaciones,tablaDatos)

    window.location.href = "../graphs/reporte.php" + 
        "?totalAsistencia=" + JSON.stringify(param1) + 
        "&asistenciaPorClase=" + JSON.stringify(param2) + 
        "&numeroClases=" + JSON.stringify(param3) + 
        "&calificacionesFinales=" + JSON.stringify(param4) + 
        "&datosCalificaciones=" + JSON.stringify(param5);
}

/* Función para recibir datos */
async function recibirDatos(clase,archivo){
    try{
        /* Se necesita del archivo al que queremos acceder y también la correspondiente clase */
        const response = await fetch(`../php/getInfo/${archivo}.php?clase=${clase}`)
        const data = await response.json()
        return data;
    }catch(err){
        console.error(err);
    }
}

/* Función para obtener la cantidad de alumnos en situación de abandono */
async function getAbandonos(tablaAsistencia){

    /* Se inicializan los valores en cero */
    let array = [
        {
            label: "Abandonos",
            y: 0
        },{
            label: "Asistentes",
            y: 0
        }
    ]

    tablaAsistencia.then(data => {
        data.forEach(alumno => {
            /* 
                Contador que alamcenará el número de clases asistidas
                en el semestre por alumno
            */
            let contadorAsistencias = 0;
            for(const [key,value] of Object.entries(alumno)){
                if(key != "cui"){
                    if(value == 'P') contadorAsistencias++;
                }
            }
            contadorAsistencias == 0 ? array[0].y++ : array[1].y++
        })
    })

    return array;

}

/* Función para obtener cantidad de asistentes y ausentes por clase */
async function getAsistenciaPorClase(tablaAsistencia){
    let array = [];
    
    await tablaAsistencia.then(data => {

        /* Se obtienen las fechas */

        const fechas = Object.keys(data[0]).slice(1)

        /* 
            Incialiamos el arreglo con objetos que guarden los siguentes datos:
            - fecha (extraida anteriormente)
            - presentes (inicializado en cero)
            - ausentes (inicializado en cero)
        */
        fechas.forEach(fecha => {
            let obj = {
                fecha: fecha,
                presentes: 0,
                faltos: 0
            }
            array.push(obj)
        })

        data.forEach(alumno => {
            /* Se evalua si esta presente o ausente */
            array.forEach(obj => {
                alumno[obj.fecha] == 'P' ? obj.presentes++ : obj.faltos++
            })
        })
    })

    return array
}

/* Función que obtiene el número de clases tomadas en el semestre */
async function getNumeroClases(tablaCurso){

    /* Número de clases totales posibles (aproximación) */
    const clases = 17; 


    let array = [{
        label: "",
        y: 0
    },{
        label: "",
        y: 0
    },{
        label: "Clases totales",
        y: clases
    }];


    await tablaCurso.then(data => {
        
        /* Se construye el arreglo con dos objetos */

        array[0].label = "Clases Realizadas"
        array[0].y = parseInt(data[0].total_Horas)

        array[1].label = "Clases no Realizadas"
        array[1].y = clases - parseInt(data[0].total_Horas)
        
    })

    return array

}

/* Función que obtiene el número de aprobados y desaprobados */
async function getAprobados(tablaCalificaciones){
    
    /* Se incializa el arreglo de objetos */
    let array = [
        {
            label: "Aprobados",
            y: 0
        },
        {
            label: "Desaprobados",
            y: 0
        },
        {
            label: "Sin nota",
            y: 0
        }
    ]

    await tablaCalificaciones.then(data => {
        data.forEach(nota => {
            /* NF: nota final, si esta es mayor a 11 esta aprobado */
            if(nota.NF){
                if(nota.NF >= 11) array[0].y++
                else array[1].y++
            }else{
                /* Sino no tiene nota final */
                array[2].y++;
            }
        })
    })

    return array
}


/* Funcion para obtener otros datos sobre califaciones */
async function getDatosCalificaciones(tablaCalificaciones,tablaDatos){
    let calificaciones = await tablaCalificaciones
    let datos = await tablaDatos

    calificaciones.forEach((alumno,index) => {
        alumno["nombre"] = datos[index].nombre
        alumno["apellido"] = datos[index].apellido

    })

    return calificaciones
}