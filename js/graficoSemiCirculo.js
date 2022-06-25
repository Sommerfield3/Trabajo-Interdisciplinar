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
    // start and end angle must be set both for chart and series
    var chart = root.container.children.push(am5percent.PieChart.new(root, {
      startAngle: 180,
      endAngle: 360,
      layout: root.verticalLayout,
      innerRadius: am5.percent(50)
    }));
    
    // Create series
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
    // start and end angle must be set both for chart and series
    var series = chart.series.push(am5percent.PieSeries.new(root, {
      startAngle: 180,
      endAngle: 360,
      valueField: "value",
      categoryField: "category",
      alignLabels: false
    }));
    
    series.states.create("hidden", {
      startAngle: 180,
      endAngle: 180
    });
    
    series.slices.template.setAll({
      cornerRadius: 5
    });
    
    series.ticks.template.setAll({
      forceHidden: true
    });
    
    // Set data
    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
    series.data.setAll(obj);
    
    series.appear(1000, 100);
    
    }); // end am5.ready()
}


const container = document.getElementById("container")

let obj = JSON.parse(container.textContent)
console.log(obj)

/*
let obj = [
  { value: 10, category: "Clases Realizadas" },
  { value: 9, category: "Clases no Realizadas" }
]*/

graficar(obj);
