<!DOCTYPE html>
<?php
    include_once "processa.php";
    $processa = isset($_GET['processa']) ? $_GET['processa'] : "";
    if ($processa == 'editar'){
        $Qid = isset($_GET['Qid']) ? $_GET['Qid'] : "";
    if ($Qid > 0)
        $dados = buscarDados($Qid);
}
    $title = "Editar Quadrado";

    //var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <title><?php echo $title ?></title>
</head>
<body background="img/fundo.png">
<nav class="navbar navbar-dark bg-dark">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="tabuleiro.php" class="nav-link $h6-font-size text-center text-light">TABULEIROS</a></li>
          <li><a href="index.php" class="nav-link $h6-font-size text-center text-light">QUADRADOS</a></li>
          <li><a href="usuario.php" class="nav-link $h6-font-size text-center text-light">USUÁRIOS</a></li>
          <li><a href="login.php" class="nav-link $h6-font-size text-center text-light">REALIZAR LOGIN</a></li>
        </ul>
</nav>
<br><br>
<div class="cor">
<div class="fundo">
<div class="margem">
    <fieldset>
    <br>

        <h3 class = "diminui">Insira os dados</h3>
            <form method="post" action="processa.php">
            
            <HR>
            <p>ID:</p>
                <input readonly  type="text" name="Qid" id="Qid" style="font-size:10px;" class="form-control" value="<?php if ($processa == "editar") echo $dados['Qid']; else echo 0; ?>"><HR>

            <p>Lado:</p>
                <input name="lado" id="lado" type="text" required="true" style="font-size:10px;" class="form-control" value="<?php if ($processa == "editar") echo $dados['lado']; ?>"><HR>         
            
            <p>Cor:</p>
                <input name="cor" id="cor" type="color" required="true" style="font-size:10px;" class="form-control" value="<?php if ($processa == "editar") echo $dados['cor']; ?>"><HR>
                <select name="idTabuleiro" id="idTabuleiro" style="font-size:10px;" class="form-control">     
               <?php 
                    require_once("utils.php");
                    echo lista_tabuleiro(0);
               ?>
            </select><hr>
            <button name="processa" value="salvar" id="processa" type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm">Salvar</button>
            </form>
</body>
</html>