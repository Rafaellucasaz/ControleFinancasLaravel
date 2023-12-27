@extends('layouts.layout')

@section('head')
<link rel="stylesheet" href="/css/pedidos.css">
@endsection

@section('navbar')
@include('components.navbarCoord')
@endsection


@section('h1', 'Pedidos ' . $programa->nom_prog . '-' . $programa->tipo_prog)
@section('main')
 
    
    <div class = "tabela">
        <div class = "buttons" >  
            <form id="select-form" >
                <input type="hidden" name = "id_prog" value = "{{$programa->id_prog}}">
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
                    <th id ="nPed-header">nº</th>
                    <th id ="data-header">data</th>
                    <th id ="val-header">valor</th>
                    <th id = "det-header">detalhamento</th>
                    <th id ="ben-header">beneficiado</th>
                    <th id ="pcdp-header">nº PCDP</th>
                    <th id ="prest-header">Prestação de contas</th>
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
                url: '{{ route("getPedidos") }}',
                method: 'GET',
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data.length === 0 && $('#tipo_ped').val() != null ) {
                        $('.semPedidos').html('<h2> Sem pedidos </h2>');
                        $('table tbody').html('');
                    } else {
                        $('.semPedidos').html('');
                        var tabela = '';
                       
                        data.forEach(function(pedido) {
                            tabela += `<tr>
                                <td>${pedido.num_ped}</td>
                                <td>${pedido.data}</td>
                                <td>R$ ${(pedido.val/100).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>${pedido.det}</td>
                                <td>${pedido.ben}</td>
                                <td>${pedido.pcdp}</td>
                                <td>${pedido.prest}</td>
                            </tr>`;
                        });
                        $('table tbody').html(tabela);
                    }
                }
            });
        }
        $('#tipo_ped').change(function() {
            atualizarTabela();
        });

        atualizarTabela();
    });
@endsection



    

    

  
