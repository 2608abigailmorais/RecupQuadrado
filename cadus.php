<!DOCTYPE html>
<?php
    include_once "processa2.php";
    $processa2 = isset($_GET['processa2']) ? $_GET['processa2'] : "";
    if ($processa2 == 'editar'){
        $idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : "";
    if ($idUsuario > 0)
        $dados = buscarDados($idUsuario);
}
    $title = "Editar Usuário";
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
        <h3 class = "diminui">Insira os dados</h3>
            <form method="post" action="processa2.php">
                
           <hr> <p>ID:</p>
                <input style="font-size:10px;" class="form-control" readonly  type="text" name="idUsuario" id="idUsuario" value="<?php if ($processa2 == "editar") echo $dados['idUsuario']; else echo 0; ?>"><br>

           <hr> <p>Nome:</p>
                <input style="font-size:10px;" class="form-control" name="nome" id="nome" type="text" required="true" value="<?php if ($processa2 == "editar") echo $dados['nome']; ?>"><br>         
            
           <hr> <p>Login:</p>
                <input style="font-size:10px;" class="form-control" name="login" id="login" type="text" required="true" value="<?php if ($processa2 == "editar") echo $dados['login']; ?>"><br>

           <hr> <p>Senha:</p>
            <input style="font-size:10px;" class="form-control" name="senha" id="senha" type="text" required="true" value="<?php if ($processa2 == "editar") echo $dados['senha']; ?>"><br><hr>
            <button name="processa2" value="salvar" id="processa2" type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm">Salvar</button>
            </form>
            </fieldset></div></div></div>
</body>
</html>