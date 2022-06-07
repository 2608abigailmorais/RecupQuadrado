
<!DOCTYPE html>
<?php
    $TidTabuleiro = isset($_GET['TidTabuleiro']) ? $_GET['TidTabuleiro'] : 0;
    $ladoT = isset($_GET['ladoT']) ? $_GET['ladoT'] : 0;
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Show do Tabuleiro></title>   
</head>
<body background="img/fundo.png">
<center>
    <div class="cor1">
    <div class="margem1">
    <div class="fundo1">
        <fieldset>
        <div class="margem1">
            <?php  
                if ($acao = "salvar") {
                    //inclui a classe do tabuleiro para chamar a função.
                    include_once "classe/tabuleiro.class.php";
                    //apresenta informações do tabuleiro.
                    $tab = new Tabuleiro($TidTabuleiro, $ladoT);
                    echo $tab; //.
                    //desenha o tabuleiro.
                    echo $desenho = $tab->desenha();
                }
            ?>
            
        </div></div><br>
        <button type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm">
    <a href="tabuleiro.php" style="text-decoration: none;">Voltar</a>
    </button><br>
            </div>  
            
    </fieldset>
            </div>
            </div>
            </div>
   
</body>
</html>



