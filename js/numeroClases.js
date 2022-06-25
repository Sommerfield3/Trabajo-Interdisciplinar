const btn3 = document.getElementById("btnMostrarNroClases")
btn3.addEventListener("click",e=>{
   let clase = btn3.classList[0].slice(1,-1);
    console.log(clase)
    datos = enviarDatos(clase)

})


async function enviarDatos(clase){
    try{
        const response = await fetch("../php/NumeroClases.php?clase=" + clase)
        const data = await response.json()
        let array = []
        const clases = 17;
        
        let obj1 = {}
        obj1["category"] = "Clases Realizadas";
        obj1["value"] = await parseInt(data[2]);

        let obj2 = {}
        obj2["category"] = "Clases no Realizadas";
        obj2["value"] = clases - await parseInt(data[2]);

        array.push(obj1);
        array.push(obj2)
        console.log(array);

        window.location.href = "../php/GraficoSemiCirculo.php?datos=" + JSON.stringify(array);
    }catch(err){
        console.error(err)
    }
}