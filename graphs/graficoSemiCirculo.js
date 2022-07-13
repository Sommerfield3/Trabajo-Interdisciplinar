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


const container2 = document.getElementById("container2"),
  table2 = document.getElementById("tablaTotalClases")

let obj = JSON.parse(container2.textContent)
console.log(obj)

obj.forEach(element => {
  const th = document.createElement("th")
  th.textContent = element.category;
  const td = document.createElement("td") 
  td.textContent = element.value

  table2.querySelector("thead").appendChild(th)
  table2.querySelector("tbody").appendChild(td)
});


graficar(obj,"clasesTomadas");
