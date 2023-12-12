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
    <body>
@include('components.navbarAdmin')


        @if (session('sucesso'))
        <x-msg class="sucesso" :msg="session('sucesso')"/>
        @endif

        @if (session('erro'))
        <x-msg class="erro" :msg="session('erro')"/>
        @endif


        <main>
            <h1>Programas</h1>
            
    
            <div class = "tabela">
                <x-search-box/>
                <div class = "buttons">
                    <button class = "submit" id = "abrirPopup" > Cadastrar novo programa</button>
                    <form action="{{route('edicao')}}" method ="post">
                        <button name = "edicao" class = "submit" type = "submit" value ="true">liberar para edição</button>
                        <button name = "edicao" class = "submit" type = "submit" value = "false"> trancar edição</button>
                        @csrf
                    </form>
                </div>
            
                <table>
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
                        <td> <a href="{{ route('excluirPrograma',['id_prog' => $programa->id_prog])}}" onclick="return confirm('Isso deletará todos os pedidos e o coordenador referente a esse programa. Continuar ?')"> <i class="fa-solid fa-trash-can"></i> </a> </td>      
                    </tr>
                @endforeach
                </table> 
            </div>   
        </main>
    </body>
</html>

<script type = "text/javascript">
    const search = document.getElementById("search");
    search.addEventListener("input", function (e)
    {
        
        const value = e.target.value.toLowerCase();
        const table =  @php echo json_encode($programas)@endphp; 
        table.forEach(row => {
            var id = row.id_prog;
            var linha = document.getElementById(id);
            console.log(linha);
            if(row.nom_prog.toLowerCase().includes(value) || row.tipo_prog.toLowerCase().includes(value) )
            {
                linha.classList.remove("hide");
            }
            else
            {
                linha.classList.add("hide");
            }
        });
        
    });
    const popup = document.getElementById("popup");
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