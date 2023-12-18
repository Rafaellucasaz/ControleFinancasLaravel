@extends('layouts.layout')

@section('titulo','Pedidos')

@section('head')
<link rel="stylesheet" href="/css/pedidos.css">
@endsection

@section('navbar')
@include('components.navbarCoord')
@endsection

@section('main')
    <h1>Pedidos {{$programa->nom_prog }}-{{$programa->tipo_prog}}</h1>   
    
    
    <form id="select-form" >
        <label for="tipo">tipo</label>
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

    <div class = "tabela">
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
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    $(document).ready(function() {
                
        function atualizarTabela() {
            var formData = $('#select-form').serialize();
            $.ajax({
                url: '{{ route("viewPedidosProapinho") }}',
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
    });
@endsection



    

    

  
