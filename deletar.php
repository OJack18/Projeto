<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Conta</title>
</head>
<body>
<?php
session_start();
include 'conexao.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    $id = $_SESSION['id'];

    // Excluir o usuário do banco de dados
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        session_destroy(); // Destroi a sessão para deslogar o usuário
        header("Location: login.php"); // Redireciona para a tela de login
        exit();
    } else {
        echo "Erro ao excluir a conta.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Ação não permitida.";
}
?>

</body>
</html>