<?php
protect(0);

if (!isset($_SESSION)) {
    session_start();
}

$erro = false;
$data_cadastro = date("Y-m-d H:i:s");

if (isset($_POST['adquirir'])) {
    $id_usuario = $_SESSION['user'];

    try {
        $stmt = $conn->prepare("SELECT creditos FROM users WHERE id = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        $result_user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erro na conexão: " . $e->getMessage());
    }

    $creditos_user = $result_user['creditos'];

    $id_curso = intval($_POST['adquirir']);

    try {
        $stmt = $conn->prepare("SELECT preco FROM cursos WHERE id = :id_curso");
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $result_curso = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erro na conexão: " . $e->getMessage());
    }

    $preco_do_curso = $result_curso['preco'];

    if (isset($preco_do_curso) && isset($creditos_user) && $preco_do_curso > $creditos_user) {
        $erro = "Você não possui créditos suficientes para comprar esse curso.";
    } else {
        try {
            $sql = "INSERT INTO relatorio (id_usuario, id_curso, valor, data_compra) VALUES (:id_usuario, :id_curso, :valor, :data_compra)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_curso', $id_curso);
            $stmt->bindParam(':valor', $preco_do_curso);
            $stmt->bindParam(':data_compra', $data_cadastro);

            $novo_credito = $creditos_user - $preco_do_curso;

            $stmt->execute();

            // Atualizar os créditos do usuário
            $sql = "UPDATE users SET creditos = :creditos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':creditos', $novo_credito);
            $stmt->bindParam(':id', $id_usuario);
            $stmt->execute();

            die("<script>location.href='index.php?p=meus_cursos';</script>");
        } catch (PDOException $e) {
            exit("Erro na conexão: " . $e->getMessage());
        }
    }
}

$id_usuario = $_SESSION['user'];

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id NOT IN (SELECT id_curso FROM relatorio WHERE id_usuario = :id_usuario)");
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
                    <h4>loja de cursos</h4>
                    <span>ich hoffe mein penis wird gosser</span>
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
                    <li class="breadcrumb-item"><a href="#!">loja de cursos</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
   <div class="row-card">
   <div class="col-sm-12">
   <?php if($erro !== false){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $erro; ?>
        </div>
    <?php } ?>
   </div>
   
   
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
            <form action="" method="POST">
               <button type="submit" name="adquirir" value="<?php echo $row['id']; ?>" class="btn form-control btn-out-dashed btn-success btn-square">ERIKA !!!!!! R$ <?php echo $row['preco']; ?></button>
            </form> 
          </div>

    </div>
    </div>
    <?php } ?>
    
  
</div>
