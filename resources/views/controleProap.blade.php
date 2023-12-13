<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link href="/css/controles.css" rel="stylesheet"/>
    <link  href="/css/tabelas.css" rel="stylesheet"/>
    <link  href="/css/componentes.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.navbarAdmin')

    @if (session('sucesso'))
    <x-msg class="sucesso" :msg="session('sucesso')"/>
    @endif

    @if (session('erro'))
    <x-msg class="erro" :msg="session('erro')"/>
    @endif

    <div class="popup" id = "popup">

        
        <form action="{{route('cadastrarPedido')}}" method = "post">
        <br><br>
        @csrf
        <label for="programa">programa</label>
        <br>
        <select name="programa" id="programa">
        <option value="" disabled selected>Selecionar</option>
        @foreach ($programas as $programa)
        <option value ="{{$programa}}" @php if(isset($_POST['programa']) && $_POST['programa'] ==  "$programa" ){ @endphp selected="selected" @php } @endphp >{{$programa}} </option>;
        @endforeach
        </select>
        <br>
        <label for="tipo_ped">tipo de pedido</label>
        <br>
        <select name="tipo_ped" class="tipo" id = "tipo_ped">
            <option value="" disabled selected>Selecionar</option>
            <option value="dia_civ" >Diária pessoal civil</option>
            <option value="dia_int">Diária internacional</option>
            <option value="pass" >passagem</option>
            <option value="sepe" >Sepe</option>
            <option value="nao_serv" >Não servidor</option>
            <option value="aux_estu" >Auxílio estudantil</option>
            <option value="aux_pesq" >Auxílio pesquisador</option>
            <option value="cons" >Material de consumo</option>
            <option value="ser_ter" >Serviço de terceiros</option>
            <option value="tran" >Transportes</option>
        </select>
        <br>
        <label for="n_ped">Nº Pedido</label> 
        <br>
        <input type="number" name="n_ped" class = "n_ped" id = "n_ped" min = 1 required>
        <br>
        <label for="data"> Data</label>
        <br>
        <input type="date" name="data" class = "date" id = "data" required>
        <br>
        <label for="valor"> Valor</label>
        <br>
        <input type="number" name="valor" class = "valor" id = "valor"min = 1 step = "0.01" required>
        <br>
        <label for="n-pcdp"> Nº PCDP</label>
        <br>
        <input type="text" name="n_pcdp" class = "n_pcdp" id = "n-pcdp" required>
        <br>
        <label for="det"> Detalhamento</label>
        <br>
        <textarea name="det" id="det" cols="30" rows="5" required></textarea>
        <br>
        <label for="ben"> Beneficiado</label>
        <br>
        <input type="text" name="ben" class = "ben" id = "ben" required>
        <br><br>
        <label for="prest"> Prestação de contas</label>
        <br>
        <input type="text" name="prest" class = "prest-contas" id = "prest">
        <br><br>
        <input type="hidden" name = "tipo_prog" value ="proap">
        <button class="submit" type="submit">Cadastrar</button>
        <button  class = "submit"id = "fecharPopup">Cancelar</button>
        <br><br>
    </form>
</div>
<main>
    <h1>Pedidos Proap </h1>   
    

    <form action="{{route('postProap')}}" method = "post">
        
        <label for="programa">Programa</label>
        @csrf
        <select name="programa" id=""  onchange="this.form.submit()">
        <option value="" disabled selected>Selecionar</option>
        @foreach ($programas as $programa)
        <option value ="{{$programa}}" @php if(isset($_POST['programa']) && $_POST['programa'] ==  "$programa" || old('programa')!== null && old('programa') == "$programa") { @endphp selected="selected" @php } @endphp >{{$programa}} </option>;
        @endforeach
        </select>
    <label for="tipo">tipo</label>
        <select name="tipo_ped" onchange="this.form.submit()">
        <option value="" disabled selected>Selecionar</option>
        <option value="dia_civ" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'dia_civ' || old('tipo_ped')!== null && old('tipo_ped') == 'dia_civ'){  @endphp selected="selected" @php } @endphp>Diária pessoal civil</option>
        <option value="dia_int" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'dia_int' || old('tipo_ped')!== null && old('tipo_ped') == 'dia_int'){ @endphp selected="selected" @php } @endphp>Diária internacional</option>
        <option value="pass" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'pass' || old('tipo_ped')!== null && old('tipo_ped') == 'pass'){ @endphp selected="selected" @php } @endphp>passagem</option>
        <option value="sepe" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'sepe' || old('tipo_ped')!== null && old('tipo_ped') == 'sepe'){ @endphp selected="selected" @php } @endphp>Sepe</option>
        <option value="nao_serv" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'nao_serv' || old('tipo_ped')!== null && old('tipo_ped') == 'nao_serv'){ @endphp selected="selected" @php } @endphp>Não servidor</option>
        <option value="aux_estu" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'aux_estu' || old('tipo_ped')!== null && old('tipo_ped') == 'aux_estu'){ @endphp selected="selected" @php } @endphp>Auxílio estudantil</option>
        <option value="aux_pesq" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'aux_pesq' || old('tipo_ped')!== null && old('tipo_ped') == 'aux_pesq'){ @endphp selected="selected" @php } @endphp>Auxílio pesquisador</option>
        <option value="cons" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'cons' || old('tipo_ped')!== null && old('tipo_ped') == 'cons'){ @endphp selected="selected" @php } @endphp>Material de consumo</option>
        <option value="ser_ter" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'ser_ter' || old('tipo_ped')!== null && old('tipo_ped') == 'ser_ter'){ @endphp selected="selected" @php } @endphp>Serviço de terceiros</option>
        <option value="tran" @php if(isset($_POST['tipo_ped']) && $_POST['tipo_ped'] == 'tran' || old('tipo_ped')!== null && old('tipo_ped') == 'tran'){ @endphp selected="selected" @php } @endphp>Transportes</option>
        </select>
    </form>
<br><br>

        
        <div class = "tabela">
            <div class = "buttons" >  <button class = "submit" id = "abrirPopup" > Cadastrar pedido </button> </div>
            <table>
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
                @if(isset($pedidos))
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{$pedido->num_ped}}</td>
                            <td>{{$pedido->data}}</td>
                            <td>R$ {{$pedido->val/100}}@if(!is_float($pedido->val/100)).00 @endif</td>
                            <td>{{$pedido->det}}</td>
                            <td>{{$pedido->ben}}</td>
                            <td>{{$pedido->pcdp}}</td>
                            <td>{{$pedido->prest}}</td>
                            <td>  <a href ="">  <i class="fa-solid fa-pen-to-square"></i></a></td> 
                            <td>  <a href = ""> <i class="fa-solid fa-trash-can"></i> </a> </td>
                        </tr>
                    @endforeach
                @elseif(session('pedidos'))
                @foreach (session('pedidos') as $pedido)
                        <tr>
                            <td>{{$pedido->num_ped}}</td>
                            <td>{{$pedido->data}}</td>
                            <td>R$ {{$pedido->val/100}}@if(!is_float($pedido->val/100)).00 @endif</td>
                            <td>{{$pedido->det}}</td>
                            <td>{{$pedido->ben}}</td>
                            <td>{{$pedido->pcdp}}</td>
                            <td>{{$pedido->prest}}</td>
                            <td>  <a href ="">  <i class="fa-solid fa-pen-to-square"></i></a></td> 
                            <td>  <a href = ""> <i class="fa-solid fa-trash-can"></i> </a> </td>
                        </tr>
                    @endforeach
                @endif
                
            </table>
        </div>
     
    </main>
</body>
</html>



<script type="text/javascript" >
    const popup = document.getElementById("popup");
    document.getElementById("abrirPopup").addEventListener("click", function(event)
    {
        event.preventDefault();
        popup.classList.add("open-popup") 
    });
    document.getElementById('fecharPopup').addEventListener("click", function()
    {
        popup.classList.remove("open-popup") = "none";
    });
</script>