

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  
  <div class="topnav">
 
<a href="../Grafico/grafico.php">Gráfico</a>

<a href = "{{route('controleProapinho')}}">Proapinho</a>
<a href = "{{route('controleProap')}}">Proap</a>
<a href = "{{route('coordenadores')}}">Coordenadores</a>
<a href = "{{route('programas')}}">Programas</a>

<form action="{{route('logout')}}" id = "logout-form" method="post">
  @csrf
<a  href = "{{route('logout')}}" id="logout" onclick=" event.preventDefault();" >Sair</a> 
</form>
</div>
  

  



<style>
  .topnav {
    background-color: #00204a;
    overflow: hidden;
    border-radius: 5px;
    font-family: Arial, Helvetica, sans-serif;
}

.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav a:hover{ 
    color: #005792;
    transition: 0.3s;
    cursor: pointer;
}

.topnav a.active {
    background-color: #005792;
    color: white
}


</style>
