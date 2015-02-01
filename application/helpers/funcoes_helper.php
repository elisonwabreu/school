<?php

function validaCPF($cpf){
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    $digitoA = 0;
    $digitoB = 0;
    
    for($i = 0, $x = 10; $i <= 8; $i++, $x--){
        $digitoA += $cpf[$i] * $x;        
    }
    for($i = 0, $x = 11; $i <= 9; $i++, $x--){
        
        if(str_repeat($i, 11) == $cpf){
            return TRUE;
        }
        
        $digitoB += $cpf[$i] * $x;        
    }
    
    $somaA = (($digitoA%11) < 2) ? 0 : 11 - ($digitoA%11);
    $somaB = (($digitoB%11) < 2) ? 0 : 11 - ($digitoB%11);
    
    if($somaA != $cpf[9] || $somaB != $cpf[10]){
        return FALSE;
    }
    
    return TRUE;
}

function camposNotNull($tabela){
    $result = mysql_query("SHOW COLUMNS FROM " . $tabela);
    if (!$result) {
        echo 'erro ao executar comando: ' . mysql_error();
        exit;
    }
    //$array = array();
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            if($row['Null'] == 'NO'){
                $array[] = $row;                
            }
        }
    }
    
    return $array;
}

function validaCamposNotNull($dados, $camposNotNull){
    
    foreach ($camposNotNull as $key => $value) {
        foreach ($dados as $chave => $valor) {
            if($value['Field'] == $chave){
                if($valor == ""){
                    
                    $array[] = $chave; 
                }
            }
        }
                
    }
    
    return $array;
}

function formataDataParaBanco($data){
    
    $data = explode('/', $data);
    $nova = $data[2].'-'.$data[1].'-'.$data[0]; 
    return $nova;    
}

function formataDataParaSistema($data){
    $data = explode('-', $data);
    return $data[0].'/'.$data[1].'/'.$data[2];    
}


function formataCpfCepRgFone($campo){
    $novo = preg_replace('/[^0-9]/', '', $campo);
    return $novo;
}