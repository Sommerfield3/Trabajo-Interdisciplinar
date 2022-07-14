/* Boton que lleva al informe */
const btn = document.getElementById("btnInforme")
btn.addEventListener("click",e=>{
    /* Se obtiene la clase */
    let clase = btn.classList[0].slice(1,-1),

    /* Se obtienen las tablas de asistencia, cursos y calificaciones */
    tablaAsistencia = recibirDatos(clase,"getTablaAsistencia"),
    tablaCurso = recibirDatos(clase,"getTablaCurso"),
    tablaCalificaciones = recibirDatos(clase,"getTablaCalificaciones");
    
    /* Se envian los datos obtenidos */
    enviarDatos(tablaAsistencia,tablaCurso,tablaCalificaciones)
})  

/* Función para enviar datos */
async function enviarDatos(tablaAsistencia,tablaCurso,tablaCalificaciones){    

    let param1 = await getAbandonos(tablaAsistencia),
    param2 = await getAsistenciaPorClase(tablaAsistencia),
    param3 = await getNumeroClases(tablaCurso),
    param4 = await getAprobados(tablaCalificaciones)

    window.location.href = "../graphs/reporte.php" + 
        "?totalAsistencia=" + JSON.stringify(param1) + 
        "&asistenciaPorClase=" + JSON.stringify(param2) + 
        "&numeroClases=" + JSON.stringify(param3) + 
        "&calificacionesFinales=" + JSON.stringify(param4);
    
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
            category: "Abandonos",
            value: 0
        },{
            category: "Asistentes",
            value: 0
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
            contadorAsistencias == 0 ? array[0].value++ : array[1].value++
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

    return array;
}

/* Función que obtiene el número de clases tomadas en el semestre */
async function getNumeroClases(tablaCurso){
    let array = [];

    /* Número de clases totales posibles (aproximación) */
    const clases = 17; 

    tablaCurso.then(data => {
        
        /* Se construye el arreglo con dos objetos */
        let obj1 = {}
        obj1["category"] = "Clases Realizadas";
        obj1["value"] = parseInt(data[0].total_Horas);

        let obj2 = {}
        obj2["category"] = "Clases no Realizadas";
        obj2["value"] = clases - parseInt(data[0].total_Horas);

        array.push(obj1);
        array.push(obj2)
    })

    return array;
}

/* Función que obtiene el número de aprobados y desaprobados */
async function getAprobados(tablaCalificaciones){
    
    /* Se incializa el arreglo de objetos */
    let array = [
        {
            category: "Aprobados",
            value: 0
        },
        {
            category: "Desaprobados",
            value: 0
        },
        {
            category: "Sin nota",
            value: 0
        }
    ]

    tablaCalificaciones.then(data => {
        data.forEach(nota => {
            /* NF: nota final, si esta es mayor a 11 esta aprobado */
            if(nota.NF){
                if(nota.NF >= 11) array[0].value++
                else array[1].value++
            }else{
                /* Sino no tiene nota final */
                array[2].value++;
            }
        })
    })

    return array
}