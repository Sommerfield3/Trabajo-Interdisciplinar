document.addEventListener("click",e => {
    if(e.target.matches(".btnAsistenciaPorAlumno")){
        const btnPressed = document.getElementById(e.target.id);
        let clase = btnPressed.classList[1]
        let datos = recibirDatosDelAlumno(e.target.id,clase)
    }
})

async function recibirDatosDelAlumno(cui,clase){
    try{
        const response = await fetch("../php/AsistenciaPorAlumno.php?clase=" + clase + "&cui=" + cui);
        const data = await response.json()
        
        const clases = 17;
        let obj = {}

        obj['faltos'] = clases - await parseInt(data.total_Asistencia)
        obj['presentes'] = await parseInt(data.total_Asistencia)

        window.location.href = "../php/GraficoPorAlumno.php?datos="+ JSON.stringify(obj);

    }catch(err){
        console.error(err);
    }

}