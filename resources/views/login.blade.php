<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        
            <h2>
            Login
            </h2>
        <div>
            <label for="username">Nome de usuário</label><br>
            <input type="text" name="username" id = "username">
        </div>
        <div>
            <label for="password">Senha</label><br>
            <input type="password" name="password" id="password">
        </div>
        @csrf
        <div>
            <button class="button submit" type="submit">Entrar</button>
        </div>
        
    </form>
</fieldset>
</main>
</body>
</html>