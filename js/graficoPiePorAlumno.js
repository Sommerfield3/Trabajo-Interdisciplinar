function graficar(obj,div){

  var chart = new CanvasJS.Chart(div, {
      animationEnabled: true,
      data: [{
          type: "pie",
          startAngle: 240,
          yValueFormatString: "##0.00\"%\"",
          indexLabel: "{label} {y}",
          dataPoints: obj
      }]
  });
  chart.render();
}

/* Contenedor donde se dibujará el grafico */
const container = document.getElementById("container");
/* Obtenemos la información en json */
let json = JSON.parse(container.textContent)

/* Enviamos el arreglo como parámetro */
let totalClases = json.presentes + json.faltos

graficar(
[
    {
        label: "Presente",
        y:  parseInt(json.presentes) * (100/totalClases)
      }, {
        label: "Falto",
        y: parseInt(json.faltos) * (100/totalClases)
    }
]
,"chartdiv"
)
