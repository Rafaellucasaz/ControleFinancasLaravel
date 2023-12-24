<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/Images/logo.png">
    <title>SGF - PROPPG Sistema de gerenciamento financeiro</title>
    <link  href="/css/tabelas.css" rel="stylesheet"/>
    <link  href="/css/componentes.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
    <script type ="text/javascript" src="{{asset('js/logout.js')}}"></script>
    <script type = "text/javascript" src="{{asset('js/popup.js')}}"></script>
    @yield('head')
    
</head>
@yield('popup')
<body>
    @yield('navbar')
    @if (session('sucesso'))
        <x-msg class="sucesso" :msg="session('sucesso')"/>
    @endif

    @if (session('erro'))
        <x-msg class="erro" :msg="session('erro')"/>
    @endif
    <div style = 'display:flex; flex-direction:column;  align-items: center;'>
        <h1>@yield('h1')</h1>
    </div>
    <main>
    @yield('main')
    </main>
</body>
</html>

<script type = "text/javascript">

@yield('scripts')

</script>