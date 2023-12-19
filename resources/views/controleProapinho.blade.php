@extends('layouts.layout')
@section('titulo','Controle Proapinho')

@section('head')
<link href="/css/controles.css" rel="stylesheet"/>
@endsection

@section('popup')
    <div class="popup" id = "popup">
        <form action="{{route('cadastrarPedido')}}" method = "post">
        
            @csrf
            <div class = "popup-selects">
                <select name="programa" id="programa" required  >
                    <option value="" disabled selected>Selecionar programa</option>
                @foreach ($programas as $programa)
                    <option value ="{{$programa}}" {{isSelected("programa",$programa)}}>{{$programa}} </option>;
                @endforeach
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
            <button  type="submit" >Cadastrar</button>
            <button  type="reset"id = "fecharPopup">Cancelar</button>
            </div>
        </form>
    </div>
@endsection

@section('navbar')
    @include('components.navbarAdmin') 
@endsection

@section('main')
    <h1>Pedidos Proapinho </h1>   
        
    <div class = "tabela">
        <div class = "buttons" >  
            <button id = "abrirPopup" > Cadastrar pedido </button>
            <form id="select-form">    
                <input type="hidden" name="tipo_prog" value = "proapinho">
                <select name="nom_prog"  id="nom_prog" >
                    <option value="" disabled selected>Selecionar programa</option>
                    @foreach ($programas as $programa)
                    <option value ="{{$programa}}" {{isSelected("programa",$programa)}} >{{$programa}} </option>;
                    @endforeach
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
        </div>
        <table>
            <thead>
                <tr>
                    <th>nº ped</th>
                    <th>data</th>
                    <th>valor</th>
                    <th>detalhamento</th>
                    <th>beneficiado</th>
                    <th>nº PCDP</th>
                    <th>Prestação de contas</th>
                    <th>EDITAR</th>
                    <th>EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class = "semPedidos"></div>
    </div>

    <form id="delete-Form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('scripts')
    $(document).ready(function() {
            
        function atualizarTabela() {
            var formData = $('#select-form').serialize();
            $.ajax({
                url: '{{ route("viewPedidos") }}',
                method: 'GET',
                data: formData,
                success: function(data) {
                    if (data.length === 0 && $('#tipo_ped').val() != null && $('#nom_prog').val() != null) {
                        $('.semPedidos').html('<h2> Sem pedidos </h2>');
                        $('table tbody').html('');
                    } else {
                        $('.semPedidos').html('');
                        var tabela = '';
                        var urlEditar = '{{ route("indexEditarPedido", ":id") }}';
                        var urlExcluir = '{{ route("excluirPedido", ":id") }}';

                        data.forEach(function(pedido) {
                            var editarUrl = urlEditar.replace(':id', pedido.id_ped);
                            var excluirUrl = urlExcluir.replace(':id', pedido.id_ped);
                            tabela += `<tr>
                                <td>${pedido.num_ped}</td>
                                <td>${pedido.data}</td>
                                <td>${(pedido.val / 100) % 1 === 0 ? 'R$ ' + pedido.val / 100 + '.00' : 'R$ ' + pedido.val / 100}</td>
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
        $('#nom_prog, #tipo_ped').change(function() {
            atualizarTabela();
        });

        atualizarTabela();

        function deletarPedido(link){
            console.log('teste');
            $('#delete-Form').attr('action', link).submit();
        };    
        $('table tbody').on('click', '.excluir', function(event) {
        event.preventDefault();
        deletarPedido($(this).attr('href'));
        });
    });
@if($errors->any()) $('#popup').addClass("open-popup") @endif
@endsection
