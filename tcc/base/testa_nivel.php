<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verifica se 'id_usu' está definido e se 'nivel_usu' é maior ou igual a $nivel_necessario
    if (!isset($_SESSION['id_usu']) || ($_SESSION['nivel_usu'] < $nivel_necessario)) {
        session_destroy(); // Destroi a sessão do usuário
        echo "Acesso NEGADO!!!<br><br>";
        header("Location: index.php");
        exit;
    }
?>
