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
<body>
    @include('components.navbarCoord')
    
    <h1>Cadastro {{$programa->nom_prog}}  </h1>
        <div class="popup" id = "popup"> 
            <button id = "fecharPopup"><i class="fa-solid fa-xmark"></i></button><br><br>
            <form action="action_cadastro_programas.php" method="post">
            
                <label for="dia-pess-civ">Diária pessoa civil</label>
                <input type="number" name="dia-pess-civ" id = "dia-pess-civ" value = 0 min = 0  required>
                
                <label for="dia-int">Díaria internacional</label>
                <input type="number" name="dia-int" id = "dia-int" value = 0 min = 0  required>
                
                <label for="pass">Passagem</label>
                <input type="number" name="pass" id ="pass" value = 0 min = 0  required>
                
                <label for="sep">Sep</label>
                <input type="number" name="sep" id = "sep" value = 0 min = 0  required>
                
                <label for="nao-serv">Não Servidor</label>
                <input type="number" name="nao-serv" id = "nao-serv" value = 0  min = 0  required>
                
                <label for="aux-est">Auxílio Estudante</label>
                <input type="number" name="aux-est" id = "aux-est" value = 0 min = 0  required>
                
                <label for="aux-pes">Auxílio Pesquisador</label>
                <input type="number" name="aux-pes" id = "aux-pes" value = 0 min = 0  required>
                
                <label for="mat-con">Material de Consumo</label>
                <input type="number" name="mat-con" id = "mat-con" value = 0 min = 0  required>
                
                <label for="ser-ter">Serviço de Terceiros</label>
                <input type="number" name="ser-ter" id ="ser-ter" value = 0 min = 0  required>
                
                <label for="trans">Transporte</label>
                <input type="number" name="trans" id ="trans" value = 0 min = 0  required>
                <br><br>
                <button class="submit" type="submit">Cadastrar</button>
            </form>
        </div>

    <div class = "tabela"> 
        <table>
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
 
        
        </table> 
    </div>  <div class = "button"><button class = "submit" id = "abrirPopup" >Cadastrar valores</button> </div>

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