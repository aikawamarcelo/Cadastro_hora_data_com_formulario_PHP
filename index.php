
<?php 

//Definir um fuso horário padrão 
date_default_timezone_set('America/Sao_Paulo');

//Incluir a conexão com o banco de dados.
include_once "./conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
     <title>Cadastro de Horário</title>
</head>
<body>
    <h2>Cadastrar Horário</h2>

    <?php 
    //Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if(!empty($dados['SendCadHorario'])){
       // var_dump($dados); 

        //Gerar data atual
        $dados['data'] = date('Y-m-d');

       // Verificar se consegue executar corretamente a instrução dentro do try.
        try{
        // Query para cadastrar no banco de dados.
        $query_horario = "INSERT INTO horarios (entrada, saida, data) VALUES (:entrada, :saida, :data)";
        $cad_horario = $conn->prepare($query_horario);
        $cad_horario->bindParam(':entrada', $dados['entrada']);
        $cad_horario->bindParam(':saida', $dados['saida']);
        $cad_horario->bindParam(':data', $dados['data']);
        
       
        // Executar a query
        $cad_horario->execute();

        // Acessa o IF quando cadastrar com sucesso
        if ($cad_horario->rowCount()){
            echo "<span style='color: green;'>Horário cadastrado com sucesso</span><br><br>";
        } else{
            echo "<span style='color: #ff0000;'>Erro: Horário não cadastrado com sucesso</span><br><br>";
        }
          

    }catch(PDOException $erro){
        echo "<span style='color: #ff0000;'>Erro: Horário não cadastrado com sucesso</span><br><br>";
       // echo($erro);
    }

    }

    ?>
    
    <form method="POST" action="">

    <?php 
    $entrada ="";
    if(isset($dados['entrada'])){
        $entrada = $dados['entrada'];
    }
    ?>
         <label>Entrada: </label>
         <input type="time" name="entrada" value="<?php echo $entrada; ?>" required><br><br>
    <?php 
    $saida = "";
    if(isset($dados['saida'])){
        $saida = $dados['saida'];
    }
    
    ?>
         <label>Saída: </label>
         <input type="time" name="saida" value="<?php echo $saida; ?>" required><br><br>

    <?php 
  /*  $data = "";
    if(isset($dados['data'])){
        $data = $dados['data'];
    
    }*/
    ?>
    
      <!--
         <label>Data: </label>
         <input type="date" name="data" value="<?php echo $data; ?>" required><br><br>
      -->
      
      <input type="submit" value="Cadastrar" name="SendCadHorario">
     
    </form>

</body>
</html>