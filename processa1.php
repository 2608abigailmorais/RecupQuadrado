<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classe/tabuleiro.class.php");

    $TidTabuleiro = isset($_POST['TidTabuleiro']) ? $_POST['TidTabuleiro'] : 0;   
    $ladoT = isset($_POST['ladoT']) ? $_POST['ladoT'] : 1;


    //chama o processa.
    $processa1 = isset($_GET['processa1']) ? $_GET['processa1'] : "";
    //verifica se ação do processa é igual a excluir.
    if ($processa1 == "excluir"){
        $TidTabuleiro = isset($_GET['TidTabuleiro']) ? $_GET['TidTabuleiro'] : 0;
        //verifica as informações dentro do processa.
        $tabuleiro = new Tabuleiro($TidTabuleiro, 0, 0);
        //exclui a linha selecionada.
        $resultado = $tabuleiro->excluir($TidTabuleiro);
        header("location:tabuleiro.php");
    }
   
    //chama o processa.
    $processa1 = isset($_POST['processa1']) ? $_POST['processa1'] : "";
    //verifica se ação do processa é igual à salvar.
    if ($processa1 == "salvar"){
        $TidTabuleiro = isset($_POST['TidTabuleiro']) ? $_POST['TidTabuleiro'] : "";
         //verifica se o ID é igual a 0, se for cria/insere novo usuário, se não edita as informações no banco.
        if ($TidTabuleiro == 0){
            $tabuleiro = new Tabuleiro("", $_POST['ladoT']);                  
            $resultado = $tabuleiro->insere();
            header("location:tabuleiro.php");
        }else {    
        $tabuleiro = new Tabuleiro($_POST['TidTabuleiro'], $_POST['ladoT']);
        $resultado = $tabuleiro->editar();
        }
        header("location:tabuleiro.php");   
}

//Consulta os dados dentro do banco.
    function buscarDados($TidTabuleiro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM tabuleiro WHERE TidTabuleiro = $TidTabuleiro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['TidTabuleiro'] = $linha['TidTabuleiro'];
            $dados['ladoT'] = $linha['ladoT'];

        }
        return $dados;
    }



?>