const btn = document.getElementById("btnMostrarAbandonos")
btn.addEventListener("click",e=>{
    let clase = btn.classList[0].slice(1,-1);
    let datos = enviarDatos(clase)
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

async function enviarDatos(clase){
    try{
        const response = await fetch("../php/Abandonos.php?clase=" + clase)
        const data = await response.json()
        return data;
    }catch(err){
        console.error(err);
    }


/*
        location = "../html/abandonos.html"
        graficar(
            [
                {
                    category: "Lithuania",
                    value: 501.9
                  }, {
                    category: "UK",
                    value: 99
                }
            ]
        )
    */
}

function graficar(obj){

    am5.ready(function() {
    
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");
        
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
        
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(
          am5percent.PieChart.new(root, {
            endAngle: 270
          })
        );
        
        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(
          am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            endAngle: 270
          })
        );
        
        series.states.create("hidden", {
          endAngle: -90
        });
        
        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll(obj);
        
        series.appear(1000, 100);
        
        }); // end am5.ready()
}
