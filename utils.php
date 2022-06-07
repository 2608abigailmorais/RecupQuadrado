<?php

require_once("classe/quadrado.class.php");
require_once("classe/tabuleiro.class.php");

//função para exibir as informações como select.
function exibir_como_select($chave,$dados){
    $str = "option value=0>Selecione</option>";
    foreach($dados as $linha){
        $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
    }
    return $str;
}


//buscar as informações de tabuleiros e exibi como select.
function lista_tabuleiro($id){
    $tabuleiro = new Tabuleiro( 0, 0);
    $lista = $tabuleiro->buscarTabuleiro($id);
    return exibir_como_select(array('TidTabuleiro', 'ladoT'), $lista);

}



?>
