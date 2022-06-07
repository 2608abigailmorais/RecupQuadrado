<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classe/quadrado.class.php");

    $Qid = isset($_POST['Qid']) ? $_POST['Qid'] : 0;   
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $lado = isset($_POST['lado']) ? $_POST['lado'] : 1;
    $idTabuleiro = isset($_POST['idTabuleiro']) ? $_POST['idTabuleiro'] : 1;

    //chama o processa.
    $processa = isset($_GET['processa']) ? $_GET['processa'] : "";
    //verifica se ação do processa é igual a excluir.
    if ($processa == "excluir"){
        $Qid = isset($_GET['Qid']) ? $_GET['Qid'] : 0;
        //verifica as informações dentro do processa.
        $quadrado = new Quadrado($Qid, 0, "", 0);
        //exclui a linha selecionada.
        $resultado = $quadrado->excluir($Qid);
        header("location:index.php");
    }

    //chama o processa.
    $processa = isset($_POST['processa']) ? $_POST['processa'] : "";
    //verifica se ação do processa é igual à salvar.
    if ($processa == "salvar"){
        $Qid = isset($_POST['Qid']) ? $_POST['Qid'] : "";
        //verifica se o ID é igual a 0, se for cria/insere novo usuário, se não edita as informações no banco.
        if ($Qid == 0){
            $quadrado = new Quadrado("", $_POST['lado'], $_POST['cor'], $_POST['idTabuleiro']);                  
            $resultado = $quadrado->insere();
            header("location:index.php");
        }else {    
        $quadrado = new Quadrado($_POST['Qid'], $_POST['lado'], $_POST['cor'], $_POST['idTabuleiro']);
        $resultado = $quadrado->editar();
        }
        header("location:index.php");   
}

//Consulta os dados dentro do banco.
    function buscarDados($Qid){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM quadrado WHERE Qid = $Qid");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['Qid'] = $linha['Qid'];
            $dados['lado'] = $linha['lado'];
            $dados['cor'] = $linha['cor'];
            $dados['idTabuleiro'] = $linha['idTabuleiro'];

        }
        return $dados;
    }



?>