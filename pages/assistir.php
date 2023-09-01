<?php
protect(0);
$id = intval($_GET['id']);

if (!isset($_SESSION))
    session_start();

$id_user = $_SESSION['user'];

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id AND id IN (SELECT id_curso FROM relatorio WHERE id_usuario = :id_user)");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
$stmt->execute();

    // Obtaining the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}

foreach ($results as $result) {
    ?>
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <!--<i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>-->
                    <div class="d-inline">
                        <h4><?php echo $result['titulo']; ?></h4>
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
                        <li class="breadcrumb-item"><a href="index.php?p=meus_cursos">meus cursos</a></li>
                        <li class="breadcrumb-item"><a href="#!">vizualizar curso</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <img style="width:40%;margin-bottom:50px;border-radius:10px;" src="<?php echo $result['imagem']; ?>" alt=""><br>
                        <h5><?php echo $result['subtitulo']; ?></h5>
                        <span><?php echo $result['data_cadastro']; ?></span>
                    </div>
                    <div class="card-block">
                        <p><?php echo $result['conteudo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>