<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="/css/componentes.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/tabelas.css">
    <link rel="stylesheet" href="/css/valores.css">
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
</head>
<div class="popup" id = "popup"> 
    <button id = "fecharPopup"><i class="fa-solid fa-xmark"></i></button><br><br>
    <form action="{{route('cadastrarValores')}}" method="post">
    
        <label for="dia_civ">Diária pessoa civil</label>
        <input type="number" name="dia_civ" id = "dia_civ" value = 0 min = 0  required>
        
        <label for="dia-int">Díaria internacional</label>
        <input type="number" name="dia_int" id = "dia_int" value = 0 min = 0  required>
        
        <label for="pass">Passagem</label>
        <input type="number" name="pass" id ="pass" value = 0 min = 0  required>
        
        <label for="sep">Sep</label>
        <input type="number" name="sepe" id = "sepe" value = 0 min = 0  required>
        
        <label for="nao_serv">Não Servidor</label>
        <input type="number" name="nao_serv" id = "nao_serv" value = 0  min = 0  required>
        
        <label for="aux_estu">Auxílio Estudante</label>
        <input type="number" name="aux_estu" id = "aux_estu" value = 0 min = 0  required>
        
        <label for="aux_pesq">Auxílio Pesquisador</label>
        <input type="number" name="aux_pesq" id = "aux_pesq" value = 0 min = 0  required>
        
        <label for="cons">Material de Consumo</label>
        <input type="number" name="cons" id = "cons" value = 0 min = 0  required>
        
        <label for="ser_ter">Serviço de Terceiros</label>
        <input type="number" name="ser_ter" id ="ser_ter" value = 0 min = 0  required>
        
        <label for="tran">Transporte</label>
        <input type="number" name="tran" id ="tran" value = 0 min = 0  required>
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
</div>
<body>
    @include('components.navbarCoord')
    
    <h1>Cadastro {{$programa->nom_prog}}  </h1>
        

    <div class = "tabela"> 
        <table>
            <thead>
                <tr>
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
        </thead>
        <tbody>
            <tr> 
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
                <tr>
        </tbody>
 
        
        </table> 
    </div>  <div class = "button"><button id = "abrirPopup" >Cadastrar valores</button> </div>

</body>

<script type="text/javascript" >

    var popup = document.getElementById("popup");
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
</html>