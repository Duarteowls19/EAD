<?php
include('lib/connection.php');
include('lib/protect.php');
protect(1);

try {
    $stmt = $conn->prepare("SELECT * FROM cursos");
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
                    <h4>gerenciar cursos</h4>
                    <span>ich hoffe mein wird gosser</span>
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
                    <li class="breadcrumb-item"><a href="#!">gerenciar cursos</a></li>
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
            <span><a href="index.php?p=cadastrar_curso">clique aqui para cadastrar curso</a></span>
          </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>imagem</th>
                                <th>titulo</th>
                                <th>preço</th>
                                <th>gerenciar</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php if (empty($result)) { ?>
        <tr>
            <td colspan="5">Nenhum curso foi cadastrado</td>
        </tr>
    <?php } else {
        foreach ($result as $row) {
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img class="img-fluid" style="width:200px" src="<?php echo $row['imagem']; ?>">
            </td>
            <td><?php echo $row['titulo']; ?></td>
            <td>R$<?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
            <td>
                <div class="row">
                    <a href="index.php?p=editar_curso&id=<?php echo $row['id']; ?>">
                        <p>editar </p>
                    </a>   | 
                    <a href="index.php?p=excluir_curso&id=<?php echo $row['id']; ?>">
                        <p> excluir</p>
                    </a>   | 
                    <a href="index.php?p=assistir_adm&id=<?php echo $row['id']; ?>">
                        <p> acessar</p>
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