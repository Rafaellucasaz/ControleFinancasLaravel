


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  
  <div class="topnav">
 
<a href="../Grafico/grafico.php">Gráfico</a>

<a href = "../ControleProapinho/controle_proapinho.php">Proapinho</a>
<a href = "../ControleProap/controle_proap.php">Proap</a>
<a href = "{{route('coordenadores')}}">Coordenadores</a>
<a href = "{{route('programas')}}">Programas</a>



<a  href = "../Login/action_logout.php" style = "float:right">Logout</a> </div>
  
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
    background-color: #005792;
    color:white
}

.topnav a.active {
    background-color: #005792;
    color: white
}
</style>
