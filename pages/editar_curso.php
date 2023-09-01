<?php
include("lib/connection.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

$erro = array();
$id = intval($_GET['id']);

if (isset($_POST['enviar'])) {
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $preco = $_POST['preco'];
    $conteudo = $_POST['conteudo'];

    if (empty($titulo))
        $erro[] = "Preencha o título";

    if (empty($subtitulo))
        $erro[] = "Preencha o subtitulo";

    if (empty($preco))
        $erro[] = "Preencha o preço";

    if (empty($conteudo))
        $erro[] = "Preencha o conteudo";

    if (count($erro) == 0) {
        $imagem_alterada = false;
        $deu_certo = true;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['size'] > 0) {
            $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
            $imagem_alterada = true;
        }

        if ($deu_certo !== false) {
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
        } else {
            $erro[] = "Falha ao enviar imagem";
        }
    }
}

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id");
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
                    <h4>editar Curso</h4>
                    <span>ich hoffe mein wird größer</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Pages</a></li>
                    <li class="breadcrumb-item"><a href="#!">editar Curso</a></li>
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
                    <h5>ediçao de Cadastro</h5>
                </div>
                <div class="card-block">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <?php 
                     foreach ($result as $row) {
                     ?>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" value="<?php echo $row['titulo']; ?>" name="titulo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="subtitulo">Subtítulo</label>
                                <input type="text" value="<?php echo $row['subtitulo']; ?>" name="subtitulo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="text" value="<?php echo $row['preco']; ?>" name="preco" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="imagem">Imagem</label>
                                <input type="file" name="imagem" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="conteudo">Conteúdo</label>
                                <textarea name="conteudo" rows="10" class="form-control"><?php echo $row['conteudo']; ?></textarea>
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