document.addEventListener("click",e => {
    if(e.target.matches(".btnAsistenciaPorAlumno")){
        const btnPressed = document.getElementById(e.target.id);
        let clase = btnPressed.classList[1]
        let datos = recibirDatosDelAlumno(e.target.id,clase)
    }
})

async function recibirDatosDelAlumno(cui,clase){
    try{
        const response = await fetch("../php/getInfo/getTablaDatos.php?clase=" + clase);
        response.json().then(data => {
            data.forEach(alumno => {
                if(alumno.cui == cui){

                    let obj = {}
                    const clases = 17;

                    obj['faltos'] = clases - parseInt(alumno.total_Asistencia)
                    obj['presentes'] = parseInt(alumno.total_Asistencia)
            
                    window.location.href = "../graphs/GraficoPorAlumno.php?datos="+ JSON.stringify(obj);
                }
            });
        })

        
        /*
*/
    }catch(err){
        console.error(err);
    }

}