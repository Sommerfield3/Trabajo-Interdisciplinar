const btn = document.getElementById("btnMostrarAbandonos")
btn.addEventListener("click",e=>{
    let clase = btn.classList[0].slice(1,-1);
    let datos = recibirDatos(clase)
    formatearDatos(datos)
})  

async function formatearDatos(datos){
    let obj = {
      "Asistentes" : 0,
      "Abandonos" : 0
    };

    await datos.then(data => {
      let values = Object.values(data)
      values.forEach(el => {
        if(el > 0) obj.Asistentes++;
        else obj.Abandonos++;
      })
      return obj;
    })

    console.log(obj.Asistentes)
    window.location.href = "../php/grafico.php" + "?Asistentes=" + obj.Asistentes + "&Abandonos=" + obj.Abandonos;
    
}

async function recibirDatos(clase){
    try{
        const response = await fetch("../php/Abandonos.php?clase=" + clase)
        const data = await response.json()
        return data;
    }catch(err){
        console.error(err);
    }

}

