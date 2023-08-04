<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['signEmail'];
    $senha = sha1($_POST['signPass']);

    include "base/conexao.php";

    $email = mysqli_real_escape_string($con, $email);

    $sql = "SELECT id_usu, email_usu, senha_usu, nivel_usu, nome_completo_usu, nome_usuario_usu FROM usuarios WHERE email_usu = '$email'";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        echo "Erro na consulta: " . mysqli_error($con);
        exit;
    }

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        // Verifica se as chaves existem no array antes de acessá-las
        if (isset($row['senha_usu']) && isset($row['email_usu']) && isset($row['id_usu'])) {
            $senha_armazenada = $row['senha_usu'];
            $email_armazenado = $row['email_usu'];
            $id = $row['id_usu'];

            if ($senha !== $senha_armazenada || $email !== $email_armazenado) {
                // echo "Login ou senha incorreto.";
                echo "$senha <br> $senha_armazenada";
            } else {
                // Inicia a sessão (caso ainda não tenha sido iniciada)
                if (!isset($_SESSION)) session_start();

                $_SESSION['UsuarioID'] = $id;
                $_SESSION['UsuarioEmail'] = $row['email_usu'];
                $_SESSION['UsuarioNivel'] = $row['nivel_usu'];

                $_SESSION['UsuarioNome'] = $row['nome_completo_usu'];
                $_SESSION['UsuarioUser'] = $row['nome_usuario_usu'];

                // Redireciona o usuário com base no nível
                switch ($_SESSION['UsuarioNivel']) {
                    case 1:
                        header("Location: ?page=perfil&id=" . $id);
                        exit;
                        break;
                    case 2:
                        header("Location: ?page=perfil&id=" . $id);
                        exit;
                        break;
                    case 3:
                        header("Location: ?page=perfil&id=" . $id);
                        exit;
                        break;
                    default:
                        echo "Nível de usuário inválido.";
                        break;
                }
            }
        } else {
            echo "Dados de usuário incompletos.";
        }

    } else {
        echo "Nenhum usuário encontrado.";
    }

    mysqli_close($con);
}
?>
