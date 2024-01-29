@extends('layouts.layout')


@section('head')
<link href="/css/controles.css" rel="stylesheet"/>
<link rel="stylesheet" href="/css/msg.css">
@endsection

@section('popup')
    <div class="popup" id = "popup">
        <form id = "form-ped" action ={{route("cadastrarPedido")}} method = "POST">
        
            @csrf
            <div class = "popup-selects">
                <select name="id_prog" id="id_prog-popup" required  >
                </select>
                            
                <select name="tipo_ped" class="tipo" id = "pedido" required >
                    <option value="" disabled selected>Selecionar tipo de pedido</option>
                    <option value="dia_civ" {{isSelected("tipo_ped","dia_civ")}}>Diária pessoal civil</option>
                    <option value="dia_int" {{isSelected("tipo_ped","dia_int")}}>Diária internacional</option>
                    <option value="pass" {{isSelected("tipo_ped","pass")}}>Passagem</option>
                    <option value="sepe" {{isSelected("tipo_ped","sepe")}}>Sepe</option>
                    <option value="nao_serv" {{isSelected("tipo_ped","nao_serv")}}>Não servidor</option>
                    <option value="aux_estu" {{isSelected("tipo_ped","aux_estu")}}>Auxílio estudantil</option>
                    <option value="aux_pesq" {{isSelected("tipo_ped","aux_pesq")}}>Auxílio pesquisador</option>
                    <option value="cons" {{isSelected("tipo_ped","cons")}}>Material de consumo</option>
                    <option value="ser_ter" {{isSelected("tipo_ped","ser_ter")}}>Serviços de terceiros</option>
                    <option value="tran" {{isSelected("tipo_ped","tran")}}>Transportes</option>
                </select>
                
            </div>
            <div class = "popup-input">
                <label for="num_ped">Nº Pedido</label> 
                <input type="number" name="num_ped" class = "num_ped" id = "num_ped" min = 1 required {{getValoresAntigos("num_ped",$errors)}}  >
                {{mostrarErros("num_ped",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="data"> Data</label>
                <input type="date" name="data" class = "date" id = "data" required {{getValoresAntigos("data",$errors)}} >
                {{mostrarErros("data",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="val"> Valor</label>
                <input type="number" name="val" class = "val" id = "val"min = 1 step = "0.01" required {{getValoresAntigos("val",$errors)}} >
                {{mostrarErros("val",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="pcdp"> Nº PCDP</label>
                <input type="text" name="pcdp" class = "pcdp" id = "pcdp" required {{getValoresAntigos("pcdp",$errors)}}   > 
                {{mostrarErros("pcdp",$errors)}}
            </div>
            <div class = "popup-input">
                <label for="det"> Detalhamento</label> 
                <textarea name="det" id="det" cols="22" rows="5" required >{{getValoresAntigos("det",$errors)}}</textarea>
                {{mostrarErros("det",$errors)}}
            </div>
            <div class = "popup-input">
            <label for="ben"> Beneficiado</label>
            <input type="text" name="ben" class = "ben" id = "ben" required {{getValoresAntigos("ben",$errors)}}>
            {{mostrarErros("ben",$errors)}}
            </div>
            <div class = "popup-input">
            <label for="prest"> Prestação de contas</label>
            <input type="text" name="prest" class = "prest-contas" id = "prest" {{getValoresAntigos("prest",$errors)}}>
            {{mostrarErros("prest",$errors)}}
            </div>
            <input type="hidden" name = "tipo_prog" value ="proapinho">
            <div class = "popup-buttons">
            <button  type="submit" id ="cad-ped" >Cadastrar</button>
            <button  type="reset"id = "fecharPopup">Cancelar</button>
            </div>
        </form>
    </div>
@endsection

@section('navbar')
    @include('components.navbarAdmin') 
@endsection

@section('h1','Pedidos Proapinho')
@section('main')
        
    <div class = "tabela">
        <div class = "buttons" >  
            <div>
                <button id = "abrirPopup" > Cadastrar pedido </button>
            </div>
            <form id="select-form">
                <select name="id_prog"  id="id_prog" >
                    <option disabled selected>Selecione o programa </option>
                </select>
                <select name="tipo_ped" id = "tipo_ped" >
                    <option value="" disabled selected>Selecionar tipo de pedido</option>
                    <option value="dia_civ" {{isSelected("tipo_ped","dia_civ")}}>Diária pessoal civil</option>
                    <option value="dia_int" {{isSelected("tipo_ped","dia_int")}}>Diária internacional</option>
                    <option value="pass" {{isSelected("tipo_ped","pass")}}>Passagem</option>
                    <option value="sepe" {{isSelected("tipo_ped","sepe")}}>Sepe</option>
                    <option value="nao_serv" {{isSelected("tipo_ped","nao_serv")}}>Não servidor</option>
                    <option value="aux_estu" {{isSelected("tipo_ped","aux_estu")}}>Auxílio estudantil</option>
                    <option value="aux_pesq" {{isSelected("tipo_ped","aux_pesq")}}>Auxílio pesquisador</option>
                    <option value="cons" {{isSelected("tipo_ped","cons")}}>Material de consumo</option>
                    <option value="ser_ter" {{isSelected("tipo_ped","ser_ter")}}>Serviços de terceiros</option>
                    <option value="tran" {{isSelected("tipo_ped","tran")}}>Transportes</option>
                </select>
            </form>
            <form id = "ano-form">
                <select name="ano" id="ano">
                    @foreach($anos as $ano)
                        <option value="{{$ano}}">{{$ano}}</option>
                    @endforeach
                </select>
                <input type="hidden" name = "tipo_prog" value = "proapinho">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th id ="nPed-header">nº</th>
                    <th id ="data-header">data</th>
                    <th id ="val-header">valor</th>
                    <th id = "det-header">detalhamento</th>
                    <th id ="ben-header">beneficiado</th>
                    <th id ="pcdp-header">nº PCDP</th>
                    <th id ="prest-header">Prestação de contas</th>
                    <th id = "editar-header"></th>
                    <th id = "excluir-header"></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div id = "semPedidos"></div>
    </div>

    <form id="delete-Form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('scripts')
    $(document).ready(function() {
        
        function atualizarSelect(){
            var formData = $('#ano-form').serialize();
            var id_prog = "{{old("id_prog")}}";
            $.ajax({
            url: '{{route("getProgramas")}}',
            method: 'GET',
            data: formData,
            success: function(data){
                var options = '<option disabled selected>Selecione o programa </option>'
                data.forEach(function(programa){
                    if(programa.id_prog == id_prog){
                        options += '<option value="' + programa.id_prog + '" selected>' + programa.nom_prog + '</option>'
                    }
                    else{
                        options += '<option value="' + programa.id_prog + '">' + programa.nom_prog + '</option>'
                    }
                });
                $('#id_prog').html(options);
                $('#id_prog-popup').html(options);
                atualizarTabela();
            }
        });
        }
        atualizarSelect();

        $('#ano').change(function(){
            atualizarSelect();
        });
    
        
        function atualizarTabela() {
            var formData = $('#select-form').serialize();
            $.ajax({
                url: '{{ route("getPedidos") }}',
                method: 'GET',
                data: formData,
                success: function(data) {
                    if (data.length === 0 && $('#tipo_ped').val() != null && $('#id_prog').val() != null) {
                        $('#semPedidos').html('<h2> Sem pedidos </h2>');
                        $('table tbody').html('');
                        
                    } else {
                        
                        $('#semPedidos').html('');
                        var tabela = '';
                        var urlEditar = '{{ route("indexEditarPedido", ":id") }}';
                        var urlExcluir = '{{ route("excluirPedido", ":id") }}';

                        data.forEach(function(pedido) {
                            var editarUrl = urlEditar.replace(':id', pedido.id_ped);
                            var excluirUrl = urlExcluir.replace(':id', pedido.id_ped);
                            tabela += `<tr>
                                <td>${pedido.num_ped}</td>
                                <td>${pedido.data}</td>
                                <td>R$ ${(pedido.val/100).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>${pedido.det}</td>
                                <td>${pedido.ben}</td>
                                <td>${pedido.pcdp}</td>
                                <td>${pedido.prest}</td>
                                <td><a href="${editarUrl}"><i class="fa-solid fa-pen-to-square"></i></a></td>   
                                <td><a href="${excluirUrl}"  class = "excluir"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>`;
                        });
                        $('table tbody').html(tabela);
                    }
                }
            });
        }
        $('#id_prog, #tipo_ped').change(function() {
            atualizarTabela();
        });

        

        function deletarPedido(link){
            $('#delete-Form').attr('action', link).submit();
        };    
        $('table tbody').on('click', '.excluir', function(event) {
        event.preventDefault();
        deletarPedido($(this).attr('href'));
        });
    });
@if($errors->any()) $('#popup').addClass("open-popup") @endif
@endsection
