@extends('layouts.layout')
@section('head')
<link href="/css/programas.css" rel="stylesheet"/>
@endsection

@section('popup')
<div class = "popup" id = "popup">
    <form action="{{route('cadastrarNovoPrograma')}}" method="post">
        <div class = "radio">
            <label for="proap">Proap</label>
            <input type="radio" value = "proap" name = "tipo_prog" id = "proap" required >
            <label for="proapinho">proapinho</label>
            <input type="radio" value = "proapinho" name = "tipo_prog" id = "proapinho" required>
            {{mostrarErros("tipo_prog",$errors)}}
        </div>
        <div class = "popup-input">
            
            <label for="sigla">Sigla</label>
            <input type="text" name = "sigla" id = "sigla" required {{getValoresAntigos("sigla",$errors)}} >
            {{mostrarErros("sigla",$errors)}}
        </div>
        @csrf
        <div class = "popup-buttons">
            <button  type="submit">Cadastrar</button>
            <button  id = "fecharPopup" type = "reset">Cancelar</button>
        </div>
    </form>
</div>
@endsection

@section('navbar')

    @include('components.navbarAdmin')
@endsection

@section('h1','Programas')

@section('main')  
<x-search-box/>
            <div class = "tabela">
               
                <div class = "buttons">
                    <div>
                        <button id = "abrirPopup" > Cadastrar novo programa</button>
                    </div>
                    <form action="{{route('edicao')}}" method ="post">
                        @method('PATCH')
                        <button name = "edicao"  type = "submit" value ="true">Liberar para edição</button>
                        <button name = "edicao"  type = "submit" value = "false">Trancar edição</button>
                        @csrf
                    </form>
                    <form action="{{route('relatorio')}}" method="GET">
                        <button name = "tipo_relatorio" type = "submit" value = "proap">Relatório Proap</button>
                        <button name = "tipo_relatorio" type = "submit" value = "proapinho">Relatório Proapinho</button>
                    </form>
                </div>
                <div class = "conteudo-tabela">
                    <table>
                        <thead>
                            <tr>
                                <th>Programa </th>
                                <th>Tipo</th>
                                <th>Diária civil</th>
                                <th>Diária inter</th>
                                <th>Passagens</th>
                                <th>SEPE</th>
                                <th>Não Servidor</th>
                                <th>Aux. estudantil</th>
                                <th>Aux. pesquisador</th>
                                <th>Consumo</th>
                                <th>Serv. terceiros</th>
                                <th>Transporte</th>
                                <th>Total</th>
                                <th> </th>                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programas as $programa )
                            <tr id = "{{$programa->id_prog}}"> 
                                <td> {{$programa->nom_prog}}-{{teste($programa->created_at)}} </td>
                                <td> {{$programa->tipo_prog}} </td>
                                <td>R$ {{number_format($programa->dia_civ/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->dia_int/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->pass/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->sepe/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->nao_serv/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->aux_est/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->aux_pes/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->cons/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->ser_ter/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->tran/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->total/100, 2, '.', ',')}} </td> 
                                <td> <a href="{{ route('excluirPrograma',['id_prog' => $programa->id_prog])}}" class = "excluir" > <i class="fa-solid fa-trash-can"></i> </a> </td>      
                            </tr>
                            @endforeach 
                        </tbody>
                    </table> 
                </div>
            </div>  
            
            <form id="delete-Form" action="" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
@endsection
@section('scripts')
    $(document).ready(function() {

       
        
        $("#search").on("input", function() {
            const value = $(this).val().toLowerCase();
            const tabela = $('tbody tr');
            tabela.each(function(element){
                 if($(this).find('td:eq(0)').text().toLowerCase().includes(value) || $(this).find('td:eq(1)').text().toLowerCase().includes(value)){
                    $(this).removeClass("hide");
                 }
                 else{
                    $(this).addClass("hide");
                 }
            })
        });

        function deletarPrograma(link){
            if(confirm("Isso deletará todos os pedidos e o coordenador referente a esse programa. Continuar ?")){
                $('#delete-Form').attr('action', link).submit(); 
            }
        };

        
        $('table tbody').on('click', '.excluir', function(event) {
            event.preventDefault();
            deletarPrograma($(this).attr('href')); 
        });  
    });
    @if($errors->any()) $('#popup').addClass("open-popup") @endif
@endsection





   
    

