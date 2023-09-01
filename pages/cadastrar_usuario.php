<?php
include("lib/connection.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

$erro = array();

if (isset($_POST['enviar'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $creditos = addslashes($_POST['creditos']);
    $senha = addslashes($_POST['senha']);
    $repita_senha = addslashes($_POST['repita_senha']);
    $admin = addslashes($_POST['admin']);
    $data_cadastro = date("Y-m-d H:i:s");

    if (empty($nome))
        $erro[] = "Preencha o nome";

    if (empty($email))
        $erro[] = "Preencha o email";

    if (empty($creditos))
        $erro[] = "Preencha os creditos";

    if (empty($senha))
        $erro[] = "Preencha a senha";

    if ($repita_senha != $senha) 
        $erro[] = "as senhas nao batem !";


    if (count($erro) == 0) {

        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nome, email, senha, data_cadastro, creditos, admin) VALUES (:nome, :email, :senha, :data_cadastro, :creditos, :admin)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':data_cadastro', $data_cadastro);
        $stmt->bindParam(':creditos', $creditos);
        $stmt->bindParam(':admin', $admin);

        if ($stmt->execute()) {
            echo "<script>location.href=\"index.php?p=gerenciar_usuarios\";</script>";
            exit();
        } else {
            $erro[] = "Falha ao inserir no banco de dados";
        }
    }
}
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Cadastrar usuario</h4>
                    <span>ich hoffe mein wird größer</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html?p=gerenciar_usuario">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Pages</a></li>
                    <li class="breadcrumb-item"><a href="#!">Cadastrar usuario</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (isset($erro) && count($erro) > 0) {
                echo '<div class="alert alert-danger" role="alert">';
                foreach ($erro as $e) {
                    echo '<p>' . $e . '</p>';
                }
                echo '</div>';
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h5>Formulário de cadastro</h5>
                </div>
                <div class="card-block">
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">nome</label>
                                <input type="text" name="nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="">email</label>
                            <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">creditos</label>
                                <input type="text" name="creditos" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">senha</label>
                                <input type="password" name="senha" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">repita senha</label>
                                <input type="password" name="repita_senha" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">tipo</label>
                                <select name="admin" class="form-control">
                                    <option value="0">usuario</option>
                                    <option value="1">admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                                <button name="cancelar" class="btn btn-warning btn-round">
                                    <i class="ti-arrow-left"></i> Cancelar
                                </button>
                                <button type="submit" name="enviar" value="1" class="btn btn-success btn-round">
                                    <i class="ti-save"></i> Salvar
                                </button>
                        </div>
                       
                    </div>
                </form>       
            </div>
            </div>
        </div>
    </div>
</div>