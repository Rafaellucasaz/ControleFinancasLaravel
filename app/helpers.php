<?php 

function mostrarErros($name,$errors){
    if($name === "det"){
        if($errors->has("$name"))
        {
            echo $errors->first("$name");
        }
        else{
            echo old("$name");
        }
    }
    else{
        if($errors->has("$name"))
        {
            echo "placeholder ='" . $errors->first("$name") . "'";
        }
        else{
             echo "value = '" . old("$name") . "'";
        }
    }
    
}

function isSelected($name,$value){
    if(isset($_POST["$name"]) && $_POST["$name"] ==  "$value" || old("$name")!== null && old($name) == "$value"){
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

?>