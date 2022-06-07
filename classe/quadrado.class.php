<?php
    class Quadrado{
        //cria as variáveis como privadas.
        private $Qid;
        private $lado;
        private $cor;
        private $idTabuleiro;

        //constrói as variáveis.
        public function __construct($Qid, $lado, $cor, $idTabuleiro){
            $this->setId($Qid);
            $this->setlado($lado);
            $this->setcor($cor);
            $this->setidTabuleiro($idTabuleiro);
        }

        //busca e seta os valores das variáveis.
        public function getId(){ return $this->id; }
        public function setId($Qid){ $this->id = $Qid; }

        public function getlado(){ return $this->lado; }
        public function setlado($lado){ $this->lado = $lado; }

        public function getcor(){ return $this->cor; }
        public function setcor($cor){ $this->cor = $cor; }

        public function getidTabuleiro(){ return $this->idTabuleiro; }
        public function setidTabuleiro($idTabuleiro){ $this->idTabuleiro = $idTabuleiro; }
        

        public function insere() {

            //chama a conexão para poder inserir no banco de dados.
            require_once("conf/Conexao.php");

            //cria conexão e chama o insert.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO quadrado (lado, cor, idTabuleiro) VALUES(:lado, :cor, :idTabuleiro)');
            //chama as variáveis através do get.
            $stmt->bindValue(':lado', $this->getlado());
            $stmt->bindValue(':cor', $this->getcor());
            $stmt->bindValue(':idTabuleiro', $this->getidTabuleiro());

            //executa o comando.
            return $stmt->execute();

        }

        function excluir(){
            //cria conexão e chama o delete.
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM quadrado WHERE Qid = :Qid');
            //chama a variável através do get.
            $stmt->bindValue(':Qid', $this->getId());
            
            //executa o comando.
            return $stmt->execute();
        }

        public function editar(){

            //chama a conexão para poder editar no banco de dados.
            require_once("conf/Conexao.php");

            //cria conexão e chama o update.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE quadrado
            SET lado = :lado, cor = :cor, idTabuleiro = :idTabuleiro
            WHERE (Qid = :Qid);');
            //chama as variáveis através do get.
            $stmt->bindValue(':Qid', $this->getId());
            $stmt->bindValue(':lado', $this->getlado());
            $stmt->bindValue(':cor', $this->getcor());
            $stmt->bindValue(':idTabuleiro', $this->getidTabuleiro());

            //executa o comando.
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[quadrado]<br>ID:".$this->getId()."<br>".
                    "lado:".$this->getlado()."<br>".
                    "cor:".$this->getcor()."<br>".
                    "idTabuleiro:".$this->getidTabuleiro()."<br>";
        }
        
        public function listarQuadrado($tipo = 0, $procurar = ""){
            //cria conexão e seleciona as informações do usário.
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM quadrado";
            if($tipo > 0)
                switch($tipo){
                    //se tipo da consulta for por id, mostra as informações de acordo com aquele id.
                    case(1): $consulta .= " WHERE Qid = :procurar"; break;
                    //se tipo da consulta for por lado, mostra as informações de acordo com aquele lado.
                    case(2): $consulta .= " WHERE lado LIKE :procurar"; "%".$procurar .="%"; break;
                    //se tipo da consulta for por cor, mostra as informações de acordo com aquele cor.
                    case(3): $consulta .= " WHERE cor LIKE :procurar "; $procurar = "%".$procurar."%"; break;
                    //se tipo da consulta for por idTabuleiro, mostra as informações de acordo com aquele idTabuleiro.
                    case(4): $consulta .= " WHERE idTabuleiro = :procurar "; break;
                }
               
           //ordena a consulta de acordo com o Id do Usuário.     
           $consulta .= " ORDER BY Qid ";

           //prepara a consulta;
           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
            
            //envia a consulta.
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarquadrado($Qid){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM quadrado';
            if($Qid > 0){
                $query .= ' WHERE Qid = :Qid';
                $stmt->bindParam(':Qid', $Qid);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }
    
            function desenha(){
                $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; background: ".$this->getCor()."'></div>";
            
                return $str;
            }
                

        }
    

?>