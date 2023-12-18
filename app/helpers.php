<?php

use App\Models\Programa;

function mostrarErros($name,$errors){
    if($name === "det"){
        if($errors->has("$name"))
        {
            ?> <script type = "text/javascript">  $("#<?php echo $name?>").addClass("erroInput"); </script>
            <?php
            echo "<p>" . $errors->first("$name") . "</p>";
        }
    }
    else{
        if($errors->has("$name"))
        {
            ?> <script type = "text/javascript">  $("#<?php echo $name?>").addClass("erroInput"); </script>
            <?php
            echo "<p>" . $errors->first("$name") . "</p>";
        }
    }
    
}
function getValoresAntigos($name,$errors){
    if($name === "det"){
        if(!$errors->has("$name")){
            echo old("$name");
        }
    }
    else{
        if(!$errors->has("$name")){
            echo "value = '" . old("$name") . "'";
        }
    }
    
}

function isSelected($name,$value){
    if(old("$name")!== null && old($name) == "$value"){
        echo "selected ='selected'";
    } 
}

function getTipoPed($tipo_ped){
    switch($tipo_ped){
        case 'dia_civ':
            return 'Diária pessoal civil';
        case 'dia_int';
            return 'Diária internacional';
        case 'pass':
            return 'Passagem';
        case 'sepe':
            return 'SEPE';
        case 'nao_serv':
            return 'Não servidor';
        case 'aux_estu':
            return 'Auxílio estudantil';
        case 'aux_pesq':
            return 'Auxílio pesquisador';
        case 'cons':
            return 'Material de consumo';
        case 'ser_ter':
            return 'Serviços de terceiros';
        case 'tran':
            return 'Transportes';
    }
}

function getAno(){
    return date('Y');
}


function calcularTotalValores(Programa $programa){
    return $programa->dia_civ + $programa->dia_int + $programa->pass + $programa->sepe + $programa->nao_serv + $programa->aux_estu + $programa->aux_pesq + $programa->cons + $programa->ser_ter + $programa->tran;
    
}
?>