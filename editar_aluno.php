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

    // Verificação de submissão do formulário de edição de aluno
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $idade = $_POST['idade'];

        $sql = "UPDATE alunos SET nome='$nome', idade=$idade WHERE id=$id";

        if(mysqli_query($conn, $sql)) {
            echo "<p>Aluno editado com sucesso!</p>";
            header('Location: index.php');
        } else {
            echo "Erro ao editar aluno: " . mysqli_error($conn);
        }
    }

    // Busca as informações do aluno a partir do ID passado pela URL
    $id = $_GET['id'];
    $sql = "SELECT * FROM alunos WHERE id=$id";
    $resultado = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($resultado);

    mysqli_close($conn);
?>

<h2>Editar Aluno</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $linha['nome']; ?>" required>
    <br>
    <label for="idade">Idade:</label>
    <input type="number" name="idade" value="<?php echo $linha['idade']; ?>" required>
    <br>
    <input type="submit" name="submit" value="Editar">
</form>
