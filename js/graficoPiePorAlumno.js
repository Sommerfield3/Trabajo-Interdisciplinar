/* Función que grafica a traves de un arreglo de objetos */
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

/* Contenedor donde se dibujará el grafico */
const container = document.getElementById("container");
/* Obtenemos la información en json */
let json = JSON.parse(container.textContent)

/* Enviamos el arreglo como parámetro */
graficar(
[
    {
        category: "Presente",
        value:  parseInt(json.presentes)
      }, {
        category: "Falto",
        value: parseInt(json.faltos)
    }
]
)
