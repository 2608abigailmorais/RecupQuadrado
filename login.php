<!DOCTYPE html>
<?php
    session_start();

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "classe/usuario.class.php";
 
    $login = isset($_POST["login"]) ? $_POST["login"] : "";     
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : ""; 
    $title = "Login - Usuários";

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
        <h3 class = "diminui">Insira os Dados</h3>
            <form method="post" action="login.php?acao=login">
                <hr> <p>Login:</p>
                    <input style="font-size:10px;" class="form-control" name="login" id="login" type="text" required="true"><br>
                <hr> <p>Senha:</p>
                    <input style="font-size:10px;" class="form-control" name="senha" id="senha" type="text" required="true"><br><hr>
                <button value="logar" type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm">Logar</button>
            </form>

        <?php
            error_reporting(0);
            if($_GET['acao'] == 'login'){
                $user = new Usuario("","","","");
                if ($user->efetuarLogin($login, $senha) == true){
                    echo "Logado com sucesso";
                }else if($_SESSION['nome'] == null){
                    echo "Erro, verifique os dados e tente novamente.";
                }
            }
        ?>
        <br>
        <br>
            
        <button type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm"><a  href="index.php" style="text-decoration: none;">Voltar</a></button><br>
            </fieldset></div></div></div>

    
</body>
</html>