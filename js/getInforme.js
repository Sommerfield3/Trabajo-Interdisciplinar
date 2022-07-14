// boton para mostrar abandonos y por clase

const btn = document.getElementById("btnInforme")
btn.addEventListener("click",e=>{
    let clase = btn.classList[0].slice(1,-1),

    tablaAsistencia = recibirDatos(clase,"getTablaAsistencia"),
    tablaCurso = recibirDatos(clase,"getTablaCurso"),
    tablaCalificaciones = recibirDatos(clase,"getTablaCalificaciones");
    
    
    formatearDatos(tablaAsistencia,tablaCurso,tablaCalificaciones)
})  


async function formatearDatos(tablaAsistencia,tablaCurso,tablaCalificaciones){    

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

// recibir datos
async function recibirDatos(clase,archivo){
    try{
        const response = await fetch(`../php/getInfo/${archivo}.php?clase=${clase}`)
        const data = await response.json()
        return data;
    }catch(err){
        console.error(err);
    }
}

async function getAbandonos(tablaAsistencia){
    // objeto para guardar datos de asistentes y abandonos
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

async function getAsistenciaPorClase(tablaAsistencia){
    // arreglo para guardar la asistencia por clase
    
    let array = [];

    
    await tablaAsistencia.then(data => {
        // obtener solo las fechas
        const fechas = Object.keys(data[0]).slice(1)
        // obtener el arreglo de objeetos de las fechas
        fechas.forEach(fecha => {
            let obj = {
                fecha: fecha,
                presentes: 0,
                faltos: 0
            }
            array.push(obj)
        })

        data.forEach(alumno => {
            array.forEach(obj => {
                alumno[obj.fecha] == 'P' ? obj.presentes++ : obj.faltos++
            })
        })
    })

    return array;
}


async function getNumeroClases(tablaCurso){
    // arreglo para guardar las clases tomadas y aun no realizadas

    let array = [];
    const clases = 17; // constante del numero de clases

    tablaCurso.then(data => {
        
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

async function getAprobados(tablaCalificaciones){
    
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
            if(nota.NF){
                if(nota.NF >= 11) array[0].value++
                else array[1].value++
            }else{
                array[2].value++;
            }
        })
    })

    return array
}