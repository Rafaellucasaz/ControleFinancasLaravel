@extends('layouts.layout')
@section('head')
<link href="/css/coordenadores.css" rel="stylesheet"/>
@endsection
@section('popup')
<div class="popup" id = "popup">
    
    <form action="{{route('cadastrarCoordenador')}}" method= "post" >
        @csrf
        <div class = "radio">
            <label for="proap">Proap</label>
            <input type="radio" value = "proap" name = "tipo_prog" id = "proap" required>
            <label for="proapinho">proapinho</label>
            <input type="radio" value = "proapinho" name = "tipo_prog" id = "proapinho" required>
        </div>
        <div class = "popup-input">
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" id ="nome" required {{getValoresAntigos("nome",$errors)}}>
            {{mostrarErros("nome",$errors)}}
        </div>
        <div class = "popup-input">
            <label for="nom_prog">Sigla do programa</label>
            <input type="text" name = "nom_prog" id = "nom_prog" required {{getValoresAntigos("nom_prog",$errors)}}>
            {{mostrarErros("nom_prog",$errors)}}
        </div>
        <div class = "popup-input">
            <label for="username">nome de usuário</label>
            <input type="text" name="username" id = "username" required {{getValoresAntigos("username",$errors)}}>
            {{mostrarErros("username",$errors)}}
        </div>
        <div class = "popup-input">
            <label for="password">Senha</label>
            <input type="text" name = "password" id ="password" required {{getValoresAntigos("password",$errors)}}>
            {{mostrarErros("password",$errors)}}
        </div>   
        <div class = "popup-buttons"> 
            <button  type="submit">Cadastrar</button>
            <button  type="reset" id ="fecharPopup" > Cancelar</button>
        </div>
    </form>
</div>
@endsection

@section('navbar')
@include('components.navbarAdmin')
@endsection
@section('h1','Coordenadores')
@section('main')
    
   
    
    <div class = "tabela">
        <x-search-box/>
        <div class = "buttons" >  
            <button  id = "abrirPopup" > Cadastrar Coordenador </button> 
        </div>
        <table>
            <tr>
                <th>Coordenador </th>
                <th>Nome de usuário</th>
                <th>Programa</th>
                <th>Tipo</th>
                <th></th>
            </tr>

             @foreach ($coordenadores as $coordenador)
                <tr class = "{{$coordenador['username']}}"  id = "{{$coordenador['username']}}">
                    <td> {{$coordenador['coordenador']}} </td>
                    <td> {{$coordenador['username']}} </td>
                    <td> {{$coordenador['programa']}} </td>
                    <td> {{$coordenador['tipo']}} </td>
                    <td> <a href="{{ route('excluirCoordenador',['id_log' => $coordenador['id_log']])}}" class = "excluir"> <i class="fa-solid fa-trash-can"></i> </a> </td>  
                </tr>
            @endforeach 

        </table> 
    </div>  
    <form id="delete-Form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('scripts')
$(document).ready(function() {
        
    // Função para filtrar as linhas da tabela com base na entrada
    $("#search").on("input", function() {
        const value = $(this).val().toLowerCase();
        const table = @php echo json_encode($coordenadores)@endphp ;
        table.forEach(row => {
            var id = row.username;
            var linha = $("#" + id);
            if (row.coordenador.toLowerCase().includes(value) || row.username.toLowerCase().includes(value) || row.programa.toLowerCase().includes(value)){
                linha.removeClass("hide"); 
            } else {
                linha.addClass("hide"); 
            }
        });
    });

    // Função para deletar coordenadores
    function deletarCoordenador(link){
        $('#delete-Form').attr('action', link).submit(); 
    };

    // Chama função de deletar 
    $('table tbody').on('click', '.excluir', function(event) {
        event.preventDefault();
        deletarCoordenador($(this).attr('href')); 
    });
});
@if($errors->any()) $('#popup').addClass("open-popup") @endif
@endsection


