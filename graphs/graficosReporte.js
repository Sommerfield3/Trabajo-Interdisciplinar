function graficarBarras(data,div){
    var chart = new CanvasJS.Chart(div, {
        animationEnabled: true,	
        axisY: {
            title: "Asistentes",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC"
        },
        axisY2: {
            title: "Faltos",
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E"
        },	
        toolTip: {
            shared: true
        },
        legend: {
            cursor:"pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type: "column",
            name: "Asistentes",
            legendText: "Asistentes",
            showInLegend: true, 
            dataPoints: data[0]
        },
        {
            type: "column",	
            name: "Faltos",
            legendText: "Faltos",
            axisYType: "secondary",
            showInLegend: true,
            dataPoints: data[1]
        }]
    });
    chart.render();
    
    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
}


function graficarPie(obj,div){

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

/* Tabla y grafico de alumnos asistentes y alumnos en situacion de abandono */
const totalAsistencia = JSON.parse(document.getElementById("totalAsistencia").textContent),
  tablaTotalAsistencia = document.getElementById("tablaTotalAsistencia").querySelectorAll("td")
  
tablaTotalAsistencia[1].textContent = totalAsistencia[1].y
tablaTotalAsistencia[2].textContent = totalAsistencia[0].y


let total = totalAsistencia[0].y + totalAsistencia[1].y

totalAsistencia[0].y *= (100/total)
totalAsistencia[1].y *= (100/total)

graficarPie(totalAsistencia,"graficoTotalAsistencia")

/* Tabla y grafico de total de asistencia por clase */
const asistenciaPorClase = JSON.parse(document.getElementById("asistenciaPorClase").textContent),
  tablaAsistenciaPorClase = document.getElementById("tablaAsistenciaPorClase").querySelector("tbody")


asistenciaPorClase.forEach(element => {
  const tr = document.createElement("tr")
  Object.values(element).forEach(attr => {
    const td = document.createElement("td")
    td.textContent = attr;
    tr.appendChild(td)
  })
  tablaAsistenciaPorClase.appendChild(tr)
});


let arrayGlobal = [], presentes = [], faltos = []
asistenciaPorClase.forEach(element => {
    let obj1 = {}, obj2 = {}
    obj1.label = element.fecha;
    obj1.y = element.presentes;

    obj2.label = element.fecha;
    obj2.y = element.faltos;

    presentes.push(obj1)
    faltos.push(obj2)
})

arrayGlobal.push(presentes)
arrayGlobal.push(faltos)

graficarBarras(arrayGlobal,"graficoAsistenciaPorClase");


/* Tabla y grafico de numero de clases*/
const numeroClases = JSON.parse(document.getElementById("numeroClases").textContent),
  tablaNumeroClases = document.getElementById("tablaNumeroClases")

numeroClases.forEach(element => {
  const th = document.createElement("th")
  th.textContent = element.label;
  const td = document.createElement("td") 
  td.textContent = element.y

  tablaNumeroClases.querySelector("thead").appendChild(th)
  tablaNumeroClases.querySelector("tbody").appendChild(td)
});

let total2 = numeroClases[0].y + numeroClases[1].y

numeroClases[0].y *= (100/total2)
numeroClases[1].y *= (100/total2)

numeroClases.pop()

graficarPie(numeroClases,"graficoNumeroClases");



/* Tabla y grafico de calificaciones finales */
const calificacionesFinales = JSON.parse(document.getElementById("calificacionesFinales").textContent)
const tablaCalificacionesFinales = document.getElementById("tablaCalificacionesFinales").querySelector("tbody")

let total3 =  calificacionesFinales[0].y + calificacionesFinales[1].y + calificacionesFinales[2].y

calificacionesFinales.forEach(element => {
 const td = document.createElement("td")
 td.textContent = element.y
 tablaCalificacionesFinales.appendChild(td)
 element.y *= (100/total3)
});

graficarPie(calificacionesFinales,"graficoCalificacionesFinales")

/* Tabla de datos de calificaciones */

const datosCalificaciones = JSON.parse(document.getElementById("datosCalificaciones").textContent)
const tablaDatosCalificaciones = document.getElementById("tablaDatosCalificaciones")

Object.keys(datosCalificaciones[0]).forEach(key => {
    let th = document.createElement("th")
    th.textContent = key 
    tablaDatosCalificaciones.querySelector("thead").appendChild(th)
})

datosCalificaciones.forEach(alumno => {
    let tr = document.createElement("tr")
    
    for(const [key,value] of Object.entries(alumno)){
        let td = document.createElement("td")
        value ? td.textContent = value : td.textContent = "---";
        tr.appendChild(td)
    }
    tablaDatosCalificaciones.querySelector("tbody").appendChild(tr)

})