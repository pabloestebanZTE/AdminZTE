function PEMP(array) {

  var planeado = [
  {label: "Enero", y: array.Enero.Zona.Zona4.Estado.Abierto+array.Enero.Zona.Zona4.Estado.Ejecutado+array.Enero.Zona.Zona4.Estado.Progreso},
  {label: "Febrero", y: array.Febrero.Zona.Zona4.Estado.Abierto+array.Febrero.Zona.Zona4.Estado.Ejecutado+array.Febrero.Zona.Zona4.Estado.Progreso},
  {label: "Marzo", y: array.Marzo.Zona.Zona4.Estado.Abierto+array.Marzo.Zona.Zona4.Estado.Ejecutado+array.Marzo.Zona.Zona4.Estado.Progreso},
  {label: "Abril", y: array.Abril.Zona.Zona4.Estado.Abierto+array.Abril.Zona.Zona4.Estado.Ejecutado+array.Abril.Zona.Zona4.Estado.Progreso},
  {label: "Mayo", y: array.Mayo.Zona.Zona4.Estado.Abierto+array.Mayo.Zona.Zona4.Estado.Ejecutado+array.Mayo.Zona.Zona4.Estado.Progreso},
  {label: "Junio", y: array.Junio.Zona.Zona4.Estado.Abierto+array.Junio.Zona.Zona4.Estado.Ejecutado+array.Junio.Zona.Zona4.Estado.Progreso},
  {label: "Julio", y: array.Julio.Zona.Zona4.Estado.Abierto+array.Julio.Zona.Zona4.Estado.Ejecutado+array.Julio.Zona.Zona4.Estado.Progreso}
  ]

  var progreso = [
  {label: "Enero", y: array.Enero.Zona.Zona4.Estado.Progreso},
  {label: "Febrero", y: array.Febrero.Zona.Zona4.Estado.Progreso},
  {label: "Marzo", y: array.Marzo.Zona.Zona4.Estado.Progreso},
  {label: "Abril", y: array.Abril.Zona.Zona4.Estado.Progreso},
  {label: "Mayo", y: array.Mayo.Zona.Zona4.Estado.Progreso},
  {label: "Junio", y: array.Junio.Zona.Zona4.Estado.Progreso},
  {label: "Julio", y: array.Julio.Zona.Zona4.Estado.Progreso}
  ]

  var ejecutado = [
  {label: "Enero", y: array.Enero.Zona.Zona4.Estado.Ejecutado},
  {label: "Febrero", y: array.Febrero.Zona.Zona4.Estado.Ejecutado},
  {label: "Marzo", y: array.Marzo.Zona.Zona4.Estado.Ejecutado},
  {label: "Abril", y: array.Abril.Zona.Zona4.Estado.Ejecutado},
  {label: "Mayo", y: array.Mayo.Zona.Zona4.Estado.Ejecutado},
  {label: "Junio", y: array.Junio.Zona.Zona4.Estado.Ejecutado},
  {label: "Julio", y: array.Julio.Zona.Zona4.Estado.Ejecutado}
  ]

var chart = new CanvasJS.Chart("chartContainer4",
    {
      theme: "theme3",
      animationEnabled: true,
      title:{
        text: "Mantenimientos Preventivos Zona 4",
        fontSize: 25
      },
      toolTip: {
        shared: true
      },
      axisY: {
        title: "Manteniminetos"
      },
      data: [
      {
        type: "column",
        name: "Planeado",
        legendText: "Planeados",
        showInLegend: true,
        dataPoints:planeado
      },
      {
        type: "column",
        name: "Ejecutado",
        legendText: "Ejecutados",
        showInLegend: true,
        dataPoints:ejecutado
      },
      {
        type: "column",
        name: "En Progreso",
        legendText: "En Progreso",
        showInLegend: true,
        dataPoints:progreso
      }

      ],
          legend:{
            cursor:"pointer",
            itemclick: function PEMP(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          },
        });
      chart.render();
}

function PGEMP(array) {
  console.log(array);
  var datos1 = [
    {  y: array.Enero.contador, label: "Enero"},
    {  y: array.Febrero.contador, label: "Febrero" },
    {  y: array.Marzo.contador, label: "Marzo" },
    {  y: array.Abril.contador, label: "Abril" },
    {  y: array.Mayo.contador, label: "Mayo"},
    {  y: array.Junio.contador, label: "Junio"},
    {  y: array.Julio.contador, label: "Julio"}
  ];

var chart = new CanvasJS.Chart("chartContainer",
    {
    title:{
    text: "Plan General Consorcio Ejecución de Manteniminetos Preventivos",
    fontSize: 22
    },

    axisY:{
      title:"Manteniminetos"
    },
    animationEnabled: true,
    data: [
    {
      type: "stackedColumn",
      toolTipContent: "{label}<br/><span style='\"'color: {color};'\"'><strong>{name}</strong></span>: {y} Manteniminetos",
      name: "Mantenimientos Mensuales",
      dataPoints: datos1
     }
    ]
    ,
    legend:{
      cursor:"pointer",
      itemclick: function PGEMP(e) {
        if (typeof (e.dataSeries.visible) ===  "undefined" || e.dataSeries.visible) {
          e.dataSeries.visible = false;
        }
        else
        {
          e.dataSeries.visible = true;
        }
        chart.render();
      }
    }
    });
    chart.render();
}

function PGEMPln(array) {
  var planeado = [
  {label: "Enero", y: array.Enero.Zona.Zona1.Estado.Abierto+array.Enero.Zona.Zona1.Estado.Ejecutado+array.Enero.Zona.Zona1.Estado.Progreso},
  {label: "Febrero", y: array.Febrero.Zona.Zona1.Estado.Abierto+array.Febrero.Zona.Zona1.Estado.Ejecutado+array.Febrero.Zona.Zona1.Estado.Progreso},
  {label: "Marzo", y: array.Marzo.Zona.Zona1.Estado.Abierto+array.Marzo.Zona.Zona1.Estado.Ejecutado+array.Marzo.Zona.Zona1.Estado.Progreso},
  {label: "Abril", y: array.Abril.Zona.Zona1.Estado.Abierto+array.Abril.Zona.Zona1.Estado.Ejecutado+array.Abril.Zona.Zona1.Estado.Progreso},
  {label: "Mayo", y: array.Mayo.Zona.Zona1.Estado.Abierto+array.Mayo.Zona.Zona1.Estado.Ejecutado+array.Mayo.Zona.Zona1.Estado.Progreso},
  {label: "Junio", y: array.Junio.Zona.Zona1.Estado.Abierto+array.Junio.Zona.Zona1.Estado.Ejecutado+array.Junio.Zona.Zona1.Estado.Progreso},
  {label: "Julio", y: array.Julio.Zona.Zona1.Estado.Abierto+array.Julio.Zona.Zona1.Estado.Ejecutado+array.Julio.Zona.Zona1.Estado.Progreso}
  ]

  var progreso = [
  {label: "Enero", y: array.Enero.Zona.Zona1.Estado.Progreso},
  {label: "Febrero", y: array.Febrero.Zona.Zona1.Estado.Progreso},
  {label: "Marzo", y: array.Marzo.Zona.Zona1.Estado.Progreso},
  {label: "Abril", y: array.Abril.Zona.Zona1.Estado.Progreso},
  {label: "Mayo", y: array.Mayo.Zona.Zona1.Estado.Progreso},
  {label: "Junio", y: array.Junio.Zona.Zona1.Estado.Progreso},
  {label: "Julio", y: array.Julio.Zona.Zona1.Estado.Progreso}
  ]

  var ejecutado = [
  {label: "Enero", y: array.Enero.Zona.Zona1.Estado.Ejecutado},
  {label: "Febrero", y: array.Febrero.Zona.Zona1.Estado.Ejecutado},
  {label: "Marzo", y: array.Marzo.Zona.Zona1.Estado.Ejecutado},
  {label: "Abril", y: array.Abril.Zona.Zona1.Estado.Ejecutado},
  {label: "Mayo", y: array.Mayo.Zona.Zona1.Estado.Ejecutado},
  {label: "Junio", y: array.Junio.Zona.Zona1.Estado.Ejecutado},
  {label: "Julio", y: array.Julio.Zona.Zona1.Estado.Ejecutado}
  ]

  var chart = new CanvasJS.Chart("chartContainer3",
      {
        theme: "theme3",
        animationEnabled: true,
        title:{
          text: "Mantenimientos Preventivos Zona 1",
          fontSize: 25
        },
        toolTip: {
          shared: true
        },
        axisY: {
          title: "Manteniminetos"
        },
        data: [
        {
          type: "column",
          name: "Planeado",
          legendText: "Planeados",
          showInLegend: true,
          dataPoints:planeado
        },
        {
          type: "column",
          name: "Ejecutado",
          legendText: "Ejecutados",
          showInLegend: true,
          dataPoints:ejecutado
        },
        {
          type: "column",
          name: "En Progreso",
          legendText: "En Progreso",
          showInLegend: true,
          dataPoints:progreso
        }

        ],
            legend:{
              cursor:"pointer",
              itemclick: function PEMP(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                  e.dataSeries.visible = false;
                }
                else {
                  e.dataSeries.visible = true;
                }
                chart.render();
              }
            },
          });
        chart.render();
}

function  PGEMPln2(array) {
  var totalMantenimientos = array.Enero.contador+array.Febrero.contador+array.Marzo.contador+array.Abril.contador+array.Mayo.contador+array.Junio.contador+array.Julio.contador;
  var Enero=array.Enero.contador;
  var Febrero=Enero+array.Febrero.contador;
  var Marzo=Febrero+array.Marzo.contador;
  var Abril=Marzo+array.Abril.contador;
  var Mayo=Abril+array.Mayo.contador;
  var Junio=Mayo+array.Junio.contador;
  var Julio=Junio+array.Julio.contador;

  var EneroE=array.Enero.Zona.Zona1.Estado.Ejecutado+array.Enero.Zona.Zona4.Estado.Ejecutado;
  var FebreroE=EneroE+array.Febrero.Zona.Zona1.Estado.Ejecutado+array.Febrero.Zona.Zona4.Estado.Ejecutado;
  var MarzoE=FebreroE+array.Marzo.Zona.Zona1.Estado.Ejecutado+array.Marzo.Zona.Zona4.Estado.Ejecutado;
  var AbrilE=MarzoE+array.Abril.Zona.Zona1.Estado.Ejecutado+array.Abril.Zona.Zona4.Estado.Ejecutado;
  var MayoE=AbrilE+array.Mayo.Zona.Zona1.Estado.Ejecutado+array.Mayo.Zona.Zona4.Estado.Ejecutado;
  var JunioE=MayoE+array.Junio.Zona.Zona1.Estado.Ejecutado+array.Junio.Zona.Zona4.Estado.Ejecutado;
  var JulioE=JunioE+array.Julio.Zona.Zona1.Estado.Ejecutado+array.Julio.Zona.Zona4.Estado.Ejecutado;

        var datos1 = [
          { label: "Enero", y: 10/totalMantenimientos*Enero},
          { label: "Febrero", y: 1/totalMantenimientos*Febrero},
          { label: "Marzo", y: 1/totalMantenimientos*Marzo},
          { label: "Abril", y: 1/totalMantenimientos*Abril},
          { label: "Mayo", y: 1/totalMantenimientos*Mayo},
          { label: "Junio", y: 1/totalMantenimientos*Junio},
          { label: "Julio", y: 1/totalMantenimientos*Julio}
      ];

      var datos2 = [
        { label: "Enero", y: 10/totalMantenimientos*EneroE},
        { label: "Febrero", y: 1/totalMantenimientos*FebreroE},
        { label: "Marzo", y: 1/totalMantenimientos*MarzoE},
        { label: "Abril", y: 1/totalMantenimientos*AbrilE},
        { label: "Mayo", y: 1/totalMantenimientos*MayoE},
        { label: "Junio", y: 1/totalMantenimientos*JunioE},
        { label: "Julio", y: 1/totalMantenimientos*JulioE}
    ];

      var chart = new CanvasJS.Chart("chartContainer2",
      {
        title:{
         text: "Plan General Consorcio Ejecución de Manteniminetos Preventivos %",
         fontZise: 22
       },
       toolTip: {
                   shared: true,
                   contentFormatter: function (e) {
                     var content = " ";
                     for (var i = 0; i < e.entries.length; i++) {
                       content += e.entries[i].dataSeries.name + " " + "<strong>" + (e.entries[i].dataPoint.y * 100).toFixed(0) + "%" + "</strong>";
                       content += "<br/>";
                     }
                     return content;
                   }
                 },
       theme: "theme1",
       animationEnabled: true,
       axisX: {
         valueFormatString: "MMM"
        },
        axisY:{
          maximum: 1.20,
          interval: 0.20,
          valueFormatString: "#0 %"
        },
       data: [
       {
         type: "area",
         color: "rgba(40,175,101,0.6)",
         markerSize: 0,
        showInLegend: false,
         legendText: "Planeados",
         name: "Planeados",
        dataPoints:datos1
      },
      {
        type: "area",
        color: "rgba(0,75,141,0.7)",
        markerSize: 0,
       showInLegend: false,
        legendText: "Ejecutados",
        name: "Ejecutados",
       dataPoints:datos2
     }
      ]
    });

    chart.render();
}
