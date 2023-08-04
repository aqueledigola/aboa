<?php

include "base/conexao.php";

// Verifica se a ID do usuário está na sessão
if (isset($_SESSION['UsuarioID'])) {
    $id = $_SESSION['UsuarioID'];
    
    $sql = "DELETE FROM usuarios WHERE id_usu = '$id';"; 
    $resultado = mysqli_query($con, $sql) or die(mysqli_error());

    if ($resultado) {
        echo "<script>
            alert('Usuário excluído com sucesso');
            window.location.href = '?page=login'; // Redirecionar para a página de logout ou outra ação
        </script>";   
    } else {
        echo "<script>
            alert('Falhou ao excluir usuário');
            window.location.href = '?page=perfil&id=" . $id . "'; // Redirecionar de volta à página de perfil em caso de falha
        </script>";   
    }

    mysqli_close($con);
} else {
    echo "<script>
        alert('Erro: ID de usuário não encontrado na sessão');
        window.location.href = '?page=login'; // Redirecionar para a página de login ou outra ação
    </script>";
}

?>
