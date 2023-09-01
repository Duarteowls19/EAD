<?php
include("lib/connection.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

$erro = array();
$id = intval($_GET['id']);

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

    if ($repita_senha != $senha) 
        $erro[] = "as senhas nao batem !";


    if (count($erro) == 0) {                                                           

        /*if ($deu_certo !== false) {
            $sql = "UPDATE cursos SET titulo = :titulo, subtitulo = :subtitulo, conteudo = :conteudo, preco = :preco";
            if ($imagem_alterada === true) {
                $sql .= ", imagem = :imagem";
            }
            $sql .= " WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':subtitulo', $subtitulo);
            $stmt->bindParam(':conteudo', $conteudo);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':id', $id);
            
            if ($imagem_alterada === true) {
                $stmt->bindParam(':imagem', $deu_certo);
            }

            $stmt->execute();

            if ($stmt) {
                echo "<script>location.href=\"index.php?p=gerenciar_cursos\";</script>";
            } else {
                $erro[] = "Falha ao atualizar o registro no banco de dados";
            }
        } */
        
        $sql = "UPDATE users SET nome = :nome, email = :email, creditos = :creditos, admin = :admin";

        if (!empty($senha)) {
            $sql .= ", senha = :senha";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':creditos', $creditos);
        $stmt->bindParam(':admin', $admin);
        $stmt->bindParam(':id', $id);
        
        if (!empty($senha)) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senha);
        }

            $stmt->execute();

            if ($stmt) {
                echo "<script>location.href=\"index.php?p=gerenciar_usuarios\";</script>";
            } else {
                $erro[] = "Falha ao atualizar o registro no banco de dados";
            }
    }
}
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Obtaining the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>editar usuario</h4>
                    <span>ich hoffe mein wird größer</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="index.php?p=gerenciar_usuarios">gerenciar usuarios</a></li>
                    <li class="breadcrumb-item">editar usuarios</li>
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
                    <h5>ediçao de cadastro</h5>
                </div>
                <div class="card-block">
                <form method="POST">
                    <div class="row">
                    <?php 
                     foreach ($result as $row) {
                     ?>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">nome</label>
                                <input type="text" value = "<?php echo $row['nome']; ?>" name="nome" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="subtitulo">email</label>
                            <input type="text" value = "<?php echo $row['email']; ?>"  name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">creditos</label>
                                <input type="text" value = "<?php echo $row['creditos']; ?>"  name="creditos" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">senha</label>
                                <input type="password" name="senha" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">repita senha</label>
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
                       <?php } ?>
                    </div>
                </form>       
            </div>
            </div>
        </div>
    </div>
</div>