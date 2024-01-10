@extends('layouts.layout')



@section('head')
<link rel="stylesheet" href="/css/grafico.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('navbar')
    @if(session('tipo_log') == 'admin')
        @include('components.navbarAdmin')
    @elseif(session('tipo_log') == 'coord')
        @include('components.navbarCoord')
    @else
        @include('components.navbar')
    @endif
@endsection

@section('main')
    <div class="tabela">
        <div class = "selects">
            <form id="select-form" method="GET" action="{{route('relatorio')}}">
                <select name ="programa" id="programa" >
                </select>
                <select name = "ano" id = "ano">
                  @foreach($anos as $ano)
                    <option value="{{$ano}}">{{$ano}}</option>
                  @endforeach
                </select>
            </form>
        </div>
    
        <div class = "graficos">
            <div id="pieChart"></div>  
            <div id="barChart"></div>

        </div>
    </div>
@endsection

@section('scripts')
    google.charts.load('current', {'packages':['corechart', 'bar']});
   

    function atualizarGraficos(programa, valores) {
    var pieData = google.visualization.arrayToDataTable([
        ['programa', 'fundos'],
        ['Diária civil', programa.dia_civ/100],
        ['Diária internacional', programa.dia_int/100],
        ['Passagens', programa.pass/100],
        ['SEPE', programa.sepe/100],
        ['Não servidor', programa.nao_serv/100],
        ['Auxílio estudante', programa.aux_estu/100],
        ['Auxílio pesquisador', programa.aux_pesq/100],
        ['Material de consumo', programa.cons/100],
        ['Serviços de terceiros', programa.ser_ter/100],
        ['Transporte', programa.tran/100 ]
    ]);

    var pieOptions = {
        title: "Distribuição de fundos " + programa.nom_prog + "-" + programa.tipo_prog + " " +  $('#ano').val() +  ":",
        is3D: true,
        backgroundColor: '#A0BFE0',
        chartArea: {
          left: '20',
          width: '100%',
          },
          titleTextStyle: { color: '#00204a' },
        legend: {
            position: 'right',
            textStyle: {
              fontSize: 12,
              color: '#00204a'
            },
           
          }
    };

    var pieChart = new google.visualization.PieChart(document.getElementById('pieChart'));
    pieChart.draw(pieData, pieOptions);


    var barData = google.visualization.arrayToDataTable([
        ['Setores', 'Valor Recebido', 'Valor Gasto'],
        ['Diária Civil', programa.dia_civ/100,valores.dia_civ  ],
        ['Diária Inter', programa.dia_int/100,valores.dia_int ],
        ['Passagem', programa.pass/100,valores.pass  ],
        ['SEPE' , programa.sepe/100,valores.sepe  ],
        ['Não Serv.', programa.nao_serv/100,valores.nao_serv  ],
        ['Aux. Estud.',  programa.aux_estu/100,valores.aux_estu  ],
        ['Aux. Pesqui.',  programa.aux_pesq/100,valores.aux_pesq  ],
        ['Mat. Consumo',  programa.cons/100,valores.cons  ],
        ['S. Terceiro',  programa.ser_ter/100,valores.ser_ter  ],
        ['Transp.', programa.tran/100,valores.tran ]
    ]);

    var barOptions = {
        chart: {
        title: 'Valores Recebidos e valores gastos',
        subtitle: '',
        },
        titleTextStyle: { color: '#00204a' },
        hAxis: {
            textStyle: { color: '#00204a' }
          },
        chartArea:{
            backgroundColor: '#e0fbfc',
            width:'50%'
        },
        legend: {
            position: 'right',
            textStyle: {
              fontSize: 12,
              color : '#00204a',
            },
           
          },
        colors: ['#005792','green'],
        backgroundColor: '#A0BFE0',
        orientation: 'horizontal',
    };
  
    if(window.innerWidth < 1200){
        barOptions.orientation = 'vertical';
    }
    var barChart = new google.charts.Bar(document.getElementById('barChart'));

    barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));

    window.addEventListener('resize', function() {
        pieChart.draw(pieData, pieOptions);
        barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));
      });
}
$(document).ready(function(){
    function atualizarSelect(){
        var formData = $('#ano').serialize();
        $.ajax({
        url: '{{route("getProgramas")}}',
        method: 'GET',
        data: formData,
        success: function(data){
            var options = '<option disabled selected>Selecione o programa </option>'
            data.forEach(function(programa){
                options += '<option value="' + programa.id_prog + '">' + programa.nom_prog + '-' + programa.tipo_prog + '</option>'
            });
            $('#programa').html(options);
        }
    });
    }
    $('#ano').change(function(){
        atualizarSelect();
    });

    atualizarSelect();

    function getDados(){
        var formData = $('#programa').serialize();
        $.ajax({
            url : '{{route("dadosGraficos")}}',
            method: 'GET',
            data : formData,
            success: function(data){
               atualizarGraficos(data.programa,data.valores);

            }
        })
    }
    $('#programa').change(function(){
        getDados();
    });
})
@endsection
