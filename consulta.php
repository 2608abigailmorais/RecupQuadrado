
<!DOCTYPE html>
<?php
    $Qid = isset($_GET['Qid']) ? $_GET['Qid'] : 0;
    $lado = isset($_GET['lado']) ? $_GET['lado'] : 0;
    $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
    $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Show do Quadrado</title>
    

    
</head>
<body background="img/fundo.png">
<center>
<div class="cor1">
<div class="fundo1">
<div class="margem1">
  
  
   
        <?php  
            if ($acao = "salvar") {
                //inclui a classe do quadrado para chamar a função.
                include_once "classe/quadrado.class.php";
                //apresenta informações do quadrado.
                $quad = new Quadrado($Qid, $lado, $cor,$idTabuleiro); 
                echo $quad; //.
                //através de uma função desenha o quadrado.
                echo $desenho = $quad->desenha();
            }
            ?>
            <br>
            <button type="submit" style="font-size:10px;" class="btn btn-outline-info btn-sm"><a  href="index.php" style="text-decoration: none;">Voltar</a></button><br>
            <div></div>

        </div></div></div></center>
</body>
</html>



