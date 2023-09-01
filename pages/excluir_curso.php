<?php
include('lib/protect.php');
protect(1);
include("lib/connection.php");
$id = intval($_GET['id']);

try {
    $stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (unlink($curso['imagem'])) {
        $stmt = $conn->prepare("DELETE FROM cursos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    die("<script>location.href=\"index.php?p=gerenciar_cursos\";</script>");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>