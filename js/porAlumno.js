document.addEventListener("click",e => {
    if(e.target.matches(".btnAsistenciaPorAlumno")){
        const btnPressed = document.getElementById(e.target.id);
        let clase = btnPressed.classList[1]
        let datos = enviarDatos(e.target.id,clase)
    }
})


async function enviarDatos(cui,clase){
    try{
        const response = await fetch("../php/AsistenciaPorAlumno.php?clase=" + clase + "&cui=" + cui);
        const data = await response.json()
        
        const clases = 17;
        let obj = {}

        obj['faltos'] = clases - await parseInt(data.total_Asistencia)
        obj['presentes'] = await parseInt(data.total_Asistencia)

        window.location.href = "../php/GraficoPorAlumno?datos="+ JSON.stringify(obj);

    }catch(err){
        console.error(err);
    }

}