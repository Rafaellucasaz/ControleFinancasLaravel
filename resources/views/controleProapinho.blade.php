<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Proapinho</title>
    <link href="/css/controles.css" rel="stylesheet"/>
    <link  href="/css/tabelas.css" rel="stylesheet"/>
    <link  href="/css/componentes.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
</head>
    <div class="popup" id = "popup">
        <form action="{{route('cadastrarPedido')}}" method = "post">
        <br><br>
        @csrf
        <label for="programa">programa</label>
        <br>
        <select name="programa" id="programa">
        <option value="" disabled selected>Selecionar</option>
        @foreach ($programas as $programa)
        <option value ="{{$programa}}" {{isSelected("programa",$programa)}}> </option>;
        @endforeach
        </select>
        <br>
        <label for="pedido">tipo de pedido</label>
        <br>
        <select name="tipo_ped" class="tipo" id = "pedido">
            <option value="" disabled selected>Selecionar</option>
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
        <br>
        <label for="n_ped">Nº Pedido</label> 
        <br>
        <input type="number" name="num_ped" class = "num_ped" id = "num_ped" min = 1 required {{mostrarErros("num_ped",$errors)}}>
        <br>
        <label for="data"> Data</label>
        <br>
        <input type="date" name="data" class = "date" id = "data" required {{mostrarErros("data",$errors)}}>
        <br>
        <label for="val"> Valor</label>
        <br>
        <input type="number" name="val" class = "val" id = "val"min = 1 step = "0.01" required {{mostrarErros("val",$errors)}}> 
        <br>
        <label for="pcdp"> Nº PCDP</label>
        <br>
        <input type="text" name="pcdp" class = "pcdp" id = "pcdp" required {{mostrarErros("pcdp",$errors)}}>
        <br>
        <label for="det"> Detalhamento</label>
        <br>
        <textarea name="det" id="det" cols="30" rows="5" required {{mostrarErros("det",$errors)}}></textarea>
        <br>
        <label for="ben"> Beneficiado</label>
        <br>
        <input type="text" name="ben" class = "ben" id = "ben" required {{mostrarErros("ben",$errors)}};>
        <br><br>
        <label for="prest"> Prestação de contas</label>
        <br>
        <input type="text" name="prest" class = "prest-contas" id = "prest">
        <br><br>
        <input type="hidden" name = "tipo_prog" value ="proapinho">
        <button class="submit" type="submit">Cadastrar</button>
        <button  class = "submit"id = "fecharPopup">Cancelar</button>
        <br><br>
    </form>
    </div>
<body>
    
    @include('components.navbarAdmin')

    @if (session('sucesso'))
    <x-msg class="sucesso" :msg="session('sucesso')"/>
    @endif

    @if (session('erro'))
    <x-msg class="erro" :msg="session('erro')"/>
    @endif

    
<main>
    <h1>Pedidos Proapinho </h1>   
    

    
<br><br>

        
        <div class = "tabela">
            <div class = "buttons" >  
                <button class = "submit" id = "abrirPopup" > Cadastrar pedido </button>
                <form id="select-form">
                    @csrf
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
        </div>
    </main>
</body>
</html>



<script>

    $(document).ready(function() {
        $("#abrirPopup").on("click", function(event) {
            event.preventDefault();
            $("#popup").addClass("open-popup");
        });
    
        $("#fecharPopup").on("click", function() {
            $("#popup").removeClass("open-popup");
        });
       
        $('#nom_prog').change(function(){
            var formData = $('#select-form').serialize();
            $.ajax({
                url: '{{ route("viewPedidosProapinho") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(data){
                    console.log(data);
                    let tabela = '';
    
                    data.forEach(function(pedido){
                        let urlEditar = '{{route("indexEditarPedido",":id" )}}';
                        urlEditar = urlEditar.replace(':id',pedido.id_ped);
                        console.log(urlEditar);
                        let urlExcluir = '{{route("excluirPedido",":id")}}';
                        urlExcluir = urlExcluir.replace(':id',pedido.id_ped);
                        tabela += '<tr>';
                        tabela += '<td>' + pedido.num_ped + '</td>';
                        tabela += '<td>' + pedido.data + '</td>';
                        if((pedido.val/100)% 1 === 0){tabela += '<td> R$ ' + pedido.val/100 + '.00</td>';}
                        else{tabela += '<td> R$ ' + pedido.val/100 + '</td>';}
                        tabela += '<td>' + pedido.det + '</td>';
                        tabela += '<td>' + pedido.ben + '</td>';
                        tabela += '<td>' + pedido.pcdp + '</td>';
                        tabela += '<td>' + pedido.prest + '</td>';
                        tabela += '<td>  <a href ="' + urlEditar +  '">  <i class="fa-solid fa-pen-to-square"></i></a></td> ';
                        tabela += '<td>  <a href ="' + urlExcluir + '">  <i class="fa-solid fa-trash-can"></i> </a> </td>';
                        tabela += '</tr>';
                    });
                    $('table tbody').html(tabela);
                }
            });
        });
    
        $('#tipo_ped').change(function(){
            var formData = $('#select-form').serialize();
            $.ajax({
                url: '{{ route("viewPedidosProapinho") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(data){
                    
                    console.log(data);
                    let tabela = '';
                    
                    data.forEach(function(pedido){
                        let urlEditar = '{{route("indexEditarPedido",":id" )}}';
                        urlEditar = urlEditar.replace(':id',pedido.id_ped);
                        console.log(urlEditar);
                        let urlExcluir = '{{route("excluirPedido",":id")}}';
                        urlExcluir = urlExcluir.replace(':id',pedido.id_ped);
                        tabela += '<tr>';
                        tabela += '<td>' + pedido.num_ped + '</td>';
                        tabela += '<td>' + pedido.data + '</td>';
                        if((pedido.val/100)% 1 === 0){tabela += '<td> R$ ' + pedido.val/100 + '.00</td>';}
                        else{tabela += '<td> R$ ' + pedido.val/100 + '</td>';}
                        tabela += '<td>' + pedido.det + '</td>';
                        tabela += '<td>' + pedido.ben + '</td>';
                        tabela += '<td>' + pedido.pcdp + '</td>';
                        tabela += '<td>' + pedido.prest + '</td>';
                        tabela += '<td>  <a href ="' + urlEditar +  '">  <i class="fa-solid fa-pen-to-square"></i></a></td> ';
                        tabela += '<td>  <a href ="' + urlExcluir + '">  <i class="fa-solid fa-trash-can"></i> </a> </td>';
                        tabela += '</tr>';
                    });
                    $('table tbody').html(tabela);
                }
            });
        });
        var formData = $('#select-form').serialize();
        $.ajax({
            url: '{{ route("viewPedidosProapinho") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(data){
                    console.log(data);
                    let tabela = '';
    
                    data.forEach(function(pedido){
                        let urlEditar = '{{route("indexEditarPedido",":id" )}}';
                        urlEditar = urlEditar.replace(':id',pedido.id_ped);
                        console.log(urlEditar);
                        let urlExcluir = '{{route("excluirPedido",":id")}}';
                        urlExcluir = urlExcluir.replace(':id',pedido.id_ped);
                        tabela += '<tr>';
                        tabela += '<td>' + pedido.num_ped + '</td>';
                        tabela += '<td>' + pedido.data + '</td>';
                        if((pedido.val/100)% 1 === 0){tabela += '<td> R$ ' + pedido.val/100 + '.00</td>';}
                        else{tabela += '<td> R$ ' + pedido.val/100 + '</td>';}
                        tabela += '<td>' + pedido.det + '</td>';
                        tabela += '<td>' + pedido.ben + '</td>';
                        tabela += '<td>' + pedido.pcdp + '</td>';
                        tabela += '<td>' + pedido.prest + '</td>';
                        tabela += '<td>  <a href ="' + urlEditar +  '">  <i class="fa-solid fa-pen-to-square"></i></a></td> ';
                        tabela += '<td>  <a href ="' + urlExcluir + '">  <i class="fa-solid fa-trash-can"></i> </a> </td>';
                        tabela += '</tr>';
                    });
                    $('table tbody').html(tabela);
                }
        });
    });
    
    
      
    </script>