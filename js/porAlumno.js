document.addEventListener("click",e => {
    /* Si hacemos click en cualquier boton a la clase .btnAsistenciaPorAlumno */
    if(e.target.matches(".btnAsistenciaPorAlumno")){
        const btnPressed = document.getElementById(e.target.id);
        let clase = btnPressed.classList[1]
        recibirDatosDelAlumno(e.target.id,clase)
    }
})

async function recibirDatosDelAlumno(cui,clase){
    try{
        const response = await fetch(`../php/getTabla.php?clase=${clase}&tabla=asistencia`);
        response.json().then(data => {
            data.forEach(alumno => {
                if(alumno.cui == cui){
                    
                    let obj = {
                        faltos: 0,
                        presentes: 0
                    }

                    for(const [key,value] of Object.entries(alumno)){
                        if(key != "cui"){
                            if(value == 'P') obj.presentes++;
                            if(value == 'F') obj.faltos++;
                        }
                    }
            
                    window.location.href = "../graphs/GraficoPorAlumno.php?datos="+ JSON.stringify(obj);
                }
            });
        })
        
    }catch(err){
        console.error(err);
    }

}