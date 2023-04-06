<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escola";
$porta = "3307";

$conn = mysqli_connect($servername.":".$porta, $username, $password, $dbname);

// Verificação de erro na conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}


$id = $_GET['id'];

$sql = "DELETE FROM alunos WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Aluno excluído com sucesso!";
    header('Location: index.php');
} else {
    echo "Erro ao excluir aluno: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
