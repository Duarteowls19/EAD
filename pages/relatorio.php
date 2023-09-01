<?php
include('lib/connection.php');
include('lib/protect.php');
protect(1);

try {
    $stmt = $conn->prepare("SELECT r.id, u.nome, c.titulo, r.data_compra, r.valor FROM relatorio r, users u, cursos c WHERE u.id = r.id_usuario AND c.id = r.id_curso");
    $stmt->execute();

    // Obtendo os resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}
?>

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
           <div class="page-header-title">
                <!--<i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>-->
                <div class="d-inline">
                    <h4>relatorios</h4>
                    <span>ich hoffe mein penis wird gosser</span>
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
                    <li class="breadcrumb-item"><a href="#!">pages</a></li>
                    <li class="breadcrumb-item"><a href="#!">relatorios</a></li>
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
            <h5>relatorios</h5>
          </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>usuario</th>
                                <th>curso</th>
                                <th>valor</th>
                                <th>data</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php if (empty($result)) { ?>
        <tr>
            <td colspan="5">Nenhum usuario foi cadastrado</td>
        </tr>
    <?php } else {
        foreach ($result as $row) {
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td>R$<?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
            <td><?php echo $row['data_compra']; ?></td>
        </tr>
    <?php
        }
    }
    ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
          </div>
       </div>
   </div>
</div> 