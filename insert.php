<?php
/* Conexão com BD MySQL (usuário 'root', senha 'root' e banco 'uniasselvi') */
$link = mysqli_connect("localhost", "root", "root", "uniasselvi");
// Valida se conexão com banco de dados
if ($link === false) {
  die("ERRO: Não foi possível conectar ao BD. " . mysqli_connect_error());
}
// variáveis criadas para obter valores dos parâmetros do formulário
$nome = mysqli_real_escape_string($link, $_REQUEST['nome']);
$cargo = mysqli_real_escape_string($link, $_REQUEST['cargo']);
$descCargo = mysqli_real_escape_string($link, $_REQUEST['descCargo']);
$setor = mysqli_real_escape_string($link, $_REQUEST['setor']);
$salario = mysqli_real_escape_string($link, $_REQUEST['salario']);
$codigo = 1;
// pegando o próximo código (sem utilização de sequence do banco)
$sql = "SELECT MAX(CODIGO) AS CODIGO FROM FUNCIONARIO";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_array($result)) {
      if (intval($row['CODIGO']) > 0) {
        $codigo = intval($row['CODIGO']) + 1;
      }
    }
  }
}
// Realiza inserção do novo registro na tabela do banco de dados
$sql = "INSERT INTO FUNCIONARIO (CODIGO, NOME, CARGO, DESCRICAOCARGO,
 SETOR, SALARIO) VALUES ('$codigo', '$nome', '$cargo', '$descCargo', '$setor', '$salario')";
if (mysqli_query($link, $sql)) {
  echo "Gravação efetuada com sucesso!"; // aqui poderia ser incluído um código para redirect
} else {
  echo "Erro (Não foi possível inserir o registro na tabela) $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>