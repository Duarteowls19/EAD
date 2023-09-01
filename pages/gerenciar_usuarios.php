<?php
include('lib/connection.php');
include('lib/protect.php');
protect(1);

try {
    $stmt = $conn->prepare("SELECT * FROM users");
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
                    <h4>gerenciar usuarios</h4>
                    <span>ich hoffe mein wird gosser</span>
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
                    <li class="breadcrumb-item">gerenciar usuarios</li>
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
            <h5>cursos</h5>
            <span><a href="index.php?p=cadastrar_usuario">clique aqui para cadastrar usuario</a></span>
          </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>nome</th>
                                <th>email</th>
                                <th>creditos</th>
                                <th>data de cadastro</th>
                                <th>tipo</th>
                                <th>gerenciar</th>
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
            <td><?php echo $row['email']; ?></td>
            <td>R$<?php echo number_format($row['creditos'], 2, ',', '.'); ?></td>
            <td><?php echo $row['data_cadastro']; ?></td>
            <td><?php if($row['admin'] == 0){echo 'usuario';}else{echo 'admin';}?></td>
            <td>
                <div class="row">
                    <a href="index.php?p=editar_usuario&id=<?php echo $row['id']; ?>">
                        <p>editar </p>
                    </a>   | 
                    <a href="index.php?p=excluir_usuario&id=<?php echo $row['id']; ?>">
                        <p> excluir</p>
                    </a>
                </div>
            </td>
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