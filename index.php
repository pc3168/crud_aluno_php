<!DOCTYPE html>
<html>
<head>
	<title>CRUD de Alunos</title>
</head>
<body>
	<h1>CRUD de Alunos</h1>

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

		// Verificação de submissão do formulário de adição de aluno
		if(isset($_POST['submit'])) {
			$nome = $_POST['nome'];
			$idade = $_POST['idade'];

			$sql = "INSERT INTO alunos (nome, idade) VALUES ('$nome', $idade)";

			if(mysqli_query($conn, $sql)) {
				echo "<p>Aluno adicionado com sucesso!</p>";
			} else {
				echo "Erro ao adicionar aluno: " . mysqli_error($conn);
			}
		}

		// Listagem de todos os alunos cadastrados
		$sql = "SELECT * FROM alunos";
		$resultado = mysqli_query($conn, $sql);

		if(mysqli_num_rows($resultado) > 0) {
			echo "<h2>Alunos cadastrados:</h2>";
			echo "<table border='1'>";
			echo 
			"<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Idade</th>
				<th>Excluir</th>
				<th>Editar</th>
			</tr>";

			while($linha = mysqli_fetch_assoc($resultado)) {
				echo "<tr>";
				echo "<td>" . $linha['id'] . "</td>";
				echo "<td>" . $linha['nome'] . "</td>";
				echo "<td>" . $linha['idade'] . "</td>";
				echo "<td><a href='excluir_aluno.php?id=" . $linha['id'] . "'>Excluir</a></td>";
				echo "<td><a href='editar_aluno.php?id=" . $linha['id'] . "'>Editar</a></td>";
				echo "</tr>";
			}

			echo "</table>";
		} else {
			echo "<p>Nenhum aluno cadastrado.</p>";
		}

		mysqli_close($conn);
	?>

	<h2>Adicionar Aluno</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="nome">Nome:</label>
		<input type="text" name="nome"  required>
		<br>
		<label for="idade">Idade:</label>
		<input type="number" name="idade" required>
		<br>
		<input type="submit" name="submit" value="Adicionar">
	</form>

</body>
</html>