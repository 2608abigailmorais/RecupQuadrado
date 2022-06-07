<!DOCTYPE html>
<?php 
    require_once "classe/usuario.class.php";
    require_once  "conf/Conexao.php";
    require_once  "processa2.php";
    $title = "Listagem de Usuários";
    $procurar = isset($_GET["procurar"]) ? $_GET["procurar"] : ""; 
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">

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

    <form method="post" action="processa2.php">
        <h3 class = "diminui">Cadastrar Usuário:</h3>
        <input type="hidden" name="idUsuario" id="idUsuario" size="25" value="0">
        <input type="text" name="nome" id="nome" size="25" value="" style="font-size:10px;" class="form-control" placeholder="Digite o nome"><br>
        <input type="text" name="login" id="login" size="25" value="" style="font-size:10px;" class="form-control" placeholder="Digite o login"><br>
       <input type="password" name="senha" id="senha" size="25" value="" style="font-size:10px;" class="form-control" placeholder="Digite a senha"><br>
        <button name="processa2" id="processa2" value="salvar" type="submit"  style="font-size:10px;" class="btn btn-outline-info btn-sm">Salvar</button>
    <br><br>    
    </form>
</fieldset>
<br>
<fieldset>
    <form method ="get">

    <h3 class = "diminui">Procurar Usuario</h3>
        <input type="text" name="procurar" id="procurar" size="50" style="font-size:10px;" class="form-control"  value="<?php echo $procurar;?>"> <br>
        <p> Pesquisar por:</p>
                <input type="radio" name="tipo" value="0" class="form-check-input" <?php if ($tipo == "0") echo "checked" ?>>Todos<br>
                <input type="radio" name="tipo" value="1" class="form-check-input" <?php if ($tipo == "1") echo "checked" ?>>ID<br>
                <input type="radio" name="tipo" value="2" class="form-check-input" <?php if ($tipo == "2") echo "checked" ?>>Nome<br>
                <input type="radio" name="tipo" value="3" class="form-check-input" <?php if ($tipo == "3") echo "checked" ?>>Login<br>
                <button name="buscar " id="buscar" value="buscar" type="submit"  style="font-size:10px;" class="btn btn-outline-info btn-sm ">Procurar</button>
<br><br>
    </form>
</fieldset>
<br>
    <table class="table table-striped table-hover table-sm table-light" style="border-radius: 30px;">
            <tr>
                <td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>Login</b></td>
                <td><b>Senha</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr>

<?php  
    $usu = new Usuario(0, "", "", "");
    $lista = $usu->listarUsuario($tipo, $procurar);
        foreach ($lista as $linha) {
    ?>
        <tr>
            <th scope="row"><?php echo $linha['idUsuario'];?></th>
            <th scope="row"><?php echo $linha['nome'];?></th>
            <th scope="row"><?php echo $linha['login'];?></th>
            <th scope="row"><?php echo $linha['senha'];?></th>
            <td><a href='cadus.php?processa2=editar&idUsuario=<?php echo $linha['idUsuario'];?>'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a></td>

</svg></a></td>
            <td><?php echo " <a href='processa2.php?processa2=excluir&idUsuario={$linha['idUsuario']}')>";?><?php echo " <a href='processa2.php?processa2=excluir&idUsuario={$linha['idUsuario']}')>";?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="black" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
    </svg></a></td>
    </td>
        </tr>
            <?php } ?> 
        </div>
        </div>
        </div>
    </body>
    </html>