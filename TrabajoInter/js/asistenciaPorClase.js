function graficar(data){
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
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: false,
          panY: false,
          wheelX: "panX",
          wheelY: "zoomX",
          layout: root.verticalLayout
        }));
        
        
        // Add legend
        // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
        var legend = chart.children.push(
          am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50
          })
        );
        
        
        
        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          categoryField: "fecha",
          renderer: am5xy.AxisRendererX.new(root, {
            cellStartLocation: 0.1,
            cellEndLocation: 0.9
          }),
          tooltip: am5.Tooltip.new(root, {})
        }));
        
        xAxis.data.setAll(data);
        
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {})
        }));
        
        
        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        function makeSeries(name, fieldName) {
          var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: name,
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: fieldName,
            categoryXField: "fecha"
          }));
        
          series.columns.template.setAll({
            tooltipText: "{name}, {categoryX}:{valueY}",
            width: am5.percent(90),
            tooltipY: 0
          });
        
          series.data.setAll(data);
        
          // Make stuff animate on load
          // https://www.amcharts.com/docs/v5/concepts/animations/
          series.appear();
        
          series.bullets.push(function () {
            return am5.Bullet.new(root, {
              locationY: 0,
              sprite: am5.Label.new(root, {
                text: "{valueY}",
                fill: root.interfaceColors.get("alternativeText"),
                centerY: 0,
                centerX: am5.p50,
                populateText: true
              })
            });
          });
        
          legend.data.push(series);
        }
        
        makeSeries("Presentes", "presentes");
        makeSeries("Faltos", "faltos");
        
        
        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(1000, 100);
        
        }); // end am5.ready()
}



const btn2 = document.getElementById("btnMostrarAsistenciaPorDia");
btn2.addEventListener("click", e => {
    let clase = btn.classList[0].slice(1,-1);
    let datos = enviarDatosBarras(clase); 
    formatearDatosBarras(datos);
    //location.href = "../php/AsistenciaPorClase.php?clase=" + clase;

})


async function enviarDatosBarras(clase){
  try{
      const response = await fetch("../php/AsistenciaPorClase.php?clase=" + clase)
      const data = await response.json()
      console.log(data);
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
        let str = '';

        
        const ajax = new XMLHttpRequest();
        
        ajax.addEventListener("readystatechange",e=>{
            if(ajax.readyState == 4 && ajax.status == 200){
                location.href = "../php/graficoBarras.php"; 
            }
        })

        ajax.open("POST","../php/graficoBarras.php");
        ajax.setRequestHeader("Content-type", "application/json")
        ajax.send(JSON.stringify(array));
        */  
    })

    console.log(array)
    graficar(array)
}


