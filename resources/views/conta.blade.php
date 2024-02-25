@extends('layouts.layout')
 
@section('head')
<link rel="stylesheet" href="/css/conta.css">
@endsection

@section('navbar')
@include('components.navbarCoord')
@endsection
@section('popup')
<div class = "popup" id = "popup">
    <form action="{{route("alterarSenha")}}" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" name = "id_log" value = {{session('id_log')}} >
        <input type="hidden" name = "id_prog" value = {{session('id_prog')}}>
        <div class = "input">
            <label for="password">Nova senha</label>
            <input type="password" name = "password" id = "password" >
            {{mostrarErros("password",$errors)}}
        </div>
        <div class = "input">
            <label for="passwordConfirm">Confirmar senha</label>
            <input type="password" name = "passwordConfirm" id = "passwordConfirm" >
            {{mostrarErros("passwordConfirm",$errors)}}
        </div>
        <div>
            <button type = "submit">Confirmar</button>
            <button type = "reset" id = "fecharPopup">Cancelar</button>
        </div>
    </form>
</div>
@endsection
@section('main')
<h1>Informações de usuário</h1>
<section >
   <form action="">
        <div class = "input">
            <label for="nome">Nome</label>
            <input type="text" name="" id="nome" value = "{{$infos['nome']}}" readonly>
        </div>
        <div class = "input">
            <label for="username">Nome de usuário</label>
            <input type="text" name="" id="username" value = "{{$infos['username']}}" readonly>
        </div>
        <div class = "input">
            <label for="programa">Programa</label>
            <input type="text" name="" id="programa" value = "{{$infos['programa']}}" readonly>
        </div>
       
        <div>
            <button id = "abrirPopup">Alterar Senha</button>
        </div>
   </form>
</section>
    
@endsection

@section('scripts')
@if($errors->any()) $('#popup').addClass("open-popup") @endif
@endsection


