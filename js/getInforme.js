// boton para mostrar abandonos y por clase

const btn = document.getElementById("btnInforme")
btn.addEventListener("click",e=>{
    let clase = btn.classList[0].slice(1,-1),
    abandonos = recibirDatos(clase,"Abandonos"),
    asistenciaPorClase = recibirDatos(clase,"AsistenciaPorClase"),
    totalClasesTomadas = recibirDatos(clase,"NumeroClases"),
    aprobadosYdesaprobados = recibirDatos(clase,"Aprobados");
    formatearDatos(abandonos,asistenciaPorClase,totalClasesTomadas,aprobadosYdesaprobados)
})  


async function formatearDatos(abandonos,asistenciaPorClase,totalClasesTomadas,aprobadosYdesaprobados){    
    let final = await getAbandonos(abandonos)
    let array = await getAsistenciaPorClase(asistenciaPorClase)
    let array2 = await getNumeroClases(totalClasesTomadas);
    let array3 = await getAprobados(aprobadosYdesaprobados);
    window.location.href = "../graphs/reporte.php" + "?Asistentes=" + final.Asistentes + "&Abandonos=" + final.Abandonos + "&objeto=" + JSON.stringify(array) + "&datos=" + JSON.stringify(array2) + "&aprobados=" + JSON.stringify(array3);
    
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


async function getAbandonos(abandonos){
    // objeto para guardar datos de asistentes y abandonos
    let final = {
        "Asistentes" : 0,
        "Abandonos" : 0
      };
  
      await abandonos.then(data => {
        let values = Object.values(data)
        values.forEach(el => {
          if(el > 0) final.Asistentes++;
          else final.Abandonos++;
        })
        return final;
        
      })
    return final;     
}

async function getAsistenciaPorClase(asistenciaPorClase){
    // arreglo para guardar la asistencia por clase
    let array = [];
    await asistenciaPorClase.then(data => {
        let values = Object.values(data),
        keys = Object.keys(data);
        
        for(let i = 1; i < keys.length; i++){
        let obj = {};
        obj["fecha"] = keys[i];
        let P = 0, F = 0;

        values[i].forEach(val => {
            if(val == 'P') P++;
            if(val == 'F') F++;
        })

        obj["presentes"] = P;
        obj["faltos"] = F;
        array.push(obj)
        }
    })

    return array;
}


async function getNumeroClases(totalClasesTomadas){
    // arreglo para guardar las clases tomadas y aun no realizadas

    let array2 = [];
    const clases = 17;

    totalClasesTomadas.then(data => {
        let obj1 = {}
        obj1["category"] = "Clases Realizadas";
        obj1["value"] = parseInt(data[2]);

        let obj2 = {}
        obj2["category"] = "Clases no Realizadas";
        obj2["value"] = clases - parseInt(data[2]);

        array2.push(obj1);
        array2.push(obj2)
    })

    return array2;
}

async function getAprobados(aprobadosYdesaprobados){
    
    let array3 = [
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

    aprobadosYdesaprobados.then(data => {
        data.forEach(nota => {
            if(nota.NF){
                if(nota.NF >= 11) array3[0].value++
                else array3[1].value++
            }else{
                array3[2].value++;
            }
        })
    })

    return array3
}