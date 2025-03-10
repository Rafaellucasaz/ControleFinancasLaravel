@extends('layouts.layout')

@section('head')
<link rel="stylesheet" href="/css/valores.css">
@endsection

@section('popup')
    <div class="popup" id = "popup"> 
       
        <form action="{{route('cadastrarValores')}}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id_prog" value = "{{$programa->id_prog}}">
            <div class = "popup-input">
                <label for="dia_civ">Diária pessoa civil</label>
                <input type="number" name="dia_civ" id = "dia_civ"  min = 0 step = 0.01 value = "{{$programa->dia_civ/100}}">
                {{mostrarErros("dia_civ",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="dia_int">Díaria internacional</label>
                <input type="number" name="dia_int" id = "dia_int"  min = 0 step = 0.01 value = "{{$programa->dia_int/100}}">
                {{mostrarErros("dia_int",$errors)}}
            </div>
            <div class = "popup-input">    
                <label for="pass">Passagem</label>
                <input type="number" name="pass" id ="pass" min = 0  step = 0.01 value = "{{$programa->pass/100}}">
                {{mostrarErros("pass",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="sepe">Sepe</label>
                <input type="number" name="sepe" id = "sepe" min = 0 step = 0.01 value = "{{$programa->sepe/100}}">
                {{mostrarErros("sepe",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="nao_serv">Não Servidor</label>
                <input type="number" name="nao_serv" id = "nao_serv"  min = 0  step = 0.01 value = "{{$programa->nao_serv/100}}">
                {{mostrarErros("nao_serv",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="aux_estu">Auxílio Estudante</label>
                <input type="number" name="aux_estu" id = "aux_estu" min = 0 step = 0.01  value = "{{$programa->aux_estu/100}}">
                {{mostrarErros("aux_estu",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="aux_pesq">Auxílio Pesquisador</label>
                <input type="number" name="aux_pesq" id = "aux_pesq" min = 0 step = 0.01 value = "{{$programa->aux_pesq/100}}">
                {{mostrarErros("aux_pesq",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="cons">Material de Consumo</label>
                <input type="number" name="cons" id = "cons" min = 0 step = 0.01 value = "{{$programa->cons/100}}">
                {{mostrarErros("cons",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="ser_ter">Serviço de Terceiros</label>
                <input type="number" name="ser_ter" id ="ser_ter" min = 0 step = 0.01 value = "{{$programa->ser_ter/100}}">
                {{mostrarErros("ser_ter",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="tran">Transporte</label>
                <input type="number" name="tran" id ="tran" min = 0 step = 0.01 value = "{{$programa->tran/100}}">
                {{mostrarErros("tran",$errors)}}
            </div>
            <div class = "popup-buttons">
                <button type="submit">Cadastrar</button>
                <button id="fecharPopup" type ="reset" >Cancelar</button>
            </div>
        </form>
    </div>
@endsection
@section('navbar')
@include('components.navbarCoord')

@endsection

@if($programa->tipo_prog == 'proapinho')
@section('h1', 'Valores ' . $programa->nom_prog . '-PAPG')
@else
@section('h1', 'Valores ' . $programa->nom_prog . '-' . strToUpper($programa->tipo_prog))
@endif

@section('main')
            

    <div class = "tabela"> 
        <table>
            <thead>
                <tr>
                    <th>Diária civil</th>
                    <th>Diária internacional</th>
                    <th>Passagens</th>
                    <th>SEPE</th>
                    <th>Não Servidor</th>
                    <th>Aux. estudantil</th>
                    <th>Aux. pesquisador</th>
                    <th>Consumo</th>
                    <th>Serv. terceiros</th>
                    <th>Transporte</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr> 
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
                    <tr>
            </tbody>
        </table> 
    </div>  
    @if($programa->edit)
        <div class = "button"><button id = "abrirPopup" >Cadastrar valores</button> </div>
    
    @else
        <h2>Prazo para cadastro finalizado</h2>
    
    @endif
   
@endsection

