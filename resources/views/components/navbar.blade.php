<div>
<div class="topnav">
  <a href="{{route('home')}}">Home</a>
  <a href="{{route('login')}}">Login</a>
  <a href="../Grafico/grafico.php">Gráfico</a>
  </div>
</div>

<style>
  .topnav {
    background-color: #00204a;
    overflow: hidden;
    border-radius: 5px;
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
    background-color: #005792;
    color:white;
    transition: 0.3s;
}

.topnav a.active {
    background-color: #005792;
    color: white
}
</style>
