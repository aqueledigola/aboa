<?php
    include "base/conexao.php"; // Incluir a conexão com o banco de dados

    // Verificar se os campos do formulário foram enviados
    if (isset($_POST["id_usu"], $_POST["nome_completo_usu"], $_POST["data_nascimento_usu"], $_POST["nome_usuario_usu"], $_POST["email_usu"])) {

        $id        = $_POST["id_usu"];
        $nome      = $_POST["nome_completo_usu"];
        $dt_nasc   = $_POST["data_nascimento_usu"];
        $nomeusu   = $_POST["nome_usuario_usu"];
        $email     = $_POST["email_usu"];

        $sql = "UPDATE usuarios SET ";
        $sql .= "nome_completo_usu='".$nome."', nome_usuario_usu='".$nomeusu."', ";
        $sql .= "data_nascimento_usu='".$dt_nasc."', email_usu='".$email."' ";
        $sql .= "WHERE id_usu = '$id';";

        $resultado = mysqli_query($con, $sql) or die(mysqli_error($con));

        if ($resultado) {
            echo "<script>
                alert('Atualizado com Sucesso!');
                window.location.href = '?page=perfil&id=" . $id . "';
            </script>";   
        } else {
            echo "<script>
                alert('Falhou ao atualizar usuário');
                window.location.href = '?page=perfil&id=" . $id . "';
            </script>";   
        }

        mysqli_close($con);
        
    } else {
        echo "<script>
            alert('Campos do formulário não foram enviados.');
            window.location.href = '?page=perfil&id=" . $id . "';
        </script>";   
    }
?>
