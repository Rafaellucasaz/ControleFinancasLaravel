@extends('layouts.layout')
@section('head')
<link href="/css/programas.css" rel="stylesheet"/>
@endsection

@section('popup')
<div class = "popup" id = "popup">
    <form action="{{route('cadastrarNovoPrograma')}}" method="post">
        <div class = "radio">
            <label for="proap">PROAP</label>
            <input type="radio" value = "proap" name = "tipo_prog" id = "proap" required >
            <label for="proapinho">PAPG</label>
            <input type="radio" value = "proapinho" name = "tipo_prog" id = "proapinho" required>
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
<div class = "popup" id = "relatorio-popup">
    <form action="{{Route("relatorio")}}" method = "GET">
        <div class = "radio">
            <label for="proap">PROAP</label>
            <input type="radio" value = "proap" name = "tipo_prog" id = "proap" required >
            <label for="proapinho">PAPG</label>
            <input type="radio" value = "proapinho" name = "tipo_prog" id = "proapinho" required>
        </div>
        <div>
            <label for="ano">Ano</label>
            <select name="ano" id="ano">
                @foreach($anos as $ano)
                    <option value="{{$ano}}">{{$ano}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type = "submit">Gerar Relatório</button>
            <button type = "reset" id = "fecharRelatorio">Cancelar</button>
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

                        <button name = "edicao"  type = "submit" value ="true">Liberar todos</button>
                        <button name = "edicao"  type = "submit" value = "false">Trancar todos</button>
                        @csrf
                    </form>
                   <div>
                    <button type = "button" id = "relatorio">Relatório</button>
                    </div>
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
                                <th></th>              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programas as $programa )
                            <tr id = "{{$programa->id_prog}}"> 
                                <td> {{$programa->nom_prog}}-{{yearFormat($programa->created_at)}} </td>
                                <td>@if($programa->tipo_prog == 'proapinho' ) PAPG @else {{strToUpper($programa->tipo_prog)}}@endif </td>
                                <td>R$ {{number_format($programa->dia_civ/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->dia_int/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->pass/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->sepe/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->nao_serv/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->aux_estu/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->aux_pesq/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->cons/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->ser_ter/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->tran/100, 2, '.', ',')}} </td>
                                <td>R$ {{number_format($programa->total/100, 2, '.', ',')}} </td> 
                                <td>
                                    <form action="{{route('edicao')}}" method="post">
                                        <input type="hidden" name="id_prog" value = "{{$programa->id_prog}}">
                                        @method('PATCH')
                                        @if($programa->edit == true)
                                        <button name = "edicao"  type = "submit" value = "false">Trancar edição</button>
                                        @else
                                        <button name = "edicao"  type = "submit" value ="true">Liberar para edição</button>
                                        @endif
                                        @csrf
                                    </form>
                                </td>
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

       
        $("#relatorio").on("click",function(){
            $("#relatorio-popup").addClass("open-popup");
        })
        $("#fecharRelatorio").on("click",function(){
            $("#relatorio-popup").removeClass("open-popup");
        })

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





   
    

