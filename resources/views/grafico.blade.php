@extends('layouts.layout')

@section('titulo','Gráfico')

@section('head')
<link rel="stylesheet" href="/css/grafico.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('navbar')

@endsection

@section('main')
    <div class="center-form">
    <form action="" method="post">
    
        <label for="Programa">programa</label>
        <select name ="programa" id="Programa"  onchange="this.form.submit()">
            <option value="" disabled selected>Selecionar</option>
        </select>
    </form>
    </div>
<div class = "graficos">
    <div id="pieChart"></div>  
    <div id="barChart" class = "a"></div>

</div>
@endsection

@section('scripts')
    google.charts.load('current', {'packages':['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {

    var pieData = google.visualization.arrayToDataTable([
        ['programa', 'fundos'],
        ['Diária civil', 20000],
        ['Diária internacional', 40000],
        ['Passagens', 12000],
        ['SEPE', 3000],
        ['Não servidor', 5000],
        ['Auxílio estudante', 1200],
        ['Auxílio pesquisador', 8000],
        ['Cons', 3300],
        ['Serviços de terceiros', 4000],
        ['Transport', 5000]
    ]);

    var pieOptions = {
        title: "Distribuição de fundos :",
        is3D: true,
        backgroundColor: '#A0BFE0',
    };

    var pieChart = new google.visualization.PieChart(document.getElementById('pieChart'));
    pieChart.draw(pieData, pieOptions);

    var barData = google.visualization.arrayToDataTable([
        ['Setores', 'Valor Recebido', 'Valor Gasto'],
        ['Dia Civ', 20000,11874  ],
        ['Dia Int', 40000,12000 ],
        ['Pass', 12000,120  ],
        ['SEPE' , 3000,1000  ],
        ['Não Serv', 5000,1200  ],
        ['Aux Estu',  1200,400  ],
        ['Aux Pesq',  8000,4000  ],
        ['Mat Cons',  3300,199  ],
        ['Serv Ter',  4000,3000  ],
        ['Trans', 5000,1200 ]
    ]);

    var barOptions = {
        chart: {
        title: 'Comparação',
        subtitle: '',
        },
        chartArea:{
            backgroundColor: '#e0fbfc',
        },
        
        colors: ['#005792','green'],
        backgroundColor: '#A0BFE0',
    };
    function init() {
        
    }

    var barChart = new google.charts.Bar(document.getElementById('barChart'));

    barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));
} 
@endsection

