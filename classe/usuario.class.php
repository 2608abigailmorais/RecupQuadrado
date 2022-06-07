<?php
    require_once("conf/Conexao.php");
    
    class Usuario{
        private $idUsuario;
        private $nome;
        private $login;
        private $senha;

        public function __construct($idUsuario, $nome, $login, $senha){
            $this->setId($idUsuario);
            $this->setnome($nome);
            $this->setlogin($login);
            $this->setsenha($senha);
        }

        public function getId(){ return $this->id; }
        public function setId($idUsuario){ $this->id = $idUsuario; }

        public function getnome(){ return $this->nome; }
        public function setnome($nome){ $this->nome = $nome; }

        public function getlogin(){ return $this->login; }
        public function setlogin($login){ $this->login = $login; }

        public function getsenha(){ return $this->senha; }
        public function setsenha($senha){ $this->senha = $senha; }
        
        public function insere() {

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO usuario (nome, login, senha) VALUES(:nome, :login, :senha)');
            $stmt->bindValue(':nome', $this->getnome());
            $stmt->bindValue(':login', $this->getlogin());
            $stmt->bindValue(':senha', $this->getsenha());

            return $stmt->execute();

        }

        function excluir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM usuario WHERE idUsuario = :idUsuario');
            $stmt->bindValue(':idUsuario', $this->getId());
            
            return $stmt->execute();
        }

        public function editar(){

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE usuario
            SET nome = :nome, login = :login, senha = :senha
            WHERE (idUsuario = :idUsuario);');
            $stmt->bindValue(':idUsuario', $this->getId());
            $stmt->bindValue(':nome', $this->getnome());
            $stmt->bindValue(':login', $this->getlogin());
            $stmt->bindValue(':senha', $this->getsenha());
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[usuario]<br>ID:".$this->getId()."<br>".
                    "nome:".$this->getnome()."<br>".
                    "login:".$this->getlogin()."<br>".
                    "Tabuleiro:".$this->getsenha()."<br>";
        }
        
        public function listarUsuario($tipo = 0, $procurar = ""){
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM usuario";
            if($tipo > 0)
                switch($tipo){
                    case(1): $consulta .= " WHERE idUsuario = :procurar"; break;
                    case(2): $consulta .= " WHERE nome LIKE :procurar"; $procurar .="%"; break;
                    case(3): $consulta .= " WHERE login LIKE :procurar "; $procurar = "%".$procurar; break;
                    case(4): $consulta .= " WHERE senha = :procurar "; break;
                }
               
           $consulta .= " ORDER BY idUsuario ";

           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
         
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarUsuario($idUsuario){

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM usuario';
            if($idUsuario > 0){
                $query .= ' WHERE idUsuario = :idUsuario';
                $stmt->bindParam(':idUsuario', $idUsuario);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function efetuarLogin($login, $senha){
            $pdo = Conexao::getInstance();
            $sql = "SELECT nome FROM usuario WHERE login = '$login' AND senha = '$senha';";
            $resultado = $pdo->query($sql)->fetchAll();
            if($resultado){
                $_SESSION['nome'] = $resultado[0]['nome'];
                return true;
            } else {
                $_SESSION['nome'] = null;
                return false;
            }
        
        }

        }
    

?>