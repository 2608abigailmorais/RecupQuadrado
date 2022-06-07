<?php
    class Tabuleiro{
        //cria as variáveis como privadas.
        private $TidTabuleiro;
        private $ladoT;

        //constrói as variáveis.
        public function __construct($TidTabuleiro, $ladoT){
            $this->setId($TidTabuleiro);
            $this->setLadoT($ladoT);
        }

        //busca e seta os valores das variáveis.
        public function getId(){ return $this->id; }
        public function setId($TidTabuleiro){ $this->id = $TidTabuleiro; }

        public function getLadoT(){ return $this->ladoT; }
        public function setLadoT($ladoT){ $this->ladoT = $ladoT; }
        
        public function area(){
            return $this->ladoT * $this->ladoT;
        }
        public function perimetro(){
            return $this->ladoT * 4;
        }

        public function insere() {

            //chama a conexão para poder inserir no banco de dados.
            require_once("conf/Conexao.php");

            //cria conexão e chama o insert.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO tabuleiro (ladoT) VALUES(:ladoT)');
            //chama as variáveis através do get.
            $stmt->bindValue(':ladoT', $this->getLadoT());

            //executa o comando.
            return $stmt->execute();

        }

        function excluir($TidTabuleiro){
            //cria conexão e chama o delete.
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM tabuleiro WHERE TidTabuleiro = :TidTabuleiro');
            //chama a variável através do get.
            $stmt->bindValue(':TidTabuleiro', $TidTabuleiro);
            
            //executa o comando.
            return $stmt->execute();
        }

        public function editar(){

             //chama a conexão para poder editar no banco de dados.
            require_once("conf/Conexao.php");

            //cria conexão e chama o update.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE tabuleiro
            SET ladoT = :ladoT
            WHERE (TidTabuleiro = :TidTabuleiro);');
            //chama as variáveis através do get.
            $stmt->bindValue(':TidTabuleiro', $this->getId());
            $stmt->bindValue(':ladoT', $this->getLadoT());

            //executa o comando.
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[Tabuleiro]<br>ID:".$this->getId()."<br>".
                    "Lado Tabuleiro:".$this->getLadoT()."<br>".
                    "Área:".$this->area()."<br>".
                    "Perimetro:".$this->perimetro()."<br>";
        }
        
        public function listarTabuleiro($tipo = 0, $procurar = ""){
            //cria conexão e seleciona as informações do Tabuleiro.
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM tabuleiro";
            if($tipo > 0)
                switch($tipo){
                    case(1): $consulta .= " WHERE TidTabuleiro like :procurar"; $procurar = "%".$procurar."%"; break;
                    //se tipo da consulta for por id, mostra as informações de acordo com aquele id.
                    case(2): $consulta .= " WHERE ladoT LIKE :procurar"; $procurar .="%"; break;
                     //se tipo da consulta for por lado, mostra as informações de acordo com aquele lado.
                }
              
            //ordena a consulta de acordo com o Id do Tabuleiro.          
           $consulta .= " ORDER BY TidTabuleiro ";

           //prepara a consulta
           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
               
         //envia a consulta.
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarTabuleiro($TidTabuleiro){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM tabuleiro';
            if($TidTabuleiro > 0){
                $query .= ' WHERE TidTabuleiro = :TidTabuleiro';
                $stmt->bindParam(':TidTabuleiro', $TidTabuleiro);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        function desenha(){
            $str = "<div style='height: ".$this->getLadoT()."vw; width: ".$this->getLadoT()."vw; background-color: #000000;'></div>";
            return $str;
        }
    }

?>