@extends('layouts.layout')
 
@section('head')
<link rel="stylesheet" href="/css/editarPedido.css">
@endsection

@section('navbar')
@include('components.navbarAdmin')
@endsection



@section('main')
<div style = "display: flex; flex-direction:column; align-items:center;">
    <h1>Edição pedido Nº {{$pedido->num_ped}}</h1>
</div>
    <h2>Programa: {{ $programa->nom_prog .'-'. $programa->tipo_prog}} Tipo de pedido: {{getTipoPed($pedido->tipo_ped)}}</h2>
    <form action="{{route('editarPedido')}}" method = "Post">
        @method('PATCH')
        @csrf
        <div class = "form">
        <label for="data">Data</label>
        <input type="hidden" name="id_ped" value = "{{$pedido->id_ped}}">
        <input type="hidden" name = "tipo_prog" value = "{{$programa->tipo_prog}}">
        <input type="date" name = "data" id = "data" value ="{{$pedido->data}}" required >
        <label for="val">Valor</label>
        <input type="number" name = "val" id = "val" value = "{{$pedido->val/100}}" min = 1 step = "0.01" required  >
        <label for="det">Detalhamento</label>
        <textarea name="det" id="det" cols="30" rows="5" required >{{$pedido->det}}</textarea>
        <label for="ben">Beneficiado</label>
        <input type="text"  name = "ben" id = "ben" required value = "{{$pedido->ben}}" >
        <label for="pcdp">Nº pcdp</label>
        <input type="text" name = "pcdp" id = "pcdp" required value = "{{$pedido->pcdp}}" >
        <label for="prest">Prestação de contas</label>
        <input type="text"  name = "prest" id = "prest"  value = "{{$pedido->prest}}" >
        <div class = "button-edit">
            <button type = "submit" name = "submitEdit">Confirmar</button>
        </div>
    </div>
    </form>
@endsection
<!DOCTYPE html>