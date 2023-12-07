<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/programas.css" rel="stylesheet"/>
    <link  href="/css/tabelas.css" rel="stylesheet"/>
    <title>Document</title>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.navbar')
    
    @if (session('sucesso'))
    <x-msg class="sucesso" :msg="session('sucesso')"/>
    @endif

    


    <div class = "popup" id = "popup">

        <div class="closebtn">
        <button id = "fecharPopup" style="float: right;"><i class="fa-solid fa-xmark"></i></button>
        <br><br>
        </div>
        <form action="{{route('cadastrarNovoPrograma')}}" method="post">
            <label for="Sigla"> Sigla</label>
            <input type="text" name = programa >
            @csrf
            <select name="tipoPrograma" id="">
                <option value="proap"> Proap</option>
                <option value="proapinho"> Proapinho</option>
            </select>
            <div class="cadastro"><button class="submit" type="submit">Cadastrar</button></div>
        </form>
    </div>

    
    <h1>Programas</h1>  <main>

    <input type="search" id = "search" class = "search" placeholder="Procurar">
    <br>
    <br>
    <form action="edicao.php" method = "post">
    <button name = "edicao" class = "submit" type = "submit" value ="true">liberar para edição</button>
    <button name = "edicao" class = "submit" type = "submit" value = "false"> trancar edição</button>
    </form>
    
    <div class = "tabela"> <table>
        <tr>
            <th>Programa </th>
            <th> Tipo </th>
            <th>Diária civil</th>
            <th>Diária internacional</th>
            <th>Passagens</th>
            <th>SEPE</th>
            <th>Não Servidor</th>
            <th>Aux. estudantil</th>
            <th>Aux. pesquisador</th>
            <th>Consumo</th>
            <th>Serv. terceiros</th>
            <th>Transporte</th>
            <th>Total</th>
        </tr>
        <br>
        <br>
        @foreach($programas as $programa )
        
            <tr> 
                <td> {{$programa->nom_prog}} </td>
                <td> {{$programa->tipo_prog}} </td>
                <td> {{$programa->dia_civ}} </td>
                <td> {{$programa->dia_int}} </td>
                <td> {{$programa->pas}} </td>
                <td> {{$programa->sep}} </td>
                <td> {{$programa->nao_serv}} </td>
                <td> {{$programa->aux_est}} </td>
                <td> {{$programa->aux_pes}} </td>
                <td> {{$programa->cons}} </td>
                <td> {{$programa->ser_ter}} </td>
                <td> {{$programa->tra}} </td>
                <td> {{$programa->total}} </td>       
            </tr>

        @endforeach
        </table> </div>  <div class = "button">  <button class = "submit" id = "abrirPopup" > Cadastrar novo programa</button>  </div> </main>'
    
</body>
</html>

<script type="text/javascript" >
    // const search = document.getElementById("search");
    // search.addEventListener("input", function (e)
    // {
    //     const value = e.target.value.toLowerCase();
    //     const table = echo json_encode($result) ;
    //     console.log(table);
    //     table.forEach(row => {
    //         var id = row.id_prog;
    //         console.log(id);
    //         var linha = document.getElementById(id);
    //         console.log(linha);
    //         if(row.nom_prog.toLowerCase().includes(value) || row.tipo_prog.toLowerCase().includes(value) )
    //         {
    //             linha.classList.remove("hide");
    //         }
    //         else
    //         {
    //             linha.classList.add("hide");
    //         }
    //     });
        
    // });
    var popup = document.getElementById("popup");
    document.getElementById("abrirPopup").addEventListener("click", function(event)
    {
        event.preventDefault();
        popup.classList.add("open-popup") 
    });
    document.getElementById('fecharPopup').addEventListener("click", function()
    {
        popup.classList.remove("open-popup") ;
    });
    
</script>