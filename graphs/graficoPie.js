function graficar(obj,div){

    am5.ready(function() {
    
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new(div);
        
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

const totalAsistencia = JSON.parse(document.getElementById("totalAsistencia").textContent),
  tablaTotalAsistencia = document.getElementById("tablaTotalAsistencia").querySelectorAll("td")

graficar(totalAsistencia,"graficoTotalAsistencia")

tablaTotalAsistencia[1].textContent = totalAsistencia[1].value
tablaTotalAsistencia[2].textContent = totalAsistencia[0].value





