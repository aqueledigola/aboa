<?php
    // Verifica se o ID do usuário está definido na sessão
    if (isset($_SESSION['UsuarioID'])) {
        $usuario_id = $_SESSION['UsuarioID'];
    } else {
        // Redirecionar o usuário para o login se não estiver logado
        header("Location: ?page=login");
        exit;
    }

    // Inclui a conexão com o banco de dados
    include "base/conexao.php";

    // Consulta no banco de dados para obter os dados do usuário
    $sql = "SELECT * FROM usuarios WHERE id_usu = '$usuario_id'";
    $resultado = mysqli_query($con, $sql);

    // Verifica se a consulta foi bem sucedida
    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
    } else {
        echo "Erro na consulta: " . mysqli_error($con);
    }
?>

<div id="main" class="container-fluid">
    <br><h3 class="page-header">Editar Perfil - <?php echo $usuario_id;?></h3>

    <!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza&usuario=<?php echo $usuario_id; ?>" method="post">
        <form action="?page=atualiza" method="post">
        <!-- Campos do formulário com os valores do usuário -->
            <input type="hidden" name="id_usu" value="<?php echo $row['id_usu']; ?>">
            <input type="text" name="nome_completo_usu" value="<?php echo $row['nome_completo_usu']; ?>" required>
            <input type="date" name="data_nascimento_usu" value="<?php echo $row['data_nascimento_usu']; ?>" required>
            <input type="text" name="nome_usuario_usu" value="<?php echo $row['nome_usuario_usu']; ?>" required>
            <input type="email" name="email_usu" value="<?php echo $row['email_usu']; ?>" required>

            <div id="actions" class="row">
                <div class="col-md-12">
                    <a href="?page=lista_alu" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="?page=excluir" class="btn btn-outline-danger"> Excluir Conta </a>
                </div>
            </div>
        </form>
    </form>
</div>
