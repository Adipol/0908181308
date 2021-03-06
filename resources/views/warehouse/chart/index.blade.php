@extends('layouts.template') 
@section('content')

<html>
  <head>
    <style>
        #chart_wrap {
            position: relative;
            padding-bottom: 400px;
            overflow:hidden;
            width: 100%;
        }
        #piechart {
            position: absolute;
            top: 0;
            left: 0;
            width:100%;
            height:100%;
        }
        #piechart1 {
            position: absolute;
            top: 0;
            left: 0;
            width:100%;
            height:100%;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Productos', 'cantidad'],
         @foreach($products as $product)
            ['{{ $product->name }}',{{ $product->total }}],
         @endforeach()

        ]);

        var options = {
            backgroundColor: { fill:'transparent'},
            height: 500,
            width: 500,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

        function resizeHandler () {
            chart.draw(data, options);
        }
        if (window.addEventListener) {
            window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
            window.attachEvent('onresize', resizeHandler);
        }
      }

        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {

        var data = google.visualization.arrayToDataTable([
        ['Productos', 'cantidad'],
            @foreach ($stocks as $stock)
                ['{{ $stock->name }}',{{ $stock->stock }}],
            @endforeach
        ]);

        var options = {
            backgroundColor: { fill:'transparent'},
            height: 500,
            width: 500,
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);

            function resizeHandler () {
                               chart.draw(data, options);
        }
        if (window.addEventListener) {
            window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
            window.attachEvent('onresize', resizeHandler);
        }
        }

    </script>
  </head>
<body>
    <section class="graficos">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('access.index') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gráficos</li>
            </ol>
        </nav> 
        

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                            Productos solicitados
                        </h3>
                        <div class="card-body pt-0 pl-0 pr-0">
                            <div id="chart_wrap">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                            Stock de Productos
                        </h3>
                        <div class="card-body pt-0 pl-0 pr-0">
                            <div id="chart_wrap">
                                <div id="piechart1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

@endsection
