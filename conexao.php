<?php 

$dsn = "mysql:host=localhost;dbname=cadastro_horarios";
$user="root";
$pass="";

try{

   $conn = new PDO($dsn, $user , $pass);
 // echo "Conexão com o banco de dados realizada com sucesso. ";

} catch (PDOException $err){
    echo "Erro: Conexão com o banco de dados não realizada com sucesso, Erro
          gerado. " . $err->getMessage();
}

//Fim da conexão com o banco de dados  utilizando o PDO

?>