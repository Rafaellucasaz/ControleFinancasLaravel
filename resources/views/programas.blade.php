<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../styles/style_programas_admin.css" rel="stylesheet"/>
    <link  href="../../styles/style_tabelas.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../styles/style_navbar.css">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/3c06a12d01.js" crossorigin="anonymous"></script>
</head>
<body>

    

    <div class = "popup" id = "popup">

        <div class="closebtn">
        <button id = "fecharPopup" style="float: right;"><i class="fa-solid fa-xmark"></i></button>
        <br><br>
        </div>
        <form action="cadastro_sigla.php" method = "post">
            <label for="Sigla"> Sigla</label>
            <input type="text" name = programa >
            <select name="tipoPrograma" id="">
                <option value="proap"> Proap</option>
                <option value="proapinho"> Proapinho</option>
            </select>
            <div class="cadastro"><button class="submit" type="submit">Cadastrar</button></div>
        </form>
    </div>

    
    <?php  require_once("../../config.php"); include("../Navbars/navbar.php"); if(isset($_GET['key'])){
        $key = $_GET['key'];
        if(isset($_SESSION["msg_$key"]))
        {
            $msg = $_SESSION["msg_$key"];?>
            <div class = "msg"> <p> <?php echo $msg ?></p> </div>
            <?php unset($_SESSION["msg_$key"]);
        }
    };
     ?>
    <h1>Programas</h1>  <main>

    <input type="search" id = "search" class = "search" placeholder="Procurar">
    <br>
    <br>
    <form action="edicao.php" method = "post">
    <button name = "edicao" class = "submit" type = "submit" value ="true">liberar para edição</button>
    <button name = "edicao" class = "submit" type = "submit" value = "false"> trancar edição</button>
    </form>
    <br>
    <br>
    <?php
        $ano = date("Y");
        $result = Programa::listar($ano);
       
        echo ' <div class = "tabela"> <table>
                    <tr>
                        <th>Programa </th>
                        <th> Tipo </th>
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
                        <th></th>
                    </tr>';
        foreach($result as $row )
        {   $nomProg = $row['nom_prog'];
            $tipoProg = $row['tipo_prog'];
            
            ?>
            <tr class ="<?php echo $row['id_prog'] ?>" id = "<?php echo $row['id_prog']?>" > 
                <td> <?php echo $row['nom_prog']?> </td>
                <td> <?php echo $row['tipo_prog']?> </td>
                <td> <?php echo $row['dia_civ']?> </td>
                <td> <?php echo $row['dia_int']?> </td>
                <td> <?php echo $row['pas']?> </td>
                <td> <?php echo $row['sep']?> </td>
                <td> <?php echo $row['nao_serv']?> </td>
                <td> <?php echo $row['aux_est']?> </td>
                <td> <?php echo $row['aux_pes']?> </td>
                <td> <?php echo $row['cons']?> </td>
                <td> <?php echo $row['ser_ter']?> </td>
                <td> <?php echo $row['tra']?> </td>
                <td> <?php echo $row['total']?> </td>
                <td>  <a href="excluirPrograma.php?nomProg=<?php echo $nomProg?>&tipoProg=<?php echo $tipoProg?>"> <i class="fa-solid fa-trash-can"></i> </a>  </td>
            </tr>
            
        <?php
        }
    
        echo  '  </table> </div>  <div class = "button">  <button class = "submit" id = "abrirPopup" > Cadastrar novo programa</button>  </div> </main>';  
    ?>
</body>
</html>

<script type="text/javascript" >
    const search = document.getElementById("search");
    search.addEventListener("input", function (e)
    {
        const value = e.target.value.toLowerCase();
        const table = <?php echo json_encode($result) ?>;
        console.log(table);
        table.forEach(row => {
            var id = row.id_prog;
            console.log(id);
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
    var popup = document.getElementById("popup");
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