const btn2 = document.getElementById("btnMostrarAsistenciaPorDia");
var array;
btn2.addEventListener("click", e => {
    let clase = btn2.classList[0].slice(1,-1);
    let datos = enviarDatosBarras(clase); 
    formatearDatosBarras(datos)
})


async function enviarDatosBarras(clase){
  try{
      const response = await fetch("../php/AsistenciaPorClase.php?clase=" + clase)
      const data = await response.json()
      return data;
  }catch(err){
      console.error("Error :( :" + err);
  }

}


async function formatearDatosBarras(datos){
    let array = [];
    await datos.then(data => {
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

        /*
        let path = ''
        for(let i = 0; i < array.length; i++){
            path += `fecha${i}=${array[0].fecha}&`
        }
        console.log(path)
        */
        console.log(JSON.stringify(array))
        window.location.href = "../php/graficoBarras.php?objeto=" + JSON.stringify(array)

    })

}

