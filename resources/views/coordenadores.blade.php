<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Coordenadores</title>
    <link href="/css/coordenadores.css" rel="stylesheet"/>
    <link  href="/css/tabelas.css" rel="stylesheet"/>
    <link  href="/css/componentes.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
</head>

<div class="popup" id = "popup">
    
    <form action="{{route('cadastrarCoordenador')}}" method= "post" >
    <br><br>
        
        <label for="proap">Proap</label>
        <input type="radio" value = "proap" name = "tipoPrograma" id = "proap">
        <label for="proapinho">proapinho</label>
        <input type="radio" value = "proapinho" name = "tipoPrograma" id = "proap">
        <br><br>
        <label for="Nome">Nome Completo</label>
        <input type="text" name="nome" required>
        <br><br>
        @csrf
        <label for="Programa">Programa</label>
        <br>
        <input type="text" name = "programa" required>
        <br><br>
        <label for="Username">nome de usuário</label>
        <input type="text" name="username" required>
        <br><br>
        <label for="senha">Senha</label>
        <br>
        <input type="text" name = "password" required>
        <br><br>    
        <button class="button submit" type="submit">Cadastrar</button>
        <button class ="submit" type="reset" id ="fecharPopup" > Cancelar</button>
    </form>
    
    </div>
<body>
    @include('components.navbarAdmin')
<main>

    
    @if (session('sucesso'))
    <x-msg class="sucesso" :msg="session('sucesso')"/>
    @endif

    @if (session('erro'))
    <x-msg class="erro" :msg="session('erro')"/>
    @endif
 
    <h1>Coordenadores</h1> 
   
    
     <div class = "tabela">
        <x-search-box/>
        <div class = "buttons" >  
            <button class = "submit" id = "abrirPopup" > Cadastrar Coordenador </button> 
        </div>
        <table>
            <tr>
                <th>Coordenador </th>
                <th>Nome de usuário</th>
                <th>Programa</th>
                <th>Tipo</th>
                <th>Excluir</th>
            </tr>

             @foreach ($coordenadores as $coordenador)
                <tr class = "{{$coordenador['username']}}"  id = "{{$coordenador['username']}}">
                    <td> {{$coordenador['coordenador']}} </td>
                    <td> {{$coordenador['username']}} </td>
                    <td> {{$coordenador['programa']}} </td>
                    <td> {{$coordenador['tipo']}} </td>
                    <td> <a href="{{ route('excluirCoordenador',['username' => $coordenador['username']])}}"> <i class="fa-solid fa-trash-can"></i> </a> </td>  
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
        const table = @php echo json_encode($coordenadores)@endphp;
        console.log(table);
        table.forEach(row => {
            var id = row.username;
            console.log(id);
            var linha = document.getElementById(id);
            console.log(linha);
            if(row.coordenador.toLowerCase().includes(value) || row.programa.toLowerCase().includes(value) || row.username.toLowerCase().includes(value) || row.tipo.toLowerCase().includes(value) )
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
        popup.classList.add("open-popup"); 
    });
    document.getElementById('fecharPopup').addEventListener("click", function()
    {
        popup.classList.remove("open-popup");
    });

</script>