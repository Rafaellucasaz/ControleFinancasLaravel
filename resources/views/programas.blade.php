@extends('layouts.layout')
@section('titulo', 'Programas')
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

@section('main')
    <h1>Programas</h1>
            
    
            <div class = "tabela">
                <x-search-box/>
                <div class = "buttons">
                    <button id = "abrirPopup" > Cadastrar novo programa</button>
                    <form action="{{route('edicao')}}" method ="post">
                        @method('PATCH')
                        <button name = "edicao"  type = "submit" value ="true">liberar para edição</button>
                        <button name = "edicao"  type = "submit" value = "false"> trancar edição</button>
                        @csrf
                    </form>
                </div>
            
                <table>
                    <thead>
                        <tr>
                            <th>Programa </th>
                            <th> Tipo </th>
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
                        <tr class = "{{$programa->id_prog}}" id = "{{$programa->id_prog}}"> 
                            <td> {{$programa->nom_prog}} </td>
                            <td> {{$programa->tipo_prog}} </td>
                            <td> {{$programa->dia_civ}} </td>
                            <td> {{$programa->dia_int}} </td>
                            <td> {{$programa->pass}} </td>
                            <td> {{$programa->sepe}} </td>
                            <td> {{$programa->nao_serv}} </td>
                            <td> {{$programa->aux_est}} </td>
                            <td> {{$programa->aux_pes}} </td>
                            <td> {{$programa->cons}} </td>
                            <td> {{$programa->ser_ter}} </td>
                            <td> {{$programa->tran}} </td>
                            <td> {{$programa->total}} </td> 
                            <td> <a href="{{ route('excluirPrograma',['id_prog' => $programa->id_prog])}}" class = "excluir" > <i class="fa-solid fa-trash-can"></i> </a> </td>      
                        </tr>
                        @endforeach 
                    </tbody>
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
        const table = @php echo json_encode($programas)@endphp ;
        table.forEach(row => {
            var id = row.id_prog;
            var linha = $("#" + id);
            if (row.nom_prog.toLowerCase().includes(value) || row.tipo_prog.toLowerCase().includes(value)) {
                linha.removeClass("hide"); 
            } else {
                linha.addClass("hide"); 
            }
        });
    });

    // Função para deletar programa
    function deletarPrograma(link){
        console.log("teste");
        if(confirm("Isso deletará todos os pedidos e o coordenador referente a esse programa. Continuar ?")){
            $('#delete-Form').attr('action', link).submit(); 
        }
    };

    // Chama função de deletar 
    $('table tbody').on('click', '.excluir', function(event) {
        event.preventDefault();
        deletarPrograma($(this).attr('href')); 
    });
});

@endsection

@if($errors->any()) <script type="text/javascript" > popup.classList.add("open-popup") </script> @endif

   
    

