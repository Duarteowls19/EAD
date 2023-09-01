<?php
include("lib/connection.php");
include("lib/enviarArquivo.php");
include('lib/protect.php');
protect(1);

$erro = array();

if (isset($_POST['enviar'])) {
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $preco = $_POST['preco'];
    $conteudo = $_POST['conteudo'];
    $data_cadastro = date("Y-m-d H:i:s");
    $_imagem = $_FILES['imagem'];

    if (empty($titulo))
        $erro[] = "Preencha o título";

    if (empty($subtitulo))
        $erro[] = "Preencha o subtitulo";

    if (empty($preco))
        $erro[] = "Preencha o preço";

    if (empty($conteudo))
        $erro[] = "Preencha o conteudo";

    if (!isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0 || $_FILES['imagem']['error'] != UPLOAD_ERR_OK) {
        $erro[] = "Selecione uma imagem válida para o conteúdo";
    } else {
        $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
        if ($deu_certo === false) {
            $erro[] = "Falha ao enviar a imagem";
        }
    }

    if (count($erro) == 0) {
        $sql = "INSERT INTO cursos (titulo, subtitulo, conteudo, data_cadastro, preco, imagem) VALUES (:titulo, :subtitulo, :conteudo, :data_cadastro, :preco, :imagem)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':subtitulo', $subtitulo);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':data_cadastro', $data_cadastro);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $deu_certo); // Updated from $_imagem

        if ($stmt->execute()) {
            echo "<script>location.href=\"index.php?p=gerenciar_cursos\";</script>";
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
                    <h4>Cadastrar Curso</h4>
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
                    <li class="breadcrumb-item"><a href="#!">Cadastrar Curso</a></li>
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
                    <h5>Formulário de Cadastro</h5>
                </div>
                <div class="card-block">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" name="titulo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="subtitulo">Subtítulo</label>
                                <input type="text" name="subtitulo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="text" name="preco" class="form-control">
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
                                <textarea name="conteudo" rows="10" class="form-control"></textarea>
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