<!DOCTYPE html>
<?php 
    require_once "classe/tabuleiro.class.php";
    require_once  "conf/Conexao.php";
    require_once  "processa1.php";
    $title = "Listagem de Tabuleiros";
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

    <form method="post" action="processa1.php">
        <h3 class = "diminui">Criar Tabuleiro:</h3><br>
        <input type="hidden" name="TidTabuleiro" id="TidTabuleiro" size="25" value="0">
        <input type="text" name="ladoT" id="ladoT" size="25" value="" style="font-size:10px;" class="form-control" placeholder="Insira o valor dos lados"><br><br>
        <button name="processa1" id="processa1" value="salvar" type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm">Salvar</button>
    <br><br>    
    </form>
</fieldset><br>
<fieldset>
    <form method ="get">

    <h3 class = "diminui">Procurar Tabuleiro</h3>
        <input type="text" name="procurar" id="procurar" size="50" style="font-size:10px;" class="form-control" value="<?php echo $procurar;?>"> <br>
        <p> Pesquisar por:</p>
                <input type="radio" name="tipo" value="0" class="form-check-input" <?php if ($tipo == "0") echo "checked" ?>>Todos<br>
                <input type="radio" name="tipo" value="1" class="form-check-input" <?php if ($tipo == "1") echo "checked" ?>>ID<br>
                <input type="radio" name="tipo" value="2" class="form-check-input" <?php if ($tipo == "2") echo "checked" ?>>Lado<br>
                <button name="buscar " id="buscar" value="buscar" type="submit"  style="font-size:10px;" class="btn btn-outline-info btn-sm">Procurar</button>
<br><br>
    </form></fieldset>
<br>
    <table class="table table-striped table-hover table-sm table-light" style="border-radius: 30px;">
            <tr>
                <td><b>ID</b></td>
                <td><b>Lado</b></td>
                <td><b>Editar</b></td>
                <td><b>Show</b></td>
                <td><b>Excluir</b></td>
            </tr>

<?php  
    $tab = new Tabuleiro(0, 0);
    $lista = $tab->listarTabuleiro($tipo, $procurar);
        foreach ($lista as $linha) {
    ?>
        <tr>
            <th scope="row"><?php echo $linha['TidTabuleiro'];?></th>
            <th scope="row"><?php echo $linha['ladoT'];?></th>
            <td><a href='cadtab.php?processa1=editar&TidTabuleiro=<?php echo $linha['TidTabuleiro'];?>'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a></td>
            <td scope="row"><a href="consulta1.php?TidTabuleiro=<?php echo $linha['TidTabuleiro']; ?>&ladoT=<?php echo $linha['ladoT'];?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="black" class="bi bi-eye-fill" viewBox="0 0 16 16">
    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg></a></td>
            <td><?php echo " <a href='processa1.php?processa1=excluir&TidTabuleiro={$linha['TidTabuleiro']}')>";?><?php echo " <a href='processa1.php?processa1=excluir&TidTabuleiro={$linha['TidTabuleiro']}')>";?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="black" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
    </svg></a></td>
    </td>
        </tr>
            <?php } ?> 
    </body>
    </html>