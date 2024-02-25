


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  
<div class="topnav">

  <a href="{{route('grafico')}}">Gráfico</a>
  <a href="{{route('pedidos',session('id_prog'))}}">Pedidos</a>
  <a href = "{{route('indexCadastrarValores',session('id_prog'))}}">Valores</a>
  <a href="{{route('indexConta',['id_log' => session('id_log'), 'id_prog' => session('id_prog')])}}">Conta</a>

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

}

.topnav a.active {
  background-color: #005792;
  color: white
}
</style>
