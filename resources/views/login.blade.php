<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGF - PROPPG Sistema de gerenciamento financeiro</title>
    <link rel="icon" type="image/png" href="/Images/logo.png">
    <link href="/css/login.css" rel="stylesheet"/>
    <link href="/css/componentes.css" rel="stylesheet"/>
</head>
<body>
    @include('components.navbar')
   
    @if (session('erro'))
    <x-msg class="erro" :msg="session('erro')"/>
    @endif

    
<main>
    <fieldset>
    
        <form action="{{route('autenticar')}}" method="post">
                <h3 id ="titulo">
                    Login
                </h3>
            <section>
                <div>
                    <label for="username">Nome de usuário</label><br>
                    <input type="text" name="username" id = "username">
                </div>
                <div>
                    <label for="password">Senha</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit">Entrar</button>
                @csrf
            </section>
        </form>

        
        <div id = "img">
            <img src = "/Images/logo.png" style="width: 400px; height: 200px"> 
        </div>
    </fieldset>

</main>
</body>
</html>