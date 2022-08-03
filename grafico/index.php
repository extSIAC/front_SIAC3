<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>tec gr</title>
  </head>
  <body>

<div class="col-col-lg-12" style="padding-top:20px;">
    <div class="card">
        <h2 class="card-header text-center"> <b> REPORTE DE ESTADÍSTICAS DEL DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES</b></h2>

        <div class="card-body">
            <h3 class="text-center"> <b>INSCRIPCIONES POR TIPO DE ACTIVIDAD EXTRAESCOLAR</b></h3>
            <br>
            <div class="row text-center justify-content-center">
   
                    <div class="col-sm-5" id="">  
                        <canvas id="grafico_tipo_actividad_extraescolar" width="400" height="400"></canvas>
                    </div>
                                   
            </div>  
        </div>

        <div class="card-body">
            <h3 class="text-center"> <b>INSCRIPCIONES A EXTRAESCOLARES</b></h3>
            <br>
            <div class="row">
   
                    <div class="col-sm-6" id="div_grafico_actividades_deportivas">  
                        <h5 class="text-center"> <b> ACTIVIDADES DEPORTIVAS</b></h5>
                        <canvas id="grafico_actividades_deportivas" width="400" height="400"></canvas>
                    </div>
                    
                    <div class="col-sm-6" id="div_grafico_actividades_deportivas">   
                        <h5 class="text-center"> <b> ACTIVIDADES CÍVICAS Y CULTURALES</b></h5>
                        <canvas id="grafico_actividades_culturales" width="400" height="400"></canvas>
                    </div>                    
            </div>  
        </div>
    </div>
</div>

                    <button class="btn btn-primary" onclick="CargarDatosGraficoActividadesDeportivas();">ACTIVIDADES DEPORTIVAS
                    </button>
                    <button class="btn btn-primary" onclick="CargarDatosGraficoActividadesCulturales();">ACTIVIDADES CÍVICAS Y CULTURALES
                    </button>






  </body>
</html>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.esm.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/helpers.esm.min.js"></script>
   

   



   <script>

$(document).ready(function() {

CargarDatosGraficoTipoActividadExtraescolar();
CargarDatosGraficoActividadesDeportivas();
CargarDatosGraficoActividadesCulturales();






} );



//TIPO DE ACTIVIDAD EXTRAESCOLAR //////////////////////////////
        function CargarDatosGraficoTipoActividadExtraescolar(){
            $.ajax({
                url:'controlador_grafico_tipo_actividad_extraescolar.php',
                type: 'POST'
            }).done(function(resp){
                var data = JSON.parse(resp);
                var titulo = [];
                var cantidad = [];
                for (var i=0; i < data.length; i++){
                    titulo.push(data [i][0]);
                    cantidad.push(data[i][1]);           
               
                }   
                CrearGraficoVertical(titulo, cantidad, 'Número de inscripciones por tipo de extraescolar', 'bar', 'grafico_tipo_actividad_extraescolar');
                
            })
        }








        function CargarDatosGraficoActividadesDeportivas(){
            $.ajax({
                url:'controlador_grafico_actividades_deportivas.php',
                type: 'POST'
            }).done(function(resp){
                var data = JSON.parse(resp);
                var titulo = [];
                var cantidad = [];
                for (var i=0; i < data.length; i++){
                    titulo.push(data [i][2]);
                    cantidad.push(data[i][3]);           
               
                }   
                CrearGraficoHorizontal(titulo, cantidad, 'Número de inscripciones por actividad extraescolar', 'bar', 'grafico_actividades_deportivas');
                
            })
        }


        function CargarDatosGraficoActividadesCulturales(){
            $.ajax({
                url:'controlador_grafico_actividades_culturales.php',
                type: 'POST'
            }).done(function(resp){
                var data = JSON.parse(resp);
                var titulo = [];
                var cantidad = [];
                for (var i=0; i < data.length; i++){
                    titulo.push(data [i][2]);
                    cantidad.push(data[i][3]);           
               
                }   
                CrearGraficoHorizontal(titulo, cantidad, 'Número de inscripciones por actividad extraescolar', 'bar','grafico_actividades_culturales');
            })
        }



function OcultarDesocultar(ocultado, desocultado) {

        document.getElementById(ocultado).style.display = "none";
        document.getElementById(desocultado).style.display = "block";
 }








function CrearGraficoHorizontal(titulo, cantidad, encabezado, tipo, id){
const ctx = document.getElementById(id);
const myChart = new Chart(ctx, {
    type: tipo,
    data: {
        labels: titulo,
        datasets: [{
            label: encabezado,
            data: cantidad,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: { indexAxis: 'y',
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


}

function CrearGraficoVertical(titulo, cantidad, encabezado, tipo, id){
const ctx = document.getElementById(id);
const myChart = new Chart(ctx, {
    type: tipo,
    data: {
        labels: titulo,
        datasets: [{
            label: encabezado,
            data: cantidad,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: { indexAxis: 'x',
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


}


function CrearGraficoPolar(titulo, cantidad, encabezado, tipo, id){
const ctx = document.getElementById(id);
const myChart = new Chart(ctx, {
    type: tipo,
    data: {
        labels: titulo,
        datasets: [{
            label: encabezado,
            data: cantidad,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
 options: {
    responsive: true,
    scales: {
      r: {
        pointLabels: {
          display: true,
          centerPointLabels: true,
          font: {
            size: 10
          }
        }
      }
    }
  }
});


}



    function generarNumero(numero){
	return (Math.random()*numero).toFixed(0);
    }

    function colorRGB(){
        var color = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
        return "rgb" + color;
    }        



    </script>