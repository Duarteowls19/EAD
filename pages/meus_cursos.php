<?php
protect(0);

if (!isset($_SESSION)) {
    session_start();
}

$data_cadastro = date("Y-m-d H:i:s");

$id_usuario = $_SESSION['user'];

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM relatorio WHERE id_usuario = :id_usuario)");
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}
?>
<div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <!--<i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>-->
                    <div class="d-inline">
                        <h4> Hop outside a Ghost and hop up in a Phantom</h4>
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
                        <li class="breadcrumb-item"><a href="">meus cursos</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="page-body">
   <div class="row-card">
   
   <?php foreach($result as $row){ ?>
    <div class="row-cards">
         
    <div class="card">
          <div class="card-header">
            <h5><?php echo $row['titulo']; ?></h5>
            <span>auf der heide bluht ein kleines blumelein</span>
          </div>
        
          <div class="card-block">
            <p><?php echo $row['subtitulo']; ?></p>
            <img src="<?php echo $row['imagem']; ?>" class="img-reab" alt="">
            <p>und das heisst </p> 
            <form action="index.php">
                <input type="hidden" name="p" value="assistir">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

               <button type="submit" class="btn form-control btn-out-dashed btn-primary btn-square">ERIKA !!!!!! </button>
            </form> 
          </div>

    </div>
    </div>
    <?php } ?>
    
  
</div>